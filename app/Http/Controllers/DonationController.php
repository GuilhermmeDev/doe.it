<?php

namespace App\Http\Controllers;

use App\Events\CampaignMeta;
use App\Events\ConfirmDonation;
use App\Models\Campaign;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonationController extends Controller
{
    public function donate($id) {
        if (Gate::allows('verify-cpf', auth()->user())) {
            $campaign = Campaign::findOrFail($id);
            if ($campaign->meta['current'] >= $campaign->meta['target'])
            {
                return redirect('/campaign/'. $campaign->id);
            }
    
            return view('donations.donate', compact('campaign'));
        }
        return view('auth.register-cpf');
    }

    public function store(Request $request, $id) {
        $userid = auth()->user()->id;

        $donation = new Donation();

        $donation->user_id = $userid;
        $donation->campaign_id = $id;

        $donation->Quantity = $request->Quantity;
        if ($request->Description)
        {
            $donation->Description = $request->Description;
        }

        $donation->save();

        $url = url('/confirm/' . $donation->id);

        $qrcode = QrCode::format('png')->size(200)->generate($url);

        $donation->qr_code = base64_encode($qrcode);

        $donation->save();

        return redirect('/donation/' . $donation->id);

    }
    public function show($id) {
        $donation = Donation::findOrFail($id);
        if ($donation->Status !== 'confirmed')
        {
            return view('donations.show', compact('donation'));
        }

        return view('donations.confirmed', compact('donation'));
    }

    public function delete($id) {
        $donation = Donation::findOrFail($id)->delete();

        return redirect('/home')->with('Success', 'Doação cancelada com sucesso!');
    }

    public function verify($id) {
        $donation = Donation::findOrFail($id);

        $campaign = Campaign::find($donation->campaign_id);

        if (Gate::allows('auth-donation', $campaign)) {
            return view('donations.confirm', compact('donation'));
        }

        return redirect('/home')->with('error', 'Você não possui permissão de acessar esta página');
    }

    public function confirm($id) {

        // confirmando a doação no BD
        $donation = Donation::findOrFail($id);

        $donation->Status = 'confirmed';

        $donation->Confirmed_at = Carbon::now();

        $donation->save();

        // adicionando quantidade doada a quantidade recebida pela campanha
        $campaign = Campaign::where('id', $donation->campaign_id)->first();

        $meta = $campaign->meta;

        $meta['current'] += $donation->Quantity;

        $campaign->meta = $meta;

        $campaign->save();
        event(new ConfirmDonation($donation));

        return redirect('/home')->with('success', 'Doação confirmada com sucesso.');
    }
}