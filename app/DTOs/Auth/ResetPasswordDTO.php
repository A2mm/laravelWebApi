<?php

namespace App\DTOs\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class ResetPasswordDTO extends DataTransferObject
{

     /**
     * @var string $email
     */

    public $email;

    /**
     * @var string $password
     */

    public $password;

    /**
     * @var string $password_confirmation
     */

    public $password_confirmation;

    /**
     * @var string $token
     */

    public $token;

}
