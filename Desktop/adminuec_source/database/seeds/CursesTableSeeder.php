<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curses')->insert([
            'name'=>'1er Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'2do Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'3er Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'4to Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'5to Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'6to Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'7mo Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'8vo Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'9no Grado'
        ]);
        DB::table('curses')->insert([
            'name'=>'1er Año'
        ]);
        DB::table('curses')->insert([
            'name'=>'2do Año'
        ]);
    }
}
