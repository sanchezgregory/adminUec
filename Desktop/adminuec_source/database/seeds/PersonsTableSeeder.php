<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Person::class)->create([
            'cedula' => '24100200',
            'email' => 'admin@admin.com',
            'first_name' => 'Pedro',
            'last_name' => 'Perez',
            'phone' => '04165554433',
            'phone_home' => '02464315566',
            'address' => 'San Juan de los Morros',
            'role' => 'worker'
        ]);

        factory(App\Person::class,10)->create();
    }
}
