<?php

namespace App\DTOs\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class ForgetPasswordDTO extends DataTransferObject
{

     /**
     * @var string $email
     */

    public $email;

}
