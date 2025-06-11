<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\app\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;

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
        // $this->middleware('guest');
    }

    //  public static function middleware()
    // {
    //     return [
    //         new Middleware(middleware: 'guest'),
    //     ];
    // }

    public function showRegisterForm()
    {
        return view('frontend.auth.register');
    }

    public function register(Request $request)
{
    // if (auth()->check()) {
    //     return redirect()->route('dashboard'); // or wherever you want to send them
    // }
    $validated = $request->validate([
        'name'=>'required|string|max:255',
        'email'=>'required|email|unique:users',
        'password'=>'required|string|min:6|confirmed',
        'phone'=>'required|unique:users'
    ]);

    $validated['password']= Hash::make($request->password);
    $user = User::create($validated);
    Auth::login($user);

    return redirect()->route('showLoginForm');
}
}
