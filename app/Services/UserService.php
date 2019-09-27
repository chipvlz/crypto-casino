<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserService
{
    /**
     * Create a new user
     *
     * @param string|NULL $name
     * @param string|NULL $email
     * @param string|NULL $password
     * @param string|NULL $role
     * @return User
     */
    public static function create(string $name = NULL, string $email = NULL, string $password = NULL, string $role = NULL, $ip = null)
    {
	    $user = User::query()->where('name', $name)->first();


	    if (is_null($user)) {
		    // init Faker
		    $faker = Faker::create();
		    // create new user
		    $user = new User();
		    $user->name = $name ?: $faker->name;
		    $user->email = $email ?: $faker->safeEmail;
		    $user->role = $role ?: User::ROLE_BOT;
		    $user->status = User::STATUS_ACTIVE;
		    $user->password = Hash::make(str_random(8));
		    $user->remember_token = str_random(10);
		    $user->last_login_from = $ip;
		    $user->last_login_at = Carbon::now();
		    $user->save();

		    event(new Registered($user));
	    }

        return $user;
    }

	/**
	 * Create a new user
	 *
	 * @param string|NULL $name
	 * @param string|NULL $email
	 * @param string|NULL $password
	 * @param string|NULL $role
	 * @return User
	 */
	public static function createWithAccount(string $name = NULL, string $email = NULL, string $password = NULL, string $role = NULL, $ip = null)
	{
		$user = User::query()->where('name', $name)->first();


		if (is_null($user)) {
			// init Faker
			$faker = Faker::create();
			// create new user
			$user = new User();
			$user->name = $name ?: $faker->name;
			$user->email = $email ?: $faker->safeEmail;
			$user->role = $role ?: User::ROLE_BOT;
			$user->status = User::STATUS_ACTIVE;
			$user->password = Hash::make(str_random(8));
			$user->remember_token = str_random(10);
			$user->last_login_from = $ip;
			$user->last_login_at = Carbon::now();
			$user->save();

			AccountService::create($user);
			event(new Registered($user));
		}

		return $user;
	}
}