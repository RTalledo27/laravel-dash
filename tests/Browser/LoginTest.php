<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test exampl
     * e.
     */

     public function test_it_shows_login_page_for_guests()
{
    $this->browse(function ($browser) {
        $browser->visit('/login') // Asegúrate de reemplazar esto con la ruta real
                ->assertPathIs('/login')
                ->pause(1000) // Asegúrate de reemplazar esto con la ruta real
                ->assertSee('Karina Store'); // Asegúrate de reemplazar esto con cualquier texto específico de la página de inicio
    });


    

}


public function testLoginPerformance()
    {
        $this->browse(function (Browser $browser) {
            // Medir el tiempo de inicio
            $startTime = microtime(true);


            $usuario = 'Roma';
            $contraseña = 'asd';

            // Realizar la acción de inicio de sesión
            $browser->visit('/login')
                ->type('usuario', $usuario) // Reemplaza con un nombre de usuario válido
                ->type('password', $contraseña) // Reemplaza con una contraseña válida
                ->press('Ingresar');

            // Medir el tiempo de finalización
            $endTime = microtime(true);

            // Calcular el tiempo total en milisegundos
            $executionTime = ($endTime - $startTime) * 1000;

            // Imprimir el tiempo total
            print("Tiempo de inicio de sesión: {$executionTime} ms");

            // Puedes agregar aserciones adicionales según tus necesidades
            $browser->assertPathIs('/dashboard')
                    ->assertSee('Karina Store')
                    ->assertSee($usuario);
        });

        
    }
   

}
