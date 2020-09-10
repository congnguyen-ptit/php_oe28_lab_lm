<?php

namespace App\Repositories\Category;

interface CategoryRepoInterface
{
    public function getBooksFromCategory($slug, $keywords);
}
