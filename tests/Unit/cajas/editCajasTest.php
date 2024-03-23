<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CajasController;
use App\Repositories\Cajas\CajasRepository;
class editCajasTest extends TestCase
{
    /**
     * A basic unit test example.
     */





     public function test_editCaja_redirects_to_view_cajas_if_authenticated(){

        $cajasRepositoryMock = $this->createMock(CajasRepository::class);
        $cajaData= (object)['id' => 1, 'numero_caja' => '123', 'nombre' => 'Caja A'];
        $cajasRepositoryMock->method('find')->willReturn($cajaData);
        $this->app->instance(CajasRepository::class, $cajasRepositoryMock);

        $this->mockAuthCheck(true);
        $controller = new CajasController($cajasRepositoryMock);
        $response = $controller->editCaja(1);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('fdlCajas.editCajas', $response->name());
    }



    public function test_editCaja_update_caja(){
         // Configuración del mock del repositorio
         $cajasRepositoryMock = $this->createMock(CajasRepository::class);
         $cajasRepositoryMock->method('find')->willReturn((object)['id' => 1]);
         $cajasRepositoryMock->method('update')->willReturn(true);
         $this->app->instance(CajasRepository::class, $cajasRepositoryMock);

         // Simulamos que el usuario está autenticado
         $this->mockAuthCheck(true);

         // Instancia del controlador
         $controller = new CajasController($cajasRepositoryMock);

         // Llamada al método updateCaja
         $request = new Request(['numero_caja' => '3', 'nombre' => 'Secundaria']);
         $response = $controller->updateCaja($request, 1);

         // Aserciones
         $this->assertInstanceOf(RedirectResponse::class, $response);
         $this->assertEquals('http://127.0.0.1:8000/cajas', $response->getTargetUrl());

    }


    public function test_no_update_if_fields_empty()
    {
        // Mock del repositorio
        $cajasRepositoryMock = $this->createMock(CajasRepository::class);
        // Retorno del mock
        $cajasRepositoryMock->method('find')
            ->with(1)
            ->willReturn(null);

        // Inyectar mock en el app container
        $this->app->instance(CajasRepository::class, $cajasRepositoryMock);
        // Simular autenticación
        $this->mockAuthCheck(true);
        // Instanciar controlador
        $controller = new CajasController($cajasRepositoryMock);
        // Crear request
        $request = new Request(['activo' => 0]);
        // Llamar al método
        $response = $controller->updateCaja($request, 1);
        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/cajas', $response->getTargetUrl());
    }



     protected function mockAuthCheck($result)
     {
         // Simula el método auth()->check() devolviendo el resultado deseado
         Auth::shouldReceive('check')->andReturn($result);

     }


    }
