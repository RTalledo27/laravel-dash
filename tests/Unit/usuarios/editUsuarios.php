<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\UserRepository;
use App\Repositories\Cajas\CajasRepository;
use App\Repositories\Roles\RolesRepository;
use App\Http\Controllers\UsuariosController;

class editUsuarios extends TestCase
{


    public function test_editRol_update_rol(){
        // Configuración del mock del repositorio
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $userRepositoryMock->method('find')->willReturn((object)['id' => 1]);
        $userRepositoryMock->method('update')->willReturn(true);
        $cajasRepositoryMock = $this->createMock(CajasRepository::class);
        $rolesRepositoryMock = $this->createMock(RolesRepository::class);
        $this->app->instance(UserRepository::class, $userRepositoryMock);


        // Simulamos que el usuario está autenticado
        $this->mockAuthCheck(true);

        // Instancia del controlador
        $controller = new UsuariosController($userRepositoryMock,$cajasRepositoryMock,$rolesRepositoryMock);

        // Llamada al método updateCaja
        $request = new Request([ 'nombre' => 'Admin']);
        $response = $controller->updateRol($request, 1);

        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/usuarios', $response->getTargetUrl());

   }



   protected function mockAuthCheck($result)
   {
       // Simula el método auth()->check() devolviendo el resultado deseado
       Auth::shouldReceive('check')->andReturn($result);

   }
}
