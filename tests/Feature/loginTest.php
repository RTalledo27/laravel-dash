<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login_index_route_exist()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Usuario');

        $response->assertSee('Contraseña');
        $response->assertSee('Ingresar');
        $response->assertSee('Tienda Karina Store');

         //Verifica que view nos devuelve


    }


    public function test_login_post_route_exist(){
        $response=  $this->post('/login');

        $response -> assertStatus(302);
    }


    public function test_login_valid_credentials()
{    // Crea un usuario en la base de datos
    $user = User::create([
        'usuario' =>
        'Romaim',
        'nombre' => 'Romaim',
        'password' => 'secret',
        'idCaja'=>1,
        'idRol'=>1,
        'activo'=>1,
    ]);

    // Envía una solicitud POST a la ruta de inicio de sesión
    $response = $this->post('/login', [
        'usuario' => $user->usuario,
        'password' => 'secret',


    ]);

    // Comprueba que la solicitud se ha realizado correctamente
    $response->assertStatus(302);

    // Comprueba que el usuario está autenticado
    $this->assertTrue(auth()->check());

    // Comprueba que el usuario ha sido redirigido a la página principal
    $response->assertRedirect('/dashboard');

}


public function test_required_fields(){
    $response =  $this->post('/login',[
        'usuario'=>'',
        'password'=>'',

    ]);

    //ESTADO 200, RESPUESTA EXITOSA
    $response->assertStatus(302);

     // Verifica que se muestren mensajes de error de validación para los campos
     $response->assertSessionHasErrors(['usuario', 'password']);

}



public function test_hash_class_exists()
{
    $this->assertTrue(class_exists('Hash'));
}
}
