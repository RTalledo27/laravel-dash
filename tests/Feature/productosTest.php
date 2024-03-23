<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class productosTest extends TestCase
{
    

    //use RefreshDatabase;



    public function test_index(){
        $user = User::create([
        'usuario' => 'Romaim',
        'nombre' => 'Romaim sg',
        'password' => 'secret',
        'idCaja'=>1,
        'idRol'=>1,
        'activo'=>1,
        ]);

        $this->actingAs($user);

        $response = $this->get('/productos');

        $response->assertStatus(200);

        $response->assertViewIs('fdlProductos.productos');

        $response->assertViewHas('productos');
    }

}
