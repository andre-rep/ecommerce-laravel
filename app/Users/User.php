<?php

namespace App\Users;

use App\Auth\JWTAuth;
use App\Directories\PublicDirectory;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\DB;

class User
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getUserEmail()
    {
        //Get the user information from the token
        $providedToken = $this->token;
        $tokenParts = explode('.', $providedToken);
        $jsonPayload = base64_decode($tokenParts[1]);
        $arrayPhpPayload = json_decode($jsonPayload);
        $userEmail = $arrayPhpPayload->email;
        return $userEmail;
    }

    public function getUserId()
    {
        return UserModel::where('email', $this->getUserEmail())
            ->value('id');
        /*return DB::table('users')
            ->where('email', '=', $this->getUserEmail())
            ->value('id');*/
    }

    public function getUserName()
    {
        return UserModel::where('email', $this->getUserEmail())
            ->value('name');
    }
}