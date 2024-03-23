<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use Illuminate\View\View;;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Mockery;

class LoginTest extends TestCase
{




        public function test_login_redirect_to_dashboard_successful_login()
        {
            $userRepositoryMock = Mockery::mock(UserRepository::class);
            $this->app->instance(UserRepository::class, $userRepositoryMock);
            $this->mockValidation(true);
            $userRepositoryMock->shouldReceive('findByCredentials')->andReturn((object)['id' => 1, 'nombre' => 'Romaim', 'usuario' => 'romaim','idRol'=>1]);
            Auth::shouldReceive('login');
            $controller = new LoginController($userRepositoryMock);
            $response = $controller->login($this->getRequest());
            $this->assertInstanceOf(RedirectResponse::class, $response);
            $this->assertEquals('http://127.0.0.1:8000/dashboard', $response->getTargetUrl());
            $this->assertEquals('Romaim', session('nombre'));
            $this->assertEquals('romaim', session('usuario'));
            $this->assertEquals(1, session('id'));
        }

        public function test_login_returns_back_with_errors_on_failed_login()
        {
            $userRepositoryMock = Mockery::mock(UserRepository::class);
            $this->app->instance(UserRepository::class, $userRepositoryMock);
            $this->mockValidation(true);
            $userRepositoryMock->shouldReceive('findByCredentials')->andReturn(null);
            Auth::shouldReceive('login')->never();
            $controller = new LoginController($userRepositoryMock);
            $response = $controller->login($this->getRequest());
            $this->assertInstanceOf(RedirectResponse::class, $response);
            $this->assertTrue(session()->has('errors'));
        }


        public function test_index_shows_login_view_if_not_authenticated()
        {
            $userRepositoryMock = Mockery::mock(UserRepository::class);

            $this->mockValidation(false);

            $controller = new LoginController($userRepositoryMock);
            $response = $controller->index();
            $this->assertInstanceOf(View::class, $response);
            // phpcs:ignore
           $this->assertEquals('auth.login', $response->name());
        }

        protected function mockValidation($passes)
        {
            $validator = Mockery::mock('Illuminate\Validation\Validator');
            $validator->shouldReceive('passes')->andReturn($passes);

            // Cambiado a 'validate'
            $validator->shouldReceive('validate')->andReturn($passes);

            $validatorFactory = Mockery::mock('Illuminate\Validation\Factory');
            $validatorFactory->shouldReceive('make')->andReturn($validator);

            $this->app->instance('validator', $validatorFactory);
        }

        protected function getRequest()
        {
            // Simula una solicitud HTTP con los datos necesarios para la prueba
            return Request::create(route('login'), 'POST', [
                'usuario' => 'Romaim',
                'password' => 'secret',
            ]);
        }
    }







