<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CategoriasController;
use App\Repositories\Categorias\CategoriasRepository;

class atualizarEstadoCategoriasTest extends TestCase
{

    public function test_actualizarEstado_categoria(){

        $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);
         $categoriasRepositoryMock->method('find')->willReturn((object)['id' => 1,'rol'=>'Admin']);
         $categoriasRepositoryMock->method('update')->willReturn(true);
         $this->app->instance(CategoriasRepository::class, $categoriasRepositoryMock);

    // Simulamos que el usuario está autenticado
    $this->mockAuthCheck(true);

    // Instancia del controlador
    $controller = new CategoriasController($categoriasRepositoryMock);

        // Llamada al método updateCaja
        $request = new Request(['activo'=>0]);
        $response = $controller->actualizarEstado( 1);

        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/categorias', $response->getTargetUrl());

        $this->assertTrue(session()->has('success'));


    }


    public function test_reingresar_categoria(){
         // Mock del repositorio
    $rolesRepositoryMock = $this->createMock(CategoriasRepository::class);

    // Retorno del mock
    $rolMock = (object) ['id' => 1];
    $rolesRepositoryMock->method('find')->with($rolMock->id);

    $rolesRepositoryMock->method('update')->willReturn(true);

    // Inyectar mock en el app container
    $this->app->instance(CategoriasRepository::class, $rolesRepositoryMock);

    // Simular autenticación
    $this->mockAuthCheck(true);

    // Instanciar controlador
    $controller = new CategoriasController($rolesRepositoryMock);

    // Llamada al método
    $response = $controller->reingresar(1);

    // Aserciones
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('Se ha actualizado el estado de la categoria', $response->getSession()->get('success'));
    $this->assertEquals(route('categorias'), $response->getTargetUrl());
    }


    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }

}
