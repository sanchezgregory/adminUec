<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChangePasswordTest extends TestCase
{
    use DatabaseMigrations;

    public function testChangePassword()
    {
        $user = $this->createUser('admin');

        $this->actingAs($user)
            ->visit('account')
            ->click('Cambiar password')
            ->seePageIs('account/password')
            ->type("123456", "current_password")
            ->type('newpassword','password')
            ->type('newpassword','password_confirmation')
            ->press('cambiar')
            ->seePageIs('account')
            ->see('Password cambiado');

        $this->assertTrue(
            Hash::check('newpassword', $user->password),
            'Password not match'
        );
    }
}