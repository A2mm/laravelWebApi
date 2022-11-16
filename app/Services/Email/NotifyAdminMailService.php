<?php

namespace App\Services\Email;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdminWithPostEmail;

class NotifyAdminMailService
{
    public function __construct()
    {
        $this->model = new User();
    }

    # LOGIN
    public function sendPostEmail($event)
    {

        try{

            $postInfo    = $event->post;

            $admin = $this->model->where('is_admin', 1)->first()->email;

            Mail::to($admin)->send(new NotifyAdminWithPostEmail($postInfo));
        }catch(Exception $exception){

            throw new Exception($exception->getMessage(),$exception->getCode());

        }
    }

}
