<?php

namespace App\Http\Controllers;

use App\Mail\MailContract;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendEmail(MailContract $mailContract){
        return $mailContract->send();
    }

    public function recoverMail(MailContract $mailContract, $mail)
    {
        return $mailContract->recoverMail();
    }

    public function getPasswordRecoverLink(MailContract $mailContract)
    {
        return $mailContract->getPasswordRecoverLink();
    }
}