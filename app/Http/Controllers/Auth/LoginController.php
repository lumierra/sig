<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

   public function showLoginForm()
   {
       return view('loginForm');
   }

    public function redirectTo()
    {
        $user = User::find(Auth::user()->id);
        if($user->hasRole('admin')){
            $this->redirectTo = route('admin.dashboard.index');
            return $this->redirectTo;
        }
        else {
            $this->redirectTo = route('guest');
            return $this->redirectTo;
        }

        $this->redirectTo = route('home');

        return $this->redirectTo;
    }
}
