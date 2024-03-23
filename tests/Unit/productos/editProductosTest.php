<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductosController;
use App\Repositories\Productos\ProductosRepository;
use App\Repositories\Categorias\CategoriasRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;


class editProductosTest extends TestCase
{




    public function test_editProducto_update_producto()
    {
        $this->mockAuthCheck(true);

        // Simular el repositorio de Productos
        $productosRepositoryMock = $this->createMock(ProductosRepository::class);
        $productosRepositoryMock->method('find')->willReturn((object) ['id' => 1]); // Return an object with the 'id' property
        $categoriasRepositoryMock = $this->createMock(CategoriasRepository::class);

        $productosRepositoryMock->method('update')->willReturn(true);

        $this->app->instance(ProductosRepository::class, $productosRepositoryMock);

        // Crear una instancia del controlador
        $controller = new ProductosController($productosRepositoryMock, $categoriasRepositoryMock);

        // Crear una solicitud simulada con los datos necesarios
        $request = new Request([
            'id' => 1,
            'codigo' => 'codigo',
            'nombre' => 'nombre',
            'precio_compra' => 10,
            'precio_venta' => 20,
            'stock' => 5,
            'cantidad' => 'cantidad',
            'unidad' => 'unidad',
            'idCategoria' => 1,
            '_token' => csrf_token(),
        ]);

        // Probar el método updateProducto
        $response = $controller->updateProducto($request, 1);

        // Asertos
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('productos', 1), $response->getTargetUrl()); // Use the correct route parameter
        $this->assertEquals('Producto actualizado', $response->getSession()->get('success'));
    }
    protected function mockAuthCheck($result)
   {
       // Simula el método auth()->check() devolviendo el resultado deseado
       Auth::shouldReceive('check')->andReturn($result);

   }

}
