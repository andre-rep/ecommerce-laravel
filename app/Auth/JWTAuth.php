<?php

namespace App\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Mail\MailSend;

class JWTAuth
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function verifyToken()
    {
        //Verify token signature
        $tokenParts = explode('.', $this->token);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signatureProvided = $tokenParts[2];
        $signature = hash_hmac('sha256', $tokenParts[0] . "." . $tokenParts[1], env('JWT_SECRET'), true);
        $base64Signature = base64_encode($signature);
        if($signatureProvided != $base64Signature){
            return false;
        }
        //Verify if token is expired
        $tokenParts = explode('.', $this->token);
        $payloadJson = base64_decode($tokenParts[1]);
        $payloadArrayPhp = json_decode($payloadJson, true);

        if(time() > $payloadArrayPhp['exp']){
            return false;
        }
        //Verify if token is blacklisted
        if(DB::table('token_blacklist')
            ->where('token', '=', $this->token)
            ->exists()){
                return false;
            }

        return true;
    }

    public function verifyAccessLevel()
    {
        //Get the user information from the token
        $providedToken = $this->token;
        $tokenParts = explode('.', $providedToken);
        $jsonPayload = base64_decode($tokenParts[1]);
        $arrayPhpPayload = json_decode($jsonPayload);
        $userEmail = $arrayPhpPayload->email;
        //Fetch user's access level based on his email
        $userAccessLevel = DB::table('users')
            ->where('email', '=', $userEmail)
            ->value('user_access_level');

        return $userAccessLevel;
    }

    public function verifyMail()
    {
        DB::table('users')->where('email', request()->mail)->update(['user_email_verified_at' => date('Y-m-d H:i:s')]);
        return 'Email verificado com sucesso';
    }

    public function mailIsVerified($email)
    {
        $isVerified = DB::table('users')->where('email', $email)->value('user_email_verified_at');
        if($isVerified != null){
            return true;
        }else{
            return false;
        }
    }
}