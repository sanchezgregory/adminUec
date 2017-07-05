<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AutocompleteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('users/users?term=Grego')
            ->seeStatusCode(200)
            ->seeJsonEquals(
                [
                    [
                        'first_name' => 'Gregory',
                        'last_name' => 'Sanchez',
                        'email'     => 'admin@admin.com'
                    ]
                ]
            );
    }
}
