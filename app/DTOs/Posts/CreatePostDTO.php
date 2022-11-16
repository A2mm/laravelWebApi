<?php

namespace App\DTOs\Posts;

use Spatie\DataTransferObject\DataTransferObject;


class CreatePostDTO extends DataTransferObject
{
    /**
     * @var string $title
     */

    public $title;

     /**
     * @var string $description
     */

    public $description;

    /**
     * @var string $image
     */

    public $image;

     /**
     * @var string $phone_number
     */

    public $phone_number;

}
