<?php

namespace App\Repositories\Category;

use App\Repositories\ModelRepository;
use App\Http\Models\Category;
use App\Http\Models\Book;

class CategoryRepository extends ModelRepository implements CategoryRepoInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getBooksFromCategory($slug, $keywords)
    {
        $data = [
            'slug' => $slug,
        ];
        $category = $this->findByAttrGetOne($data);
        $books = $category->books()->where('name', 'LIKE', "%{$keywords}%")
            ->orderBy('name')->paginate(config('const.take'));

        return $books;
    }
}
