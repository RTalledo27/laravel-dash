<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\ProductosController;
use App\Repositories\Productos\ProductosRepository;
use App\Repositories\Categorias\CategoriasRepository;

class actualizarEstadoProductosTest extends TestCase
{
    /**
     * A basic unit test example.
     */

     public function test_actualizarEstado_producto(){

        $prouctosRepositoryMock = $this->createMock(ProductosRepository::class);
         $prouctosRepositoryMock->method('find')->willReturn((object)['id' => 1,'rol'=>'Admin']);
         $prouctosRepositoryMock->method('update')->willReturn(true);
         $this->app->instance(ProductosRepository::class, $prouctosRepositoryMock);
         $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);

    // Simulamos que el usuario está autenticado
    $this->mockAuthCheck(true);

    // Instancia del controlador
    $controller = new ProductosController($prouctosRepositoryMock,$categoriasRepositoryMock);

        // Llamada al método updateCaja
        $request = new Request(['activo'=>0]);
        $response = $controller->actualizarEstado( $request,1);

        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('productos'), $response->getTargetUrl());
        $this->assertEquals('Se ha actualizado el estado del producto', $response->getSession()->get('success'));


    }


    public function test_reingresar_categoria(){
         // Mock del repositorio
    $prouctosRepositoryMock = $this->createMock(ProductosRepository::class);

    // Retorno del mock
    $prouctoMock = (object) ['id' => 1];
    $prouctosRepositoryMock->method('find')->with($prouctoMock->id);

    $prouctosRepositoryMock->method('update')->willReturn(true);

    // Inyectar mock en el app container
    $this->app->instance(CategoriasRepository::class, $prouctosRepositoryMock);
    $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);

    // Simular autenticación
    $this->mockAuthCheck(true);

    // Instanciar controlador
    $controller = new ProductosController($prouctosRepositoryMock,$categoriasRepositoryMock);

    // Llamada al método
    $response = $controller->reingresar(1);

    // Aserciones
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('Se ha actualizado el estado del Producto', $response->getSession()->get('success'));
    $this->assertEquals(route('productos'), $response->getTargetUrl());
    }


    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }
}
