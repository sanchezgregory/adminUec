<?php

use App\Proffession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProffessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proffessions')->insert([
            'name' => 'Bachillerato',
        ]);
        DB::table('proffessions')->insert([
            'name' => 'Tecnico',
        ]);
        DB::table('proffessions')->insert([
            'name' => 'Universitario',
        ]);
        DB::table('proffessions')->insert([
            'name' => 'PostGrado',
        ]);
        DB::table('proffessions')->insert([
            'name' => 'Sin estudios',
        ]);
    }
}
