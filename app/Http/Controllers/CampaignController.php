<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function create() {
        return view('campaigns.create');
    }

    public function store(Request $request) {
        // cadastrando o endereço

        $address = new Address();

        $address->State = $request->State;

        $address->City = $request->City;

        $address->Street = $request->Street;

        $address->CEP = $request->CEP;

        $address->Collection_date = $request->Data;

        $address->Number = $request->Number;

        $address->save();

        // Cadastrando a campanha

        $campaign = new Campaign();

        $campaign->user_id = auth()->user()->id;

        $campaign->address_id = $address->id;

        $campaign->Title = $request->Title;

        $campaign->Description = $request->Description;

        if ($request->meta)
        {
            $campaign->meta = [
                'target' => $request->meta,
                'current' => 23,
            ];
        }

        $campaign->save();

        return redirect('/home')->with('Sucess', 'Campanha criada com sucesso!');
    }

    public function show($id) {
        $campaign = Campaign::findOrFail($id);
        $target = $campaign->meta['target'];
        $current = $campaign->meta['current'];
        $progress = $target > 0 ? ($current / $target) * 100 : 0;
        $address = Address::findOrFail($campaign->address_id);

        if ($campaign && $address) {
            return view('campaigns.show', compact('campaign', 'progress', 'address'));
        }

        return redirect('/home')->with('Error', 'Campanha não encontrada.');
    }
}
