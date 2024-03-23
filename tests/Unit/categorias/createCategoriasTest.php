<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CategoriasController;
use App\Repositories\Categorias\CategoriasRepository;

class createCategoriasTest extends TestCase
{



    public function test_create_categoria_sucessfull()
{
    // Mock the authentication check
    $this->mockAuthCheck(true);

    // Mock the CategoriasRepository
    $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);
    $categoriasRepositoryMock->method('create')->willReturn(true);
    $this->app->instance(CategoriasRepository::class, $categoriasRepositoryMock);

    // Create an instance of the controller
    $controller = new CategoriasController($categoriasRepositoryMock);

    // Create a mock Request object
    $request = new Request([
        'nombre'=>  'Lacteos'
    ]);

    // Call the method
    $response = $controller->createCategoria($request);

    // Assertions
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals(route('categorias'), $response->getTargetUrl());
    $this->assertEquals('Categoria Creada con exito', $response->getSession()->get('success'));
}




protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }

}
