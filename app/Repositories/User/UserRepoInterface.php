<?php

namespace App\Repositories\User;

interface UserRepoInterface
{
    public function getBooksFromUser($slug, $keywords);
}
