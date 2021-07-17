<?php

namespace Tests\Feature;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $invisibleMaterial=Material::factory()->create(['is_visible'=>false,'description'=>uniqid(),'is_available'=>true,'name'=>uniqid()]);
        $visibleMaterial=Material::factory()->create(['is_visible'=>true,'description'=>uniqid(),'is_available'=>true,'name'=>uniqid()]);

        $unavailableMaterial=Material::factory()->create(['is_visible'=>true,'description'=>uniqid(),'is_available'=>false,'name'=>uniqid()]);
        $availableMaterial=Material::factory()->create(['is_visible'=>true,'description'=>uniqid(),'is_available'=>true,'name'=>uniqid()]);

        $response = $this->get('api/material?limit=1000&offset=0');


        $response->assertDontSee($visibleMaterial->description);
        $response->assertDontSee($availableMaterial->description);
        $response->assertDontSee($invisibleMaterial->description);
        $response->assertDontSee($unavailableMaterial->description);
        $response->assertStatus(200);
    }
}
