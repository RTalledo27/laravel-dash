<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testDashboard()
    {
        $this->browse(function (Browser $browser) {
            // Inicia sesión

            $usuario = 'Roma';
            $contraseña = 'asd';


            
            $browser->visit('/login')
                ->type('usuario', $usuario)
                ->type('password', $contraseña)
                ->press('Ingresar')
                ->assertPathIs('/dashboard'); 

            // Verifica que el nombre de usuario esté presente en la página
            $browser->assertSeeIn('#navbarDropdown', $usuario);

            // Verifica que el enlace de cerrar sesión esté presente
            $browser->click('#navbarDropdown')
            ->assertVisible('.dropdown-menu')
            ->assertSee('Cambiar Contraseña')
            ->assertVisible('.dropdown-menu')
            ->assertSee('Cerrar Sesion');


            //VERIFICAR SIDEBAR
            $browser->assertVisible('.navbar-nav')
            ->assertSee('Productos')
            ->assertSee('Administracion')
            ->assertSee('Empleados')
            ->assertSee('Ofertas');

            $browser->click('#productos')
            ->assertVisible('#collapseLayouts')
            ->assertVisible('.sb-sidenav-menu-nested')
            ->when(true,function($browser){
                $browser->assertVisible('.sb-sidenav-menu-nested')
                ->assertSee('Productos')
                ->assertSee('Categorías');
            })
;


            
           



            


            
           

        });
    }





}
