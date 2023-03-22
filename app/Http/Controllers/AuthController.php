<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        //Getting data from the user
        $email = $request->email;
        $password = $request->password;

        //Validating credentials by exising and their types
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required']
            ],
            [
                'email.required' => 'O campo email não pode estar vazio',
                'password.required' => 'O campo senha não pode estar vazio'
            ]
        );

        //Attempt to login
        if(Auth::attempt(['email' => $email, 'password' => $password, 'user_status' => 0])){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        //Error if credentials are incorrect
        return back()->withErrors([
            'email' => 'Email ou senha estão incorretos.'
        ]);
    }

    public function register(Request $request)
    {
        //Getting data from the user
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        //Validate data from the user
        $credentials = $request->validate(
            [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required']
            ],
            [
                'name.required' => 'O campo nome não pode estar vazio',
                'email.required' => 'O campo email não pode estar vazio',
                'password.required' => 'O campo senha não pode estar vazio'
            ]
        );

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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

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
