<?php

use App\Representant;
use Illuminate\Database\Seeder;

class RepresentantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Representant::class, 5)->create();
    }
}
