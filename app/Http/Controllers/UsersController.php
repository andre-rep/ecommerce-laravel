<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Auth\JWTAuth;
use App\Users\UserContract;
use App\Directories\PublicDirectory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUserEmail()
    {
        //Get the user information from the token
        $providedToken = request()->cookie('access-token');
        $tokenParts = explode('.', $providedToken);
        $jsonPayload = base64_decode($tokenParts[1]);
        $arrayPhpPayload = json_decode($jsonPayload);
        $userEmail = $arrayPhpPayload->email;
        return $userEmail;
    }

    public function getUserId()
    {
        return User::where('email', '=', $this->getUserEmail())
            ->value('id');
    }

    public function getUserName()
    {
        return User::where('email', '=', $this->getUserEmail())
            ->value('name');
    }

    public function insertPhone()
    {
        $phoneNumber = request()->phoneNumber;

        User::where('id', $this->getUserId())
            ->update(['user_phone' => $phoneNumber]);

        return 'Phone number recorded';
    }

    public function insertEmail()
    {
        $emailAddress = request()->emailAddress;

        User::where('id', $this->getUserId())
            ->update(['email' => $emailAddress]);

        return 'Email address updated';
    }

    public function updateAddress()
    {
        $cep = request()->cep;
        $street = request()->street;
        $neighbourhood = request()->neighbourhood;
        $number = request()->number;
        $complement = request()->complement;
        //Update users address details
        User::where('id', $this->getUserId())
            ->update([
                'user_address_cep' => $cep,
                'user_address_street' => $street,
                'user_address_neighbourhood' => $neighbourhood,
                'user_address_number' => $number,
                'user_address_complement' => $complement
            ]);

        return 'Home address updated';
    }

    public function insertProfileImage()
    {
        $publicFile = new PublicDirectory('profileImage/');
        $profileImageUrl = $publicFile->fileUpload(request()->file);
        User::where('id', $this->getUserId())
            ->update(['user_profile_image_url' => $profileImageUrl]);
        
        return 'Uploaded to ' . $profileImageUrl;
    }

    public function alterUserStatus()
    {
        User::where('email', '=', request()->userEmail)
            ->update(['user_status' => request()->userStatus]);
        
        return 'User status successfully updated';
    }
}
