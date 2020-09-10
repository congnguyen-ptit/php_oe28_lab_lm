<?php

namespace App\Repositories\Publisher;

use App\Repositories\ModelRepository;
use App\Http\Models\Publisher;
use App\Http\Models\Book;
use Illuminate\Support\Str;

class PublisherRepository extends ModelRepository implements PublisherRepoInterface
{
    public function getModel()
    {
        return Publisher::class;
    }

    public function getBooksFromPublisher($slug, $keywords)
    {
        $data = [
            'slug' => $slug,
        ];
        $publisher = $this->findByAttrGetOne($data);
        $books = $publisher->books()->where('name', 'LIKE', "%{$keywords}%")
            ->orderBy('name')->paginate(config('const.take'));

        return $books;
    }

    public function update($id, $data = [])
    {
        $publisher = $this->findById($id);
        $publisher->name = $data['name'];
        $publisher->slug = Str::slug($data['name']);
        $publisher->location = $data['location'];
        $publisher->save();
    }
}
