<?php

use App\User;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function createUser($role)
    {
        return factory(User::class)->create([
            'first_name' => 'Gregory',
            'last_name' => 'Sanchez',
            'username' => 'mcgregox',
            'email' => 'mcgregox@gmail.com',
            'role' => $role,
            'active' => true,
            'password' => bcrypt('123456')
        ]);
    }


}
