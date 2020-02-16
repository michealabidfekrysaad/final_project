<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Exception;
use App\User;
use Spatie\Permission\Models\Role;
    use Illuminate\Http\Request;;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, User $user) {
        if ($user && $user->isBanned()) {
            Auth::logout();
            return redirect('/login')->with(
                'message', 'This account is blocked for Reporting');
        }
        return redirect()->intended($this->redirectPath());
    }
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();//info user
        $existUser = User::where('email', $userSocial->email)->first();
        if ($existUser && $existUser->isBanned()) {
            Auth::logout();
            return redirect('/login')->with(
                'message', 'This account is blocked for Reporting');
        }
        else if($existUser) {
            Auth::loginUsingId($existUser->id);
            return redirect()->to('/');
        }
        else{
            return redirect()->to('/register');

        }
    }


}
