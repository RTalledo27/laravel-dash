<?php

namespace Tests\Unit;

use Illuminate\View\View;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OfertasController;
use App\Repositories\Ofertas\OfertasRepository;

class ofertasTest extends TestCase
{
    public function test_index_returns_view_if_authenticated_with_data(){

        // Mock the authentication check
   $this->mockAuthCheck(true);

   // Mock the UserRepository
   $ofertasRepositoryMock = $this->createMock(OfertasRepository::class);
   $ofertasRepositoryMock->method('findByState')->willReturn(['oferta1', 'oferta2'    ]);
   $this->app->instance(OfertasRepository::class, $ofertasRepositoryMock);


   // Create an instance of the controller
   $controller = new OfertasController($ofertasRepositoryMock);

   // Test when the user is authenticated
   $response = $controller->index(1);
   dump($response);

   // Assertions
   $this->assertInstanceOf(View::class, $response);
   $this->assertEquals('fdlOfertas.ofertas', $response->getName());
   $this->assertEquals('fdlOfertas.ofertas', $response->getName());
   $this->assertArrayHasKey('ofertas', $response->getData());




    }




    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }
}
