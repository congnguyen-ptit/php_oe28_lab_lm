<?php

namespace App\Repositories\Publisher;

interface PublisherRepoInterface
{
    public function getBooksFromPublisher($slug, $keywords);
}
