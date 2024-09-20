<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DonationController extends Controller
{
    public function donate($id) {
        $campaign = Campaign::findOrFail($id);

        return view('donations.donate', compact('campaign'));
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

        return view('donations.show', compact('donation'));
    }

    public function delete($id) {
        $donation = Donation::findOrFail($id)->delete();

        return redirect('/home')->with('Success', 'Doação cancelada com sucesso!');
    }
}