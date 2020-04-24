<?php

namespace App\Repositories\Book;

interface BookRepoInterface
{
    public function findBySlug($slug);

    public function unlikeBook($id, $user_id);

    public function likeBook($id, $user_id);

}
