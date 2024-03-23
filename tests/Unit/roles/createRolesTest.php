<?php

namespace Tests\Unit;

use app;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\RolesController;
use App\Repositories\Roles\RolesRepository;

class createRolesTest extends TestCase
{


    public function test_createRol_with_valid_data()
    {
        // Simulamos que el usuario está autenticado
        Auth::shouldReceive('check')->andReturn(true);

        // Creamos un objeto mock para el repositorio rolesReposit
        $rolesRepositMock = $this->createMock(RolesRepository::class);
        $this->app->instance(RolesRepository::class, $rolesRepositMock);

        // Configuramos el comportamiento esperado del objeto mock
        $rolesRepositMock->expects($this->once())
            ->method('create')
            ->willReturn(true);

        // Creamos una instancia del controlador
        $controller = new RolesController($rolesRepositMock);

        // Creamos un objeto Request simulado con los datos necesarios
        $request = new Request(['nombre' => 'Administrador']);

        // Ejecutamos el método createRol del controlador
        $response = $controller->createRol($request);

        // Verificamos el comportamiento esperado
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('nuevo-rol'), $response->getTargetUrl());
        $this->assertTrue(session()->has('success'));


    }

}
