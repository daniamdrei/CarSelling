<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use ErrorException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    //   public static function middleware()
    // {
    //     return [
    //         new Middleware(middleware: 'guest', except: ['logout']),
    //         new Middleware(middleware: 'auth', only: ['logout']),
    //     ];
    // }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
        'email'=>'required|email',
        'password'=>'required|string|min:6'
    ]);

    if(Auth::attempt($validated)){

        $request->session()->regenerate();
         return redirect()->route('home');
    }

    throw ValidationException::withMessages([
        'credential'=>'Sorry, incorrect credential !'
    ]);
    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

}
