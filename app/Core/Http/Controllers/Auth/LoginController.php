<?php

namespace Boostcsgo\Core\Http\Controllers\Auth;

use Boostcsgo\Core\Http\Controllers\Controller;
use Boostcsgo\Core\Support\LoginRedirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected string $redirectTo = '/home';

    /**
     * @var LoginRedirect
     */
    private LoginRedirect $loginRedirect;

    /**
     * Create a new controller instance.
     *
     * @param LoginRedirect $loginRedirect
     */
    public function __construct(LoginRedirect $loginRedirect)
    {
        $this->middleware('guest')->except('logout');
        $this->loginRedirect = $loginRedirect;
    }

    public function redirectTo()
    {
        return $this->loginRedirect->getPath(auth()->user());
    }
}
