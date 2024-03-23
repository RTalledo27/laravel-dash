<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\OfertasController;
use App\Repositories\Ofertas\OfertasRepository;

class editOfertasTest extends TestCase
{


    public function test_EditOferta_method()
{
    // Mock the authentication check
    $this->mockAuthCheck(true);

    // Mock the OfertasRepository
    $ofertasRepositoryMock = $this->createMock(OfertasRepository::class);
    $ofertasRepositoryMock->method('find')->willReturn('oferta');
    $this->app->instance(OfertasRepository::class, $ofertasRepositoryMock);

    // Create an instance of the controller
    $controller = new OfertasController($ofertasRepositoryMock);

    // Call the method
    $response = $controller->editOferta(1);

    // Assertions
    $this->assertInstanceOf(View::class, $response);
    $this->assertEquals('fdlOfertas.editOferta', $response->getName());
    $this->assertArrayHasKey('ofertas', $response->getData());
}


public function test_editOferta_UpdateOfertaMethod()
{
    $this->mockAuthCheck(true);
    $ofertasRepositoryMock = $this->createMock(OfertasRepository::class);
    $ofertasRepositoryMock->method('find')->willReturn('oferta');
    $ofertasRepositoryMock->method('update')->willReturn(true);
    $this->app->instance(OfertasRepository::class, $ofertasRepositoryMock);
    $controller = new OfertasController($ofertasRepositoryMock);
    $request = new Request([ 'nombre' => 'diaDelaMadre']);
      $response = $controller->updateOferta($request, 1);
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals(route('ofertas'), $response->getTargetUrl());
    $this->assertEquals('Oferta se actualizo con exito', $response->getSession()->get('success'));}



protected function mockAuthCheck($result)
{
    // Simula el método auth()->check() devolviendo el resultado deseado
    Auth::shouldReceive('check')->andReturn($result);

}

}
