<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Roles;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\RolesController;
use App\Repositories\Roles\RolesRepository;

class rolesTest extends TestCase
{



    public function test_index_redirects_to_login_if_not_authenticated()
    {
        $cajasRepositoryMock = $this->createMock(RolesRepository::class);
        $this->mockAuthCheck(false); // Simula que el usuario no está autenticado

        $controller = new RolesController($cajasRepositoryMock);
        $response = $controller->index();

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('login'), $response->getTargetUrl());
    }


    public function test_index_with_roles_data(){


       // Simular autenticación
    $this->mockAuthCheck(true);

    // Mock del repositorio de roles
    $rolesRepositoryMock = $this->createMock(RolesRepository::class);

    // Configurar el mock para devolver roles activos
    $rolesActivos = [
        (object) ['id' => 1, 'nombre' => 'Rol 1'],
        (object) ['id' => 2, 'nombre' => 'Rol 2'],
    ];
    $rolesRepositoryMock->method('findByState')
        ->with(1)
        ->willReturn($rolesActivos);

    // Crear instancia del controlador
    $controller = new RolesController($rolesRepositoryMock);

    // Llamar al método index()
    $response = $controller->index();

    // Verificaciones
    $this->assertInstanceOf(View::class, $response);
    $this->assertEquals('fdlRoles.roles', $response->getName());

    // Verificar que el controlador devuelva los roles activos correctos
    $roles = $response->getData();
    $this->assertEquals($rolesActivos, $roles['roles']);

    }




    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }



}
