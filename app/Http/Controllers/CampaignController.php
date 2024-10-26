<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
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

    public function store(CampaignRequest $request) {
        $validRequest = $request->validated();
        // cadastrando o endereço

        $address = new Address();

        $address->State = $validRequest['State'];

        $address->City = $validRequest['City'];

        $address->Street = $validRequest['City'];

        $address->CEP = $validRequest['CEP'];

        $address->Collection_date = $validRequest['Data'];

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

        $requestImage = $request->Image;

        $extension = $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

        $requestImage->move(public_path('img/campaigns'), $imageName);

        $campaign->Image = $imageName;
    

        $campaign->save();

        return redirect()->route('home')->with('Success', 'Campanha editada com sucesso!');
    }
}
