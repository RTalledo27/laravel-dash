<?php

namespace Tests\Feature;

use App\Models\Cajas;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\Roles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class dashTest extends TestCase
{
    /**
     * A basic feature test example.
     */

//test productos
public function test_productos_can_load(){
        $user = User::create([
            'usuario' => 'Romaim',
            'nombre' => 'Romaim sg',
            'password' => 'secret',
            'idCaja'=>1,
            'idRol'=>1,
            'activo'=>1,
        ]);
        $this->actingAs($user);

        $producto = Productos::create([
            'id'=>5,
            'idCategoria'=>1,
            'codigo'=>555,
            'nombre'=>'Cereal',
            'precio_compra'=>11,
            'cantidad'=>250,
            'precio_venta'=>12,
            'stock'=>15,
            'unidad'=>'kg',
            'imagen'=>'asasa',
            'activo' => true,
        ]);

        $response = $this->get(route('productos'));

        $response->assertStatus(200);
        $response->assertViewIs('fdlProductos.productos');
        $response->assertViewHas('productos');

}


public function test_route_newProducto(){
    $user = User::create([
        'usuario' => 'Romaim',
        'nombre' => 'Romaim sg',
        'password' => 'secret',
        'idCaja'=>1,
        'idRol'=>1,
        'activo'=>1,
    ]);

    $this->actingAs($user);


     $this->get(route('nuevo-producto'))
     ->assertViewIs('fdlProductos.newProducto')
->assertViewHas('data')
->assertStatus(200);

}


public function test_edit_product_view(){
    $user = User::create([
        'usuario' => 'Romaim',
        'nombre' => 'Romaim sg',
        'password' => 'secret',
        'idCaja'=>1,
        'idRol'=>1,
        'activo'=>1,
    ]);

    $this->actingAs($user);


    $producto = Productos::create([
        'nombre' => 'Producto 1',
        'codigo'=>1231,
        'cantidad' => 10,
        'precio_compra'=>10,
        'precio_venta'=>12,
        'stock'=>4,
        'unidad'=>'kg',
        'idCategoria'=>1,
        'activo'=>1,
        'imagen'=>'images.jpg'

    ]);

     // Llama a la función `editProductos()` con el ID del producto
     $response = $this->get(route('edit-producto', $producto->id));

     // Afirma que la respuesta es una vista
     $response->assertViewIs('fdlProductos.editProducto');

     // Afirma que la respuesta tiene el código de estado correcto
     $response->assertStatus(200);

     // Afirma que la vista tiene los datos correctos
     $response->assertViewHas('data');

}




//
//
//
//

     //Test Clientees
    public function test_clientes_load()
    {
        $user = User::create([
            'usuario' => 'Romaim',
            'nombre' => 'Romaim sg',
            'password' => 'secret',
            'idCaja'=>1,
            'idRol'=>1,
            'activo'=>1,
        ]);

        $this->actingAs($user);


        $this->get('/usuarios')
        ->assertStatus(200)
        ->assertViewIs('fdlUsuarios.dUsuarios')
        //verificar que tenga la data requerida, en este caso titulo y los datos de los usuarios
         ->assertViewHas('data');
}


public function test_route_new_user_exist(){
    $user = User::create([
        'usuario' => 'admin',
        'password' => 'secret',
        'nombre' => 'Romaim',
        'idCaja' => 1,
        'idRol' => 1,
        'activo' => 1,
    ]);

    // Simulamos un inicio de sesión
    $this->actingAs($user);
    $response = $this->get('/usuarios/nuevo')
    ->assertViewIs('fdlUsuarios.newUsuarios')
    ->assertViewHas('data');


    $response->assertStatus(200);
}


    public function test_new_user_created(){
    $user = User::create([
        'usuario' => 'admin',
        'password' => 'secreto27',
        'nombre' => 'Romaim Gianfrancco',
        'idCaja' => 1,
        'idRol' => 1,
        'activo' => 1,
    ]);

    // Simulamos un inicio de sesión
    $this->actingAs($user);

    // Creamos los datos de entrada
    $data = [
        'usuario' => 'admin',
        'password' => 'secreto27',
        'repassword'=>'secreto27',
        'nombre' => 'Romaim Gianfrancco',
        'id_caja' => 1,
        'id_rol' => 1,
        'activo'=>1,

    ];

    // Realizamos una solicitud POST a la ruta `/usuarios/insertar`
    $response = $this->post('/usuarios/insertar', $data);

    // Assertamos que la respuesta tiene un código de estado 201
    $response->assertStatus(302);


    // Assertamos que el usuario fue creado
    $user = User::where('usuario', 'admin')->where('password','secreto27')->first();
    $this->assertNotNull($user);
    $this->assertEquals($data['usuario'], $user->usuario);
    $this->assertEquals($data['password'], $user->password);
    $this->assertEquals($data['nombre'], $user->nombre);
    $this->assertEquals($data['id_caja'], $user->idCaja);
    $this->assertEquals($data['id_rol'], $user->idRol);
    $this->assertEquals($data['activo'], $user->activo);



    // Assertamos que el usuario fue redirigido a la lista de usuarios
         // Redirigimos al usuario a la lista de usuarios
         $response->assertRedirect(route('nuevo-usuario'));




        }








        function test_user_edit(){
            $user = User::create([
                'usuario' => 'admin',
                'password' => 'secret',
                'nombre' => 'Romaim',
                'idCaja' => 1,
                'idRol' => 1,
                'activo' => 1,
            ]);
            $this->actingAs($user);

            $rol = Roles::create([
                'rol'=>'admin',
                'activo'=>1
            ]);


            $cajas = Cajas::create([
                'numero_caja'=>1,
                'nombre' => 'Caja 1',
                'folio'=>1,
                'activo'=>1
            ]);

            $response = $this->get(route('editar-usuarios', $user->id));

            $response->assertViewIs('fdlUsuarios.editUsuarios');
            $response->assertViewHas('data');


    }


    function test_user_edit_save(){

    }





////CATEGORIAS_:


    public function test_categoria_return_correct_view()
    {
        $user =   User::create([
            'usuario' => 'admin',
            'password' => 'secret',
            'nombre' => 'Romaim',
            'idCaja' => 1,
            'idRol' => 1,
            'activo' => 1,
        ]);
        $this->actingAs($user);



        $response = $this->get('/categorias');
        $response->assertStatus(200);
        $response->assertViewIs('fdlCategorias.categorias');
        $response->assertViewHas('categorias');
    }














        }







