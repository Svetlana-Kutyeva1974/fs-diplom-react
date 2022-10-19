<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use http\Env\Request;
use Illuminate\Http\Request;
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

    /*public function authenticated(Request $request, $user)
    {
        //$credentials = $request->only('email', 'password');
        if(Auth::user()->isAdmin()){
            return redirect()->route('admin.home');
        }
        return redirect('/');
    }*/


     /**
     * Аутентификация пользователя
     */

    public function authenticated(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->isAdmin()){
                return redirect()->route('admin.home');
            }
            return redirect('/');
            //return redirect('/')
               // ->with('success', 'Вы вошли в личный кабинет');
        }

        return redirect()
            ->route('login')
            ->withErrors('Неверный логин или пароль');
    }

}
