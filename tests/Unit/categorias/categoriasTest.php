<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Cajas;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoriasController;
use App\Repositories\Categorias\CategoriasRepository;

class categoriasTest extends TestCase
{

    public function test_index_returns_view_if_authenticated_with_data(){

        // Mock the authentication check
   $this->mockAuthCheck(true);

   // Mock the UserRepository
   $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);
   $categoriasRepositoryMock->method('findByState')->willReturn(['user1', 'user2']);
   $this->app->instance(CategoriasRepository::class, $categoriasRepositoryMock);

   // Create an instance of the controller
   $controller = new CategoriasController($categoriasRepositoryMock);

   // Test when the user is authenticated
   $response = $controller->index(1);

   // Assertions
   $this->assertInstanceOf(View::class, $response);
   $this->assertEquals('fdlCategorias.categorias', $response->getName());
   $this->assertArrayHasKey('categorias', $response->getData());



    }


    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }




}
