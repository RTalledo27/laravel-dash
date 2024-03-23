<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Roles;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;


class LoginController extends Controller
{


    protected $userReposit;


    public function __construct(UserRepository $userRepository)
    {
        $this->userReposit = $userRepository;
        $this->middleware('guest')->except('logout');
    }


    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */






    public function index(){
        if(auth()->check()){
            return redirect()->route('dashboard');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request){
        // Validar los datos del formulario
   $request->validate([
       'usuario' => 'required',
       'password' => 'required',
   ]);

   // Iniciar sesión al usuario
   $user = $this->userReposit->findByCredentials($request->input('usuario'), $request->input('password'));
   if ($user) {
       auth()->login($user);

       //print($user);


       $rol = Roles::find($user->idRol);

       session(['nombre'=>$user->nombre,
       'usuario'=>$user->usuario,
       'rol'=> $rol->rol,
       'id'=>$user->id

   ]);



       return redirect()->route('dashboard');
   }

   // Mostrar un mensaje de error si el inicio de sesión no es exitoso
   return back()->withErrors([
       'usuario' => 'El usuario o la contraseña no son válidos.',
   ]);
   }


public function logout()
{
    Auth::logout();

    return redirect()->route('login'); // Puedes redirigir a donde desees después del cierre de sesión
}

}
