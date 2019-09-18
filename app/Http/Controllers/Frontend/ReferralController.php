<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ReferralBonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $url = url('/') . '?ref=' . $user->id;

        return view('frontend.pages.referrals.index', [
            'user'                  => $user,
            'referral_bonuses'  => [
                'referee_sign_up_credits'   => $user->referee_sign_up_credits ?: config('settings.referral.referee_sign_up_credits'),
                'referrer_sign_up_credits'  => $user->referrer_sign_up_credits ?: config('settings.referral.referrer_sign_up_credits'),
                'referrer_game_bet_pct'     => $user->referrer_game_bet_pct ?: config('settings.referral.referrer_game_bet_pct'),
                'referrer_deposit_pct'      => $user->referrer_deposit_pct ?: config('settings.referral.referrer_deposit_pct'),
            ],
            'referred_users_count'  => $user->referees()->count(),
            'referral_total_bonus'  => $user->account->transactions->where('transactionable_type', ReferralBonus::class)->sum('amount'),
            'referral_url'          => $url,
            'share_subject'         => __('Sign up with :name now and get free credits', ['name' => __('Crypto Casino')]),
            'share_body'            => __('Click this link to sign up: :url', ['url' => $url]),
        ]);
    }
}
