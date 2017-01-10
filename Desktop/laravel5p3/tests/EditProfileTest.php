<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function test()
    {
        $user = $this->createUser('admin');

        $this->actingAs($user)
            ->visit('account')
            ->click('Editar perfil')
            ->seePageIs('account/edit-profile')
            ->seeInField('username', 'mcgregox')
            ->type('.mcgregox.', 'username')
            ->press('Aceptar')
            ->seePageIs('account')
            ->see('Perfil cambiado')
            ->seeInDatabase('users', [
                'email' => $user->email,
                'username' => '.mcgregox.'
            ]);

    }
}