<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Http\Requests\InviteValidatorRequest;
use App\Mail\CampaignInviteMail;
use App\Models\Address;
use App\Models\Campaign;
use App\Models\CampaignValidatorUser;
use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CampaignController extends Controller
{
    public function create()
    {
        if (Gate::allows('verify-cpf', auth()->user())) {
            return view('campaigns.create');
        }

        return view('auth.register-cpf');
    }

    public function store(CampaignRequest $request)
    {
        $validRequest = $request->validated();
        // cadastrando o endereço

        $address = new Address;

        $address->State = $validRequest['State'];

        $address->City = $validRequest['City'];

        $address->Street = $validRequest['Street'];

        $dateTime = $validRequest['Data'].' '.$validRequest['Hour']; // concatenando data e hora
        $dateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $dateTime); // formatando com a biblioteca Carbon

        $address->Collection_date = $dateTime;

        $address->Number = $validRequest['Number'];

        $address->save();

        // Cadastrando a campanha

        $campaign = new Campaign;

        $campaign->user_id = auth()->user()->id;

        $campaign->address_id = $address->id;

        $campaign->Title = $validRequest['Title'];

        $campaign->Description = $validRequest['Description'];

        $requestImage = $validRequest['Image'];

        $extension = $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extension;

        $imagePath = $requestImage->storeAs('campaigns', $imageName, 'public');

        $campaign->Image = $imagePath; // salva o caminho relativo, ex: campaigns/abc123.jpg

        $campaign->Type = $validRequest['Type'];

        if ($validRequest['meta']) {
            $campaign->meta = [
                'target' => intval($validRequest['meta']),
                'current' => 0,
            ];
        }

        $campaign->save();

        return redirect('/home')->with('Success', 'Campanha criada com sucesso!');
    }

    public function show($id)
    {
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

        $validators = $campaign->allValidatorsIncludingOwner();

        if ($campaign && $address) {
            return view('campaigns.show', compact('campaign', 'progress', 'address', 'donation', 'donation_count', 'validators'));
        }
    }

    public function delete($id)
    {
        $campaign = Campaign::findOrFail($id)->delete();

        return redirect('/home')->with('Success', 'Campanha cancelada com sucesso!');
    }

    public function edit($id)
    {
        $campaign = Campaign::where('id', $id)->first();

        if (auth()->user()->id === $campaign->user_id) {
            return view('campaigns.edit', compact('campaign'));
        }

        return redirect()->route('home')->with('error', 'Você não possui permissão para acessar esta página');
    }

    public function update($id, Request $request)
    {

        $campaign = Campaign::findOrFail($id);

        $campaign->Title = $request->Title;

        $campaign->Description = $request->Description;

        if ($request->Image) {
            $requestImage = $request->Image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extension;

            $imagePath = $requestImage->storeAs('campaigns', $imageName, 'public');

            $campaign->Image = $imagePath;
        }

        $campaign->save();

        return redirect()->route('home')->with('Success', 'Campanha editada com sucesso!');
    }

    private function resendInvite(CampaignValidatorUser $validator)
    {
        $campaign = $validator->campaign;
        $user = $validator->user;
        $inviter = $validator->invitedBy;
        $inviterName = $inviter ? $inviter->name : auth()->user()->name;

        Mail::to($user->email)->send(new CampaignInviteMail(
            $campaign,
            $user,
            $inviterName,
            $validator->token
        ));

        $validator->touch(); // Atualiza o timestamp 'updated_at'

        return response()->json([
            'message' => 'Convite reenviado com sucesso!',
        ], 200);
    }

    public function invite(InviteValidatorRequest $request)
    {
        $data = $request->validated();
        $email = $data['email'];
        $campaign_id = $data['campaign_id'];
        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json([
                'message' => 'Nenhum usuário encontrado com este e-mail.',
            ], 404);
        }

        if ($user->id === auth()->user()->id) {
            return response()->json([
                'message' => 'Você não pode convidar a si mesmo.',
            ], 400);
        }

        $existingValidator = CampaignValidatorUser::where('user_id', $user->id)
            ->where('campaign_id', $campaign_id)
            ->first();

        if ($existingValidator) {
            if ($existingValidator->status === 'accepted') {
                return response()->json([
                    'message' => 'Usuário já é um validador.',
                ], 400);
            }

            if ($existingValidator->status === 'pending') {
                $canResendAt = $existingValidator->updated_at->addMinutes(2);

                if (Carbon::now()->lt($canResendAt)) {
                    return response()->json([
                        'message' => 'Um convite pendente já foi enviado recentemente. Aguarde antes de reenviar.',
                    ], 429);
                }

                return $this->resendInvite($existingValidator);
            }
        }

        $validator_user = new CampaignValidatorUser;
        $validator_user->campaign_id = $campaign_id;
        $validator_user->invited_by = auth()->user()->id;
        $validator_user->user_id = $user->id;
        $validator_user->invite_email = $email;
        $validator_user->status = 'pending';
        $validator_user->save();

        $campaign = Campaign::find($campaign_id);

        Mail::to($email)->send(
            new CampaignInviteMail(
                $campaign,
                $user,
                auth()->user()->name,
                $validator_user->token
            )
        );

        return response()->json([
            'message' => 'Convite enviado com sucesso!',
        ], 200);
    }

    public function accept($token)
    {
        $validator_user = CampaignValidatorUser::where('token', $token)->first();

        if (auth()->user()->id !== $validator_user->user_id) {
            return redirect('/home')->with('error', 'Você não tem permissão para aceitar este convite.');
        } elseif (! $validator_user) {
            return redirect('/home')->with('error', 'Convite inválido ou já aceito.');
        }

        $validator_user->status = 'accepted';
        $validator_user->accepted_at = now();
        $validator_user->save();

        return redirect('/home')->with('Success', 'Convite aceito com sucesso!');
    }

    public function decline($token)
    {
        $validator_user = CampaignValidatorUser::where('token', $token)->first();

        if (! $validator_user) {
            return redirect('/home')->with('error', 'Convite inválido ou já aceito.');
        }

        $validator_user->delete();

        return redirect('/home')->with('Success', 'Convite recusado com sucesso!');
    }

    public function removeValidator(Campaign $campaign, User $user)
    {
        if (auth()->id() !== $campaign->user_id) {
            abort(403);
        }

        if ($user->id === $campaign->user_id) {
            return redirect()->back()->with('error', 'Você não pode remover o dono da campanha.');
        }

        CampaignValidatorUser::where('campaign_id', $campaign->id)
            ->where('user_id', $user->id)
            ->delete();

        return redirect()->back()->with('Success', 'Validador removido com sucesso.');
    }
}
