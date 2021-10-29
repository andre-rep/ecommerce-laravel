<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        //Getting data from the user
        $email = $request->email;
        $password = $request->password;

        //Validating credentials by exising and their types
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //Attempt to login
        if(Auth::attempt(['email' => $email, 'password' => $password, 'user_status' => 0])){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        //Error if credentials are incorrect
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    public function register()
    {
        //Getting data from the user
        $name = request()->name;
        $email = request()->email;
        $password = Hash::make(request()->password);

        //Insert new user in users table
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        //If the data is inserted successfully, create a temporary link to be sent via email
        $url = URL::temporarySignedRoute(
            'activateLink', now()->addMinutes(30), ['mail' => $email]
        );

        //Send the created link to the user's email
        $mailSend = new MailSend();
        $mailSend->send($email, $url, 'Confirmação de email');

        return 'Email de confirmação enviado para o email: ' . $email;
    }

    public function logout()
    {
        Auth::logout();

        $request()->session()->invalidate();

        $request()->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     *//*
    public function login()
    {
        //Get the data from the user
        $credentials = request(['email', 'password']);

        //Verify if the credentials are correct
        if(!$token = auth()->attempt($credentials)){
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        //Generate new signature for the token, thus generating a new token
        $tokenParts = explode('.', $token);
        $payloadJson = base64_decode($tokenParts[1]);
        $payloadArrayPhp = json_decode($payloadJson, true);
        $payloadArrayPhp['email'] = request()->email;
        $payloadJson = json_encode($payloadArrayPhp, true);
        $payloadBase64 = base64_encode($payloadJson);
        
        $signature = hash_hmac('sha256', $tokenParts[0] . "." . $payloadBase64, env('JWT_SECRET'), true);
        $tokenParts[2] = base64_encode($signature);
        $tokenParts[1] = $payloadBase64;
        $finalToken = implode('.', $tokenParts);

        //Make the login by responding the request with the token
        return response()->json([
            'access_token' => $finalToken,//$token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }*/

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     *//*
    public function logout()
    {
        //Blacklist the token
        DB::insert('insert into token_blacklist
            (token) values (?)',
            [request()->cookie('access-token')]
        );
    }*/

    public function verifyMail()
    {
        User::where('email', request()->mail)
            ->update([
                'email_verified_at' => date('Y-m-d H:i:s'),
                'user_status' => 0
            ]);
        return 'Email verificado com sucesso';
    }
}
