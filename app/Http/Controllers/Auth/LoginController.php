<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
 use App\User;
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

//     public function redirect($provider)
//     {
//         // dd(Socialite::driver($provider)->redirect());
//         return Socialite::driver($provider)->redirect();
//     }
//     public function callback($provider)
//     {
//         $getInfo = Socialite::driver($provider)->user();
//         dd($getInfo);
//            // return view('auth.register' , ['Name' => $getInfo->name , 'Email'=> $getInfo->email]);
//         $user = $this->createUser($getInfo,$provider); 

//         auth()->login($user); 
        
//         return redirect()->to('/home');

//     }
//  function createUser($getInfo,$provider){
//  $user = User::where('provider_id', $getInfo->id)->first();
//  if (!$user) {
//       $user = User::create([
//          'name'     => $getInfo->name,
//          'email'    => $getInfo->email,
//          'provider' => $provider,
//          'provider_id' => $getInfo->id
//      ]);
//    }
//    return $user;
//  }
}
