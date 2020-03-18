<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Publisher;

class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Publisher::class, 10)->create();
    }
}
