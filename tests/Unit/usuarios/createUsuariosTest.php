<?php

namespace Tests\Unit;

use app;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\UserRepository;
use App\Repositories\Cajas\CajasRepository;
use App\Repositories\Roles\RolesRepository;
use App\Http\Controllers\UsuariosController;

class createUsuariosTest extends TestCase
{




    public function test_create_usuario_sucessfull(){

         // Mock the authentication check
    $this->mockAuthCheck(true);

    // Mock the UserRepository
    $userRepositoryMock = $this->createMock(UserRepository::class);
    $userRepositoryMock->method('create')->willReturn('newUser');
    $userRepositoryMock = $this->createMock(UserRepository::class);
    $cajasRepositoryMock = $this->createMock(CajasRepository::class);
    $rolesRepositoryMock = $this->createMock(RolesRepository::class);
    $this->app->instance(UserRepository::class, $userRepositoryMock);

    // Create an instance of the controller
    $controller = new UsuariosController($userRepositoryMock, $cajasRepositoryMock, $rolesRepositoryMock);

    // Create a mock Request object with the required input data
    $request = new Request([
        'usuario' => 'romaTest',
        'password' => 'romaPassword',
        'repassword' => 'romaPassword',
        'nombre' => 'romaTest',
        'id_caja' => 1,
        'id_rol' => 1,
    ]);

    // Test the createUsuario method
    $response = $controller->createUsuario($request);

    // Assertions
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('el usuario fue creado con exito', $response->getSession()->get('success'));
    $this->assertEquals(route('nuevo-usuario'), $response->getTargetUrl());
    }






    protected function mockAuthCheck($result)
    {
        // Simula el método auth()->check() devolviendo el resultado deseado
        Auth::shouldReceive('check')->andReturn($result);

    }



}
