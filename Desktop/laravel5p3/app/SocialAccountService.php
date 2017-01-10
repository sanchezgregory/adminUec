<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook') //-> esto es igual a decir where('provider',$provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $username = explode('@', $providerUser->getEmail());
                $whole_name = explode(' ', $providerUser->getName());

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'first_name' => $whole_name[0],
                    'last_name' => $whole_name[1],
                    'username' => $username[0],
                    'password' => bcrypt($providerUser->getEmail()),
                    'remember_token' => str_random(10),
                    'registration_token' => null
                ]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
