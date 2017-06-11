<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use Illuminate\Http\Request;
class AdminForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker()
    {
        return Password::broker('admins'); //config/auth.php password broker
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email-admin');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request,['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        /*
            broker() as defined above and sendresetlink is in Illuminate/auth/passwords/passwordBroker.php
            this uses notification defined in modal and sends the email.and this controller is over
        */
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
}
