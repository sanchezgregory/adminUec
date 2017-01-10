<?php
use App\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuTest extends TestCase
{
    use DatabaseMigrations;

    public function testAccountLink()
    {
        // Guest user
        $this->visit('/')->dontSee('Account');

        // create user
        $user = $this->createUser();


        $this->actingAs($user)
            ->visit('/')
            ->see('Account');

        $this->click('Account')->seePageIs('account')->see('ACCOUNT');

    }

}