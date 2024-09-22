<?php

namespace App\Http\Middleware;

use App\Models\Campaign;
use App\Models\Donation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $donationId = $request->route('id');
    
        $donation = Donation::findOrFail($donationId);

        if ($donation)
        {
            $campaignId = $donation->campaign_id;
        }
        $campaign = Campaign::findOrFail($campaignId);
        if ($campaign)
        {
            $ownerId = $campaign->user_id;
        }

        if (auth()->user()->id === $ownerId)
        {
            return $next($request);
        }
        return redirect()->route('home')->with('error', 'você não possui permissão de acessar esta página');
    }
}
