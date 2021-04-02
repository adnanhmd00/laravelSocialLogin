<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    public function callback($provider)
    {   
        $getInfo = Socialite::driver($provider)->user();   
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->to('/home');
    }
    function createUser($getInfo,$provider){
    $user = User::where('provider_id', $getInfo->id)->first();
    if (!$user) {
        $user = User::create([
           'name'     => $getInfo->name,
           'email'    => $getInfo->email,
           'provider' => $provider,
           'provider_id' => $getInfo->id
       ]);
     }
     return $user;
   }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
