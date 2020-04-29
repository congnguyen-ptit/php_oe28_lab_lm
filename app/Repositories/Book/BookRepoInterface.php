<?php

namespace App\Repositories\Book;

use App\Http\Models\Book;

interface BookRepoInterface
{
    public function findBySlug($slug);

    public function unlikeBook($id, $user_id);

    public function likeBook($id, $user_id);

    public function checkLiked(Book $book, $user_id);

}
