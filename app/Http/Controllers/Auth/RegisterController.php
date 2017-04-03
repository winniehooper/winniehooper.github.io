<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserEmailConfirm;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

	protected function getToken()
	{
		return hash_hmac('sha256', str_random(40), config('app.key'));
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function ajaxRegistration()
	{
		$data = request(['nick', 'email', 'password', 'password_confirm']);

		if (User::whereEmail($data['email'])->first()) {
			return ['status'=>'error-save', 'errText'=>'Клиент с таким логином существует.', 'errCode'=>54];
		}

		if ($data['password' != $data['password_confirm']]) {
			return ['status'=>'error-save', 'errText'=>'Пароли не совпадают.', 'errCode'=>55];
		}

		$confirmation_code = $this->getToken();

		$user =  User::create([
			'name' => $data['nick'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'confirmation_code' => $confirmation_code
		]);

		Mail::to($user)->send(new UserEmailConfirm($user));

		return ['status' => 'ok'];
	}

    protected function simplyRegistration()
    {
        if (User::whereEmail(request('email'))->first()) {
            return ['status'=>'error-save', 'errText'=>'Клиент с таким емейлом существует.', 'errCode'=>54];
        }

        if (User::whereName(request('fio'))->first()) {
            return ['status'=>'error-save', 'errText'=>'Клиент с таким логином существует.', 'errCode'=>54];
        }

        $confirmation_code = $this->getToken();

        $user =  User::create([
          'name' => request('fio'),
          'email' => request('email'),
          'password' => '',
          'confirmation_code' => $confirmation_code
        ]);

        Auth::login($user);

        Mail::to($user)->send(new UserEmailConfirm($user));

        return ['status' => 'ok'];
    }


	public function confirm($confirmation_code)
	{
		if( ! $confirmation_code)
		{
			throw new AccessDeniedException();
		}

		$user = User::whereConfirmationCode($confirmation_code)->first();

		if ( ! $user)
		{
			throw new AccessDeniedException();
		}

		$user->confirmed = 1;
		$user->confirmation_code = null;
		$user->save();

		set_message('Активация прошла успешно');

		return redirect('login');
	}
}
