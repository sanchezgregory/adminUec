<?php

use App\Cost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cost = new Cost();
        $cost->name = '4500';
        $cost->save();

        $cost = new Cost();
        $cost->name = '5500';
        $cost->save();

        $cost = new Cost();
        $cost->name = '5700';
        $cost->save();
    }
}
