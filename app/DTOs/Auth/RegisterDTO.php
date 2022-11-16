<?php

namespace App\DTOs\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterDTO extends DataTransferObject
{
    /**
     * @var string $name
     */

    public $name;

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

}
