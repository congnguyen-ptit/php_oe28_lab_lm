<?php

namespace App\Repositories\Book;

use App\Http\Models\Book;
use App\Http\Models\BorrowerRecord;

interface BookRepoInterface
{
    public function findBySlug($slug);

    public function unlikeBook($id, $user_id);

    public function likeBook($id, $user_id);

    public function checkLiked(Book $book, $user_id);

    public function getLatestBook();

    public function updateBorrow($id, $quantity, BorrowerRecord $borrower_record);

    public function updateReturn($id, $quantity, BorrowerRecord $borrower_record);
}
