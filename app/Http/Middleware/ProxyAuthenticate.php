<?php


namespace App\Http\Middleware;


use App\Models\User;
use App\Services\AccountService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProxyAuthenticate extends Authenticate
{
	protected function authenticate( $request, array $guards )
	{
		$data = self::getHeaderCasinoData($request);
		if (!is_null($data)) {
			$user_id = $data['user_id'];
			$user_name = $data['user_name'];

			if (!is_null($user_id) && !is_null($user_name)) {
				$username = $user_name.':'.$user_id;
				$user = UserService::createWithAccount(
					$username,
					$username.'@crypto-casino.betpress',
					'',
					$data['role'] === 'admin' ? User::ROLE_ADMIN : User::ROLE_USER
				);
				Auth::login($user);
			}

			if (isset($data['config'])) {
				$config = $data['config'];
				$overriders = [];
				$games = config('settings.currency.games');
				foreach ($games as $game) {
					foreach ($config as $key => $val) {
						if ($key === 'default_bet') {
							$overriders[$game.'.'.$key.'_amount'] = $val;
						}
						$overriders[$game.'.'.$key] = $val;
					}
				}

				config($overriders);
			}
		}
	}

	public static function getHeaderCasinoData($request) {
		$dataEncrypted = $request->header('CASINO-DATA', null);
		if (!is_null($dataEncrypted)) {
			$method    = 'aes128';
			$dataStr   = openssl_decrypt( $dataEncrypted, $method, config( 'settings.backend.secure_code' ), 0, config( 'settings.backend.secure_iv' ) );
			$data      = json_decode( $dataStr, true );
			return $data;
		}

		return null;
	}
}