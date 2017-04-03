<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Social;
use Auth;
use Socialite;
use Illuminate\Support\Facades\DB;
use App\User;


class AuthController extends Controller
{

    public $redirectTo = '/';

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     *
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     *
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = DB::table('users')
                      ->join('user_auth', 'users.id', '=', 'user_auth.user_id')
                      ->where('provider_id', $user->id)
                      ->where('provider', $provider)
                      ->first();


        if ($authUser) {
            return User::find($authUser->id);
        }

        $reg_user = User::whereEmail($user->email)->first();

        if (!$reg_user) {
            $password = str_random(6);

            $reg_user = User::create(
              [
                'name'      => $user->name,
                'email'     => $user->email,
                'confirmed' => 1,
                'password'  => bcrypt($password),
              ]
            );
        }

        Social::create(
          [
            'user_id'     => $reg_user->id,
            'provider'    => $provider,
            'provider_id' => $user->id,
          ]
        );


        return $reg_user;
    }
}