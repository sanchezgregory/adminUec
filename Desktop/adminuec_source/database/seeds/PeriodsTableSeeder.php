<?php

use App\Period;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $period = new Period;
        $period->name = '2016-2017';
        $period->active = true;
        $period->save();
    }
}
