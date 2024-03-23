<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\RolesController;
use App\Repositories\Roles\RolesRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class editRolesTest extends TestCase
{


    public function test_editRol_redirects_to_view_edit_roles_if_authenticated(){

        $cajasRepositoryMock = $this->createMock(RolesRepository::class);
        $cajaData= (object)['id' => 1, 'numero_caja' => '123', 'nombre' => 'Caja A'];
        $cajasRepositoryMock->method('find')->willReturn($cajaData);
        $this->app->instance(RolesRepository::class, $cajasRepositoryMock);

        $this->mockAuthCheck(true);
        $controller = new RolesController($cajasRepositoryMock);
        $response = $controller->editRol(1);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('fdlRoles.editRoles', $response->name());
    }


    public function test_editRol_update_rol(){
        // Configuración del mock del repositorio
        $rolesRepositoryMock = $this->createMock(RolesRepository::class);
        $rolesRepositoryMock->method('find')->willReturn((object)['id' => 1]);
        $rolesRepositoryMock->method('update')->willReturn(true);
        $this->app->instance(RolesRepository::class, $rolesRepositoryMock);

        // Simulamos que el usuario está autenticado
        $this->mockAuthCheck(true);

        // Instancia del controlador
        $controller = new RolesController($rolesRepositoryMock);

        // Llamada al método updateCaja
        $request = new Request([ 'nombre' => 'Admin']);
        $response = $controller->updateRol($request, 1);

        // Aserciones
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('http://127.0.0.1:8000/roles', $response->getTargetUrl());

   }



   protected function mockAuthCheck($result)
   {
       // Simula el método auth()->check() devolviendo el resultado deseado
       Auth::shouldReceive('check')->andReturn($result);

   }



}
