<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\ProductosController;
use App\Repositories\Productos\ProductosRepository;
use App\Repositories\Categorias\CategoriasRepository;

class createProductosTest extends TestCase
{
public function test_createProuct(){

    $this->mockAuthCheck(true);

    // Mock the product repository
    $productosRepositoryMock = $this->createMock(ProductosRepository::class);
    $productosRepositoryMock->method('create')->willReturn(true);
    $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);
    // Create a new controller instance with the mock
    $controller = new ProductosController($productosRepositoryMock, $categoriasRepositoryMock);

    $request = new Request([
        'codigo' => 'AAA=1',
        'nombre' => 'Producto 1',
        'precio_compra' => 100,
        'precio_venta' => 120,
        'stock' => 10,
        'cantidad' => 1,
        'unidad' => 'unidades',
        'idCategoria' => 1,
        'imagen' => 'imagen.jpg',
    ]);

    $response = $controller->createProduct($request);

   // Assertions
   $this->assertInstanceOf(RedirectResponse::class, $response);
   $this->assertEquals(route('productos'), $response->getTargetUrl());
}

protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }
}
