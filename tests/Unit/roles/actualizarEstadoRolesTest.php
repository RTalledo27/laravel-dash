<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\RolesController;
use App\Repositories\Roles\RolesRepository;

class actualizarEstadoRolesTest extends TestCase
{

    public function test_actualizarEstado_rol(){

        $rolesRepositoryMock = $this->createMock(RolesRepository::class);
         $rolesRepositoryMock->method('find')->willReturn((object)['id' => 1,'rol'=>'Admin']);
         $rolesRepositoryMock->method('update')->willReturn(true);
         $this->app->instance(RolesRepository::class, $rolesRepositoryMock);

    // Simulamos que el usuario está autenticado
    $this->mockAuthCheck(true);

    // Instancia del controlador
    $controller = new RolesController($rolesRepositoryMock);

        // Llamada al método updateCaja
        $request = new Request(['activo'=>0]);
        $response = $controller->actualizarEstado( 1);

        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/roles', $response->getTargetUrl());

        $this->assertTrue(session()->has('success'));


    }


    public function test_reingresar_rol(){
         // Mock del repositorio
    $rolesRepositoryMock = $this->createMock(RolesRepository::class);

    // Retorno del mock
    $rolMock = (object) ['id' => 1, 'rol' => 'Admin'];
    $rolesRepositoryMock->method('find')->willReturn($rolMock);

    $rolesRepositoryMock->method('update')->willReturn(true);

    // Inyectar mock en el app container
    $this->app->instance(RolesRepository::class, $rolesRepositoryMock);

    // Simular autenticación
    $this->mockAuthCheck(true);

    // Instanciar controlador
    $controller = new RolesController($rolesRepositoryMock);

    // Llamada al método
    $response = $controller->reingresar(1);

    // Aserciones
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('Se ha actualizado el estado del rol', $response->getSession()->get('success'));
    $this->assertEquals(route('roles'), $response->getTargetUrl());
    }


    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }


}
