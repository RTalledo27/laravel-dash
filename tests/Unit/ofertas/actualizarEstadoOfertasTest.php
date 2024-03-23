<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\OfertasController;
use App\Repositories\Ofertas\OfertasRepository;

class actualizarEstadoOfertasTest extends TestCase
{

    public function test_actualizarEstado_oferta(){

        $ofertasRepositoryMock = $this->createMock(OfertasRepository::class);
         $ofertasRepositoryMock->method('find')->willReturn((object)['id' => 1, 'activo'=>true]);
         $ofertasRepositoryMock->method('update')->willReturn(true);
         $this->app->instance(OfertasRepository::class, $ofertasRepositoryMock);

    // Simulamos que el usuario está autenticado
    $this->mockAuthCheck(true);

    // Instancia del controlador
    $controller = new OfertasController($ofertasRepositoryMock);

        // Llamada al método updateCaja
        $request = new Request(['id'=>0]);
        $response = $controller->actualizarEstado( $request->id);

        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/ofertas', $response->getTargetUrl());



    }


    public function test_reingresar_caja(){
         // Mock del repositorio
    $cajasRepositoryMock = $this->createMock(OfertasRepository::class);

    // Retorno del mock
    $cajaMock = (object) ['id' => 1, 'activo' => false];
    $cajasRepositoryMock->method('find')->willReturn($cajaMock);

    $cajasRepositoryMock->method('update')->willReturn(true);

    // Inyectar mock en el app container
    $this->app->instance(OfertasRepository::class, $cajasRepositoryMock);

    // Simular autenticación
    $this->mockAuthCheck(true);

    // Instanciar controlador
    $controller = new OfertasController($cajasRepositoryMock);

    // Llamada al método
    $response = $controller->reingresar(1);

    // Aserciones
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('Se ha actualizado el estado de la caja', $response->getSession()->get('success'));
    $this->assertEquals(route('ofertas'), $response->getTargetUrl());
    }















    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }
}
