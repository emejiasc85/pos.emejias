<?php

namespace tests\Feature;
use Tests\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_login()
    {
        //having
        $user = $this->defaultUser([
        	'name' => 'Enrique Mejias',
        	'email'	=> 'emejiasc85@gmail.com'
        ]);


        //when
        $this->visit('/login')
        	->type($user->email, 'login')
        	->type('secret', 'password')
        	->press('Ingresar');

        //then
        $this->seeIsAuthenticatedAs($user);
        $this->seePageIs(route('index'));
        //->see('Enrique Mejias');

    }
}
