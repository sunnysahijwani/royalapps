<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = "/dasboard";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Validates the login request and performs the login process.
     *
     * @param Request $request The HTTP request object containing the login credentials.
     * @return \Illuminate\Http\RedirectResponse The response redirecting the user after login.
     */
    public function login(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        // Attempt to authenticate the user with provided email and password
        $response = Http::withHeaders([

            "Content-Type" => "application/json",

        ])->post(config('royalapp.api_v2.url') . "/token", [

                    "email" => $request->email,
                    "password" => $request->password

                ]);

        // if the request was successful we will get the token from the response body and save in session storage
        if ($response->status() === 200) {
            $response = $response->json();
            if ($request->hasSession()) {
                session([
                    'token_key' => $response['token_key'],
                    'user' => $response['user'],
                    "refresh_token_key" => $response['refresh_token_key'],
                    "expires_at" => $response['expires_at'],
                    "refresh_expires_at" => $response['refresh_expires_at'],
                ]);
            }
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
