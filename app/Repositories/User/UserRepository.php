<?php

namespace App\Repositories\User;

use App\Repositories\ModelRepository;
use App\Http\Models\User;
use App\Http\Models\Book;

class UserRepository extends ModelRepository implements UserRepoInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getBooksFromUser($slug, $keywords)
    {
        $data = [
            'slug' => $slug,
        ];
        $user = $this->findByAttrGetOne($data);
        $books = $user->books()->where('name', 'LIKE', "%{$keywords}%")
            ->orderBy('name')->paginate(config('const.take'));

        return $books;
    }
}
