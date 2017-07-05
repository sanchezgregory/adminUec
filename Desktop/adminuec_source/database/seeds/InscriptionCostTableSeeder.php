<?php

use App\InscriptionCost;
use Illuminate\Database\Seeder;

class InscriptionCostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insc = new InscriptionCost;
        $insc->name = '4200';
        $insc->save();

    }
}
