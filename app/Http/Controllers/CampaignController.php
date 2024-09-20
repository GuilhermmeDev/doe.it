<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
                'target' => intval($request->meta),
                'current' => 0,
            ];
        }

        $campaign->save();

        return redirect('/home')->with('Success', 'Campanha criada com sucesso!');
    }

    public function show($id) {
        $campaign = Campaign::findOrFail($id);
        if ($campaign->meta != null) {
            $target = $campaign->meta['target'];
            $current = $campaign->meta['current'];
            $progress = ($current / $target) * 100;
        } else {
            $progress = null;
        }
        $address = Address::findOrFail($campaign->address_id);

        $donation = Donation::where('user_id', auth()->user()->id)->first();

        if ($campaign && $address) {
            return view('campaigns.show', compact('campaign', 'progress', 'address', 'donation'));
        }

    }

    public function delete($id) {
        $campaign = Campaign::findOrFail($id)->delete();

        return redirect('/home')->with('Success', 'Doação cancelada com sucesso!');
    }


    public function edit($id) {
        $campaign = Campaign::where('id', $id)->first();

        return view('campaigns.edit', compact('campaign'));
    }

    public function update($id, Request $request) {

        $campaign = Campaign::findOrFail($id);

        $campaign->Title = $request->Title;

        $campaign->Description = $request->Description;

        $campaign->save();

        return redirect()->route('home')->with('success', 'Campanha editada com sucesso!');
    }
}
