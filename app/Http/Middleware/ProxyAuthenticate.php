<?php


namespace App\Http\Middleware;


use App\Models\User;
use App\Services\AccountService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class ProxyAuthenticate extends Authenticate
{
	protected function authenticate( $request, array $guards )
	{
		$user_id = $request->header('CASINO-USER-ID', null);
		$user_name = $request->header('CASINO-USER-NAME', null);

		if (!is_null($user_id) && !is_null($user_name)) {
			$username = $user_name.':'.$user_id;
			$user = UserService::createWithAccount(
				$username,
				$username.'@crypto-casino.betpress',
				'',
				User::ROLE_USER
			);
			Auth::login($user);
		}

		parent::authenticate( $request, $guards );
	}
}