<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Location::class, 10)->create();
    }
}
