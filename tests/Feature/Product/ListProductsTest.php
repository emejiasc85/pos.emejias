<?php

namespace tests\Feature;

use EmejiasInventory\Entities\{Product,ProductGroup, ProductPresentation, UnitMeasure, Make};
use Tests\FeatureTestCase;

class ListProductsTest extends FeatureTestCase
{
    function test_a_user_can_see_products_list()
    {
        //having
        $product = factory(Product::class)->create();

        $this->actingAs($this->defaultUser())
        ->visit(route('products.index'))
        ->see('Productos')
        ->seeInElement('td', $product->name);
    }

    function test_a_user_can_paginate_products()
    {
    	//having
        $first_product = factory(Product::class)->create(['name' => 'Alka']);
        $products = factory(Product::class)->times(15)->create();
        $last_product = factory(Product::class)->create(['name' => 'Acetaminofen']);

        $this->actingAs($this->defaultUser())
        ->visit(route('products.index'))
        ->see('Productos')
        ->seeInElement('td', $last_product->name)
        ->dontSeeInElement('td', $first_product->name)
        ->click('2')
        ->seeInElement('td', $first_product->name)
        ->dontSeeInElement('td', $last_product->name);
    }

    function test_a_user_can_search_a_product()
    {
    	//having
        $group = factory(ProductGroup::class)->create();
        $make = factory(Make::class)->create();

        $presentation = factory(ProductPresentation::class)->create();
        $unit = factory(UnitMeasure::class)->create();
        $first_product = factory(Product::class)->create([
            'name' => 'Alka',
            'product_presentation_id' => $presentation->id,
            'product_group_id' => $group->id,
            'unit_measure_id' => $unit->id,
            'make_id' => $make->id
        ]);
        $products = factory(Product::class)->times(15)->create();
        $last_product = factory(Product::class)->create(['name' => 'Acetaminofen']);
        $this->actingAs($this->defaultUser())
        ->visit(route('products.index'))
        ->see('Productos')
        ->type($first_product->barcode, 'barcode')
        ->select($group->id, 'product_group_id')
        ->select($presentation->id, 'product_presentation_id')
        ->select($unit->id, 'unit_measure_id')
        ->select($make->id, 'make_id')
        ->press('Buscar')
        ->seeInElement('td', $first_product->name)
        ->dontSeeInElement('td', $last_product->name);

    }
}
