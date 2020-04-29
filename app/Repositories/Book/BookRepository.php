<?php

namespace App\Repositories\Book;

use App\Repositories\ModelRepository;
use App\Http\Models\Book;

class BookRepository extends ModelRepository implements BookRepoInterface
{
    public function getModel()
    {
        return Book::class;
    }

    public function findBySlug($slug)
    {
        $result = $this->model->where('slug', $slug)->firstOrFail();

        return $result;
    }

    public function unlikeBook($id, $user_id)
    {
        $book = $this->findById($id);
        $book->likedUsers()->detach($user_id);
    }

    public function likeBook($id, $user_id)
    {
        $book = $this->findById($id);
        $book->likedUsers()->attach($user_id);
    }

    public function checkLiked(Book $book, $user_id)
    {
        return $book->likedUsers()->wherePivot('user_id', $user_id)->exists();
    }
}
