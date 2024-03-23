<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\UserRepository;
use App\Repositories\Cajas\CajasRepository;
use App\Repositories\Roles\RolesRepository;
use App\Http\Controllers\UsuariosController;
use Laravel\Dusk\Http\Controllers\UserController;

class UsuariosTest extends TestCase
{

    public function test_index_redirects_to_login_if_not_authenticated()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $cajasRepositoryMock = $this->createMock(CajasRepository::class);
        $rolesRepositoryMock = $this->createMock(RolesRepository::class);
        $this->mockAuthCheck(false); // Simula que el usuario no está autenticado

        $controller = new UsuariosController($userRepositoryMock, $cajasRepositoryMock, $rolesRepositoryMock);
        $response = $controller->index();

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(    ('http://127.0.0.1:8000/login'), $response->getTargetUrl());
    }


     public function test_index_returns_view_if_authenticated_with_data(){

         // Mock the authentication check
    $this->mockAuthCheck(true);

    // Mock the UserRepository
    $userRepositoryMock = $this->createMock(UserRepository::class);
    $userRepositoryMock->method('findByState')->willReturn(['user1', 'user2']);
    $this->app->instance(UserRepository::class, $userRepositoryMock);
    $cajasRepositoryMock = $this->createMock(CajasRepository::class);
    $rolesRepositoryMock = $this->createMock(RolesRepository::class);

    // Create an instance of the controller
    $controller = new UsuariosController($userRepositoryMock, $cajasRepositoryMock, $rolesRepositoryMock);

    // Test when the user is authenticated
    $response = $controller->index(1);

    // Assertions
    $this->assertInstanceOf(View::class, $response);
    $this->assertEquals('fdlUsuarios.dUsuarios', $response->getName());
    $this->assertArrayHasKey('data', $response->getData());
    $this->assertArrayHasKey('titulo', $response->getData()['data']);
    $this->assertArrayHasKey('datos', $response->getData()['data']);




     }







    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }


}
