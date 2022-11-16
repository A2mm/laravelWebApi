<?php

namespace App\DTOs\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class LoginDTO extends DataTransferObject
{
    /**
     * @var string $password
     */

    public $password;

     /**
     * @var string $email
     */

    public $email;

}
