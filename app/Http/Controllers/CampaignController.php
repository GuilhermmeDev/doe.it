<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Address;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CampaignController extends Controller
{
    public function create() {
        if (Gate::allows('verify-cpf', auth()->user())) 
        {
            return view('campaigns.create');
        }
        return view('auth.register-cpf');
    }

    public function store(CampaignRequest $request) {
        $validRequest = $request->validated();
        // cadastrando o endereço

        $address = new Address();

        $address->State = $validRequest['State'];

        $address->City = $validRequest['City'];

        $address->Street = $validRequest['Street'];

        $address->CEP = $validRequest['CEP'];

        $dateTime = $validRequest['Data'] . ' ' . $validRequest['Hour']; // concatenando data e hora
        $dateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $dateTime); // formatando com a biblioteca Carbon

        $address->Collection_date = $dateTime;

        $address->Number = $validRequest['Number'];

        $address->save();

        // Cadastrando a campanha

        $campaign = new Campaign();

        $campaign->user_id = auth()->user()->id;

        $campaign->address_id = $address->id;

        $campaign->Title = $validRequest['Title'];

        $campaign->Description = $validRequest['Description'];
        
        $requestImage = $validRequest['Image'];

        $extension = $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

        $requestImage->move(public_path('img/campaigns'), $imageName);

        $campaign->Image = $imageName;

        if ($validRequest['meta'])
        {
            $campaign->meta = [
                'target' => intval($validRequest['meta']),
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
            $progress = round($progress, 1);
        } else {
            $progress = null;
        }
        $address = Address::findOrFail($campaign->address_id);

        $donation = Donation::where('user_id', auth()->user()->id)->where('campaign_id', $campaign->id)->where('Status', 'pending')->first();

        $donation_count = Donation::where('campaign_id', $campaign->id)->count(); 

        if ($campaign && $address) {
            return view('campaigns.show', compact('campaign', 'progress', 'address', 'donation', 'donation_count'));
        }

    }

    public function delete($id) {
        $campaign = Campaign::findOrFail($id)->delete();

        return redirect('/home')->with('Success', 'Campanha cancelada com sucesso!');
    }


    public function edit($id) {
        $campaign = Campaign::where('id', $id)->first();

        if (auth()->user()->id === $campaign->user_id) {
            return view('campaigns.edit', compact('campaign'));
        }

        return redirect()->route('home')->with('error', 'Você não possui permissão para acessar esta página');
    }

    public function update($id, Request $request) {

        $campaign = Campaign::findOrFail($id);

        $campaign->Title = $request->Title;

        $campaign->Description = $request->Description;

        $requestImage = $request->Image;

        $extension = $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

        $requestImage->move(public_path('img/campaigns'), $imageName);

        $campaign->Image = $imageName;
    

        $campaign->save();

        return redirect()->route('home')->with('Success', 'Campanha editada com sucesso!');
    }
}
