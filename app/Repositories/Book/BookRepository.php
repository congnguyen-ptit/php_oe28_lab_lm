<?php

namespace App\Repositories\Book;

use App\Repositories\ModelRepository;
use App\Http\Models\Book;
use Illuminate\Support\Str;

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

    public function update($id, $data = []){
        $book = $this->findById($id);
        if ($data['image'] == null) {
            $file = $book->image;
        } else {
            $file = 'images/'.$data['image'];
        }
        $book->name = $data['name'];
        $book->slug = Str::slug($data['name']);
        $book->content = $data['content'];
        $book->description = $data['description'];
        $book->image = $file;
        $book->quantity = $data['quantity'];
        $book->category_id = $data['category_id'];
        $book->user_id = $data['user_id'];
        $book->publisher_id = $data['publisher_id'];
        $book->save();
    }
}
