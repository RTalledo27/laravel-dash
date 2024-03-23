<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\OfertasController;
use App\Repositories\Ofertas\OfertasRepository;

class createOfertasTest extends TestCase
{


 public function    test_index_view_ofertas_with_data(){
        $this->mockAuthCheck(true);
        $ofertasRepositoryMock = $this->createMock(OfertasRepository::class);

        // Create an instance of the controller
        $controller = new OfertasController($ofertasRepositoryMock);

        // Call the method
        $response = $controller->newOferta();

        // Assertions
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('fdlOfertas.newOferta', $response->getName());
    }


    public function test_create_oferta_successful(){

    // Simular la verificación de autenticación
    $this->mockAuthCheck(true);

    // Simular el repositorio de Ofertas
    $ofertasRepositoryMock = $this->createMock(OfertasRepository::class);
    $ofertasRepositoryMock->method('create')->willReturn(true);
    $this->app->instance(OfertasRepository::class, $ofertasRepositoryMock);

    // Crear una instancia del controlador
    $controller = new OfertasController($ofertasRepositoryMock);

    // Crear un archivo de imagen simulado
    $file = UploadedFile::fake()->image('img_ofertas.jpg');

    // Crear una solicitud simulada con los datos necesarios
    $request = new Request([
        'img_ofertas' => $file,
        'nombre' => 'nombre',
    ]);

    // Probar el método createOferta
    $response = $controller->createOferta($request);

    // Asertos
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals(route('ofertas'), $response->getTargetUrl());
    $this->assertEquals('Oferta creada exitosamente', $response->getSession()->get('success'));
 }


    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }

}                                                                                                                                                                                                                                                                                                                      