<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password; //will be using password-brokers to identify/configure which type of user to deal with
use Auth;
use Illuminate\Http\Request;
class AdminResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords; /*it contains all the functions like reset etc. which are not implemented*/

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guard()
    {
        return Auth::guard('admin'); /*Auth::guard('admin') *this thing is same as using function defined above as guard()* ->attempt(['email' => $request->email, 'password' =>$request->password],$request->remember))*/
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-admin')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
