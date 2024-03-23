<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\ProductosController;
use App\Repositories\Productos\ProductosRepository;
use App\Repositories\Categorias\CategoriasRepository;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\productosTest as FeatureProductosTest;

class ProductosTest extends TestCase
{


    public function test_index_returns_view_if_authenticated_with_data(){

        // Mock the authentication check
   $this->mockAuthCheck(true);

   // Mock the UserRepository
   $productosRepositoryMock = $this->createMock(ProductosRepository::class);
   $categoriassRepositoryMock = $this->createMock(CategoriasRepository::class);
   $this->app->instance(ProductosRepository::class, $productosRepositoryMock);


   $productosActivos=[
    (object) ['codigo'=>'LA001', 'nombre'=>'LecheGloria', 'precio_compra'=>15.0, 'precio_venta'=>16.0, 'stock'=>4, 'cantidad'=>1.5, 'unidad'=>'Lt','idCategoria'=>1, 'imagen'=>'gloria.jpg','activo'=>1],

   ];

   $productosRepositoryMock->method('findByState')
   ->with(1)
   ->willReturn(
    $productosActivos
);



   // Probar el método index
   $controller = new ProductosController($productosRepositoryMock,$categoriassRepositoryMock);

     // Llamar al método index()
     $response = $controller->index();

     $this->assertInstanceOf(View::class, $response);
     $this->assertEquals('fdlProductos.productos', $response->getName());



     $productos = $response->getData();
     $this->assertEquals($productosActivos, $productos['productos']);

    }


    protected function mockAuthCheck($result)
   {
       // Simula el método auth()->check() devolviendo el resultado deseado
       Auth::shouldReceive('check')->andReturn($result);

   }

}
