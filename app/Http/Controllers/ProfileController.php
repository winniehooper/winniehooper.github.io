<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var User $user;
     */
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @inheritdoc
     */
    public function callAction($method, $parameters)
    {
        $this->user = Auth::user();
        return parent::callAction($method, $parameters);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $tab = request('tab', 'projects');
        return view('profile.index', ['profile' => $user, 'tab' => $tab]);
    }

    public function bio()
    {
        $profile = User::find(request('client_id'));
        return [
          'status'  => 'success',
          'content' => view('profile.bio', compact('profile'))->render(),
        ];
    }

    public function viewTab(Request $request) {

        $profile = User::findOrFail($request->get('clientId'));
        $tab = explode('/', $request->path())[1];
        return [
          'status'  => 'ok',
          'content' => view('profile.tabs.'.$tab, ['profile' => $profile])->render(),
        ];
    }
}
