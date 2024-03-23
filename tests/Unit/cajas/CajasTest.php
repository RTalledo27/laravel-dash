<?php

namespace Tests\Unit;

use Tests\TestCase;


use App\Http\Controllers\CajasController;
use App\Repositories\Cajas\CajasRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Mockery;
use Illuminate\Support\Facades\Auth;
class CajasTest extends TestCase
{



    public function test_index_redirects_to_login_if_not_authenticated()
    {
        $cajasRepositoryMock = Mockery::mock(CajasRepository::class);
        $this->mockAuthCheck(false); // Simula que el usuario no está autenticado

        $controller = new CajasController($cajasRepositoryMock);
        $response = $controller->index();

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('login'), $response->getTargetUrl());
    }




    public function test_index_returns_view_if_authenticated()
    {
        // Configuración del mock del repositorio
        $cajasRepositoryMock = Mockery::mock(CajasRepository::class);
        $this->mockAuthCheck(true); // Simula que el usuario está autenticado
        $cajasRepositoryMock->shouldReceive('findByState')->andReturn(['activo'=>1]); // Simula un array vacío

        // Instancia del controlador
        $controller = new CajasController($cajasRepositoryMock);

        // Llamada al método index
        $response = $controller->index();

        // Aserciones
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('fdlCajas.cajas', $response->name());
    }






    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }
}
