<?php

namespace tests\Feature;

use EmejiasInventory\Entities\People;
use EmejiasInventory\Entities\{Commerce,OrderType,User};
use Illuminate\Support\Facades\Artisan;
use Tests\FeatureTestCase;

class CreateOrdersTest extends FeatureTestCase
{
    function test_a_user_can_create_a_order()
    {
        //having
        Artisan::call('db:seed', ['--class' => 'OrderTypeTableSeeder']);
        $user 		= $this->defaultUser(['name' => 'Sonia Baldizon']);
        $provider	= factory(People::class)->create(['name' => 'Lab. Prominente', 'type' => 'provider']);
        $comerce 	= factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);
        $this->actingAs($user);

        $fields = [
            'people_id' => $provider->id,
            'priority'  => 'Alta',
       	];
        //having
        $this->visit(route('orders.create'))
        	->see('Orden')
        	->form($fields);
        $this->press('Siguiente');

        //then
        $this->seeInDatabase('orders', $fields);
    }

    function test_form_validation()
    {
        //having
        $user       = $this->defaultUser(['name' => 'Sonia Baldizon']);
        $provider   = factory(User::class)->create(['name' => 'Lab. Prominente']);
        $comerce    = factory(Commerce::class)->create(['name' => 'Centro Medico Maya']);
        $orderType  = factory(OrderType::class)->create(['name' => 'Pedido']);
        $this->actingAs($user);

        //when
        $this->visit(route('orders.create'))
            ->see('Orden')
            ->press('Siguiente');

        //then
        $this->seeErrors([
            'people_id' => 'El campo proveedor es obligatorio.',
        ]);
    }
}
