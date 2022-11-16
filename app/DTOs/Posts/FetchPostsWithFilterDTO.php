<?php

namespace App\DTOs\Posts;

use Spatie\DataTransferObject\DataTransferObject;


class FetchPostsWithFilterDTO extends DataTransferObject
{
    /**
     * @var string $search
     */

    public $search;

    /**
     * @var integer $user_id
     */

    public $user_id;

}
