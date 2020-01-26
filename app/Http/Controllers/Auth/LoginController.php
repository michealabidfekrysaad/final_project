<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Auth;
use Exception;
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
    
            $finduser = User::where('google_id', $user->id)->first();
    
            if($finduser){
    
                Auth::login($finduser);

                return redirect('/');
    
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make('a1234567'),
                    'phone' => 'null',
                    'city' => 'null',
                    'region' => 'null',
                    'google_id'=> $user->id
                ]);

                Auth::login($newUser);
    
                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handleFacebookCallback()
    // {
    //     try {

    //         $user = Socialite::driver('facebook')->user();
    
    //         $finduser = User::where('facebook_id', $user->id)->first();
    
    //         if($finduser){
    
    //             Auth::login($finduser);

    //             return redirect('/home');
    
    //         }else{
    //             $newUser = User::create([
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'password' => Hash::make('a1234567'),
    //                 'phone' => 'null',
    //                 'city' => 'null',
    //                 'region' => 'null',
    //                 'facebook_id'=> $user->id
    //             ]);

    //             Auth::login($newUser);
    
    //             return redirect('/home');
    //         }

    //     } catch (Exception $e) {
    //         dd($e->getMessage());
    //     }
    // }
}
