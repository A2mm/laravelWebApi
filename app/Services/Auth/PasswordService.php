<?php

namespace App\Services\Auth;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\DTOs\Auth\{ResetPasswordDTO, ForgetPasswordDTO};
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordService
{
    public function __construct()
    {
        $this->model = new User();
    }

    # resetPassword

    public function forgetPassword(ForgetPasswordDTO $forgetPasswordDTO)
    {
        $this->sendMail($forgetPasswordDTO->email);

        return response()->json([
                'message' => 'Check your inbox, we have sent a link to reset email.'
            ], Response::HTTP_OK);

    }


    public function sendMail($email)
    {
        $token = $this->generateToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }


    public function generateToken($email)
    {
      $isOtherToken = DB::table('password_resets')->where('email', $email)->first();
      if($isOtherToken) {
        return $isOtherToken->token;
      }
      $token = Str::random(80);;
      $this->storeToken($token, $email);
      return $token;
    }


    public function storeToken($token, $email)
    {
        DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' => Carbon::now()]);
    }

    public function resetPassword(ResetPasswordDTO $resetPasswordDTO)
    {
        $this->checkTokenExists($resetPasswordDTO);

        return response()->json([
                'message' => 'Your password has been changed.'
            ], Response::HTTP_OK);
    }

    public function checkTokenExists(ResetPasswordDTO $resetPasswordDTO)
    {
        $updatePassword = DB::table('password_resets')->where(['email' => $resetPasswordDTO->email, 'token' => $resetPasswordDTO->token])->first();

        if(!$updatePassword){
            return response()->json([
                'message' => 'Invalid Token'
            ], Response::HTTP_BAD_REQUEST);
        }

        $this->updatePassword($resetPasswordDTO);
    }

    public function updatePassword(ResetPasswordDTO $resetPasswordDTO)
    {
        $this->model->where('email', $resetPasswordDTO->email)->update(['password' => bcrypt($resetPasswordDTO->password)]);

        DB::table('password_resets')->where(['email'=> $resetPasswordDTO->email])->delete();

    }

}
