<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CategoriasController;
use App\Repositories\Categorias\CategoriasRepository;

class editCategoriasTest extends TestCase
{

    public function  test_edittCategorias_update_categorias(){
  // Mock the authentication check
  $this->mockAuthCheck(true);

  // Mock the CategoriasRepository
  $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);
  // Configuración del mock del repositorio
  $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);
  $categoriasRepositoryMock->method('find')->willReturn((object)['id' => 1]);
  $categoriasRepositoryMock->method('update')->willReturn(true);
  $this->app->instance(CategoriasRepository::class, $categoriasRepositoryMock);

  // Simulamos que el usuario está autenticado
  $this->mockAuthCheck(true);

  // Instancia del controlador
  $controller = new CategoriasController($categoriasRepositoryMock);

  // Llamada al método updateCaja
  $request = new Request([ 'nombre' => 'Lacteos']);
  $response = $controller->updateCategoria($request, 1);

  // Aserciones
  $this->assertInstanceOf(RedirectResponse::class, $response);
  $this->assertEquals(route('categorias'), $response->getTargetUrl());
  $this->assertEquals('Categoria se actualizo con exito', $response->getSession()->get('success'));


    }




    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }
}
