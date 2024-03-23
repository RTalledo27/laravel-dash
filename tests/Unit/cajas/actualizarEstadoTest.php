<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\CajasController;
use App\Repositories\Cajas\CajasRepository;

class actualizarEstadoTest extends TestCase
{


    public function test_actualizarEstado_caja()
    {
        $cajasRepositoryMock = $this->createMock(CajasRepository::class);
        $cajasRepositoryMock->method('find')->willReturn((object)['id' => 1, 'activo' => true]);
        $cajasRepositoryMock->method('update')->willReturn(true);
        $this->app->instance(CajasRepository::class, $cajasRepositoryMock);
        // Simulamos que el usuario está autenticado
        $this->mockAuthCheck(true);
        // Instancia del controlador
        $controller = new CajasController($cajasRepositoryMock);
        // Llamada al método updateCaja
        $request = new Request(['id' => 0]);
        $response = $controller->actualizarEstado($request->id);
        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/cajas', $response->getTargetUrl());
    }


    public function test_reingresar_caja()
    {
        // Mock del repositorio
        $cajasRepositoryMock = $this->createMock(CajasRepository::class);
        // Retorno del mock
        $cajaMock = (object) ['id' => 1, 'activo' => false];
        $cajasRepositoryMock->method('find')->willReturn($cajaMock);
        $cajasRepositoryMock->method('update')->willReturn(true);
        // Inyectar mock en el app container
        $this->app->instance(CajasRepository::class, $cajasRepositoryMock);
        // Simular autenticación
        $this->mockAuthCheck(true);
        // Instanciar controlador
        $controller = new CajasController($cajasRepositoryMock);
        // Llamada al método
        $response = $controller->reingresar(1);
        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Se ha actualizado el estado de la caja', $response->getSession()->get('success'));
        $this->assertEquals(route('cajas'), $response->getTargetUrl());
    }















    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);
    }
}
