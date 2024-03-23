<?php

namespace Tests\Unit;

use app;
use Tests\TestCase;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RolesController;
use App\Repositories\User\UserRepository;
use App\Repositories\Cajas\CajasRepository;
use App\Repositories\Roles\RolesRepository;
use App\Http\Controllers\UsuariosController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class actualizarEstadoUsuariosTest extends TestCase
{


    public function test_actualizarEstado_rol(){

       // Mock the authentication check
    $this->mockAuthCheck(true);

    // Mock the UserRepository
    $userRepositoryMock = $this->createMock(UserRepository::class);
    $userRepositoryMock->method('find')->willReturn('user');
    $userRepositoryMock->method('update')->willReturn(true);
    $userRepositoryMock->method('findByState')->willReturn(['user1', 'user2']);
    $this->app->instance(UserRepository::class, $userRepositoryMock);
    $cajasRepositoryMock = $this->createMock(CajasRepository::class);
    $rolesRepositoryMock = $this->createMock(RolesRepository::class);

    // Create an instance of the controller
    $controller = new UsuariosController($userRepositoryMock, $cajasRepositoryMock, $rolesRepositoryMock);

    // Test when the user is authenticated
    $response = $controller->actualizarEstado(1);

    // Assertions
    $this->assertInstanceOf(View::class, $response);
    $this->assertEquals('fdlUsuarios.dUsuarios', $response->getName());
    $this->assertArrayHasKey('data', $response->getData());
    $this->assertArrayHasKey('titulo', $response->getData()['data']);
    $this->assertArrayHasKey('datos', $response->getData()['data']);


    }


    public function test_reingresar_rol(){
         // Mock del repositorio
    $rolesRepositoryMock = $this->createMock(RolesRepository::class);

    // Retorno del mock
    $rolMock = (object) ['id' => 1, 'rol' => 'Admin'];
    $rolesRepositoryMock->method('find')->willReturn($rolMock);

    $rolesRepositoryMock->method('update')->willReturn(true);

    // Inyectar mock en el app container
    $this->app->instance(RolesRepository::class, $rolesRepositoryMock);

    // Simular autenticación
    $this->mockAuthCheck(true);

    // Instanciar controlador
    $controller = new RolesController($rolesRepositoryMock);

    // Llamada al método
    $response = $controller->reingresar(1);

    // Aserciones
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('Se ha actualizado el estado del rol', $response->getSession()->get('success'));
    $this->assertEquals(route('roles'), $response->getTargetUrl());
    }





    public function test_reingresar_sucessful()  {
  // Mock the authentication check
  $this->mockAuthCheck(true);

  // Mock the UserRepository
  $userRepositoryMock = $this->createMock(UserRepository::class);
  $userRepositoryMock->method('find')->willReturn('user');
  $userRepositoryMock->method('update')->willReturn(true);
  $userRepositoryMock->method('findByState')->willReturn(['user1', 'user2']);
  $this->app->instance(UserRepository::class, $userRepositoryMock);
  $cajasRepositoryMock = $this->createMock(CajasRepository::class);
  $rolesRepositoryMock = $this->createMock(RolesRepository::class);

  // Create an instance of the controller
  $controller = new UsuariosController($userRepositoryMock, $cajasRepositoryMock, $rolesRepositoryMock);

  // Test when the user is authenticated
  $response = $controller->actualizarEstado(1);

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
