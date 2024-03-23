<?php

namespace App\Http\Controllers;



use App\Repositories\Cajas\CajasRepository;
use App\Repositories\Roles\RolesRepository;
use Illuminate\Http\Request;

use App\Repositories\User\UserRepository;


class UsuariosController extends Controller
{
    //
    protected $userReposit;
    protected $cajasReposit;
    protected $rolesReposit;

    public function __construct(UserRepository $userRepository, CajasRepository $cajasRepository, RolesRepository $rolesRepository)
    {
        $this->userReposit = $userRepository;
        $this->cajasReposit = $cajasRepository;
        $this->rolesReposit = $rolesRepository;
    }

    public function index($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $usuarios = $this->userReposit->findByState($activo);
        $data = [
            'titulo' => 'Empleados',
            'datos' => $usuarios,
        ];
        return view('fdlUsuarios.dUsuarios', compact('data'));
    }


    public function newUsuarios($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        //REPOSITORIO
        $cajas = $this->cajasReposit->findByState($activo);
        $roles = $this->rolesReposit->findByState($activo);
        $data = [
            'titulo' => 'Agregar Usuarios',
            'cajas' => $cajas,
            'roles' => $roles
        ];


        return view('fdlUsuarios.newUsuarios', compact('data'));
    }


    public function createUsuario(Request $request)
    {

        $csrfToken = csrf_token();
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        //VALIDANDO DATOS DE ENTRADA
        $request->validate([
            'usuario' => 'required|alphanum|min:5',
            'password' => 'required|alphanum|min:7',
            'repassword' => 'required|same:password|min:7',
            'nombre' => 'required|min:7',
            'id_caja' => 'required|integer',
            'id_rol' => 'required|integer',
        ]);
        //DATOS DE ENTRADA PARA NUEVO USUARIO
        $data = [
            'usuario' => $request->input('usuario'),
            'password' => $request->input('password'),
            'nombre' => $request->input('nombre'),
            'idCaja' => $request->input('id_caja'),
            'idRol' => $request->input('id_rol'),
            'activo' => 1,
            '_token' => $csrfToken,
        ];
        $user = $this->userReposit->create($data);
        return redirect()->route('nuevo-usuario')->with('success', 'el usuario fue creado con exito');
    }


    public function editUsuario($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //PATRON REPOSITORIO
        $usuario = $this->userReposit->find($id);
        $roles = $this->rolesReposit->findByState(1);
        $cajas = $this->cajasReposit->findByState(1);



        $data = [
            'titulo' => 'Editar Usuario',
            'cajas' => $cajas,
            'usuario' => $usuario,
            'rol' => $roles
        ];

        return view('fdlUsuarios.editUsuarios', compact('data'));
    }
    public function updateUsuario(Request $request, $id)
    {
        $csrfToken = csrf_token();

        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
            'nombre' => 'required',
            'id_caja' => 'required',
            'id_rol' => 'required',
        ]);

        $data = [
            'usuario' => $request->input('usuario'),
            'password' => $request->input('password'), PASSWORD_DEFAULT,
            'nombre' => $request->input('nombre'),
            'idCaja' => $request->input('id_caja'),
            'idRol' => $request->input('id_rol'),
            'activo' => 1,
            '_token' => $csrfToken,
        ];
        //PATRON REPOSITORIO
        $user = $this->userReposit->find($id);
        $user =   $this->userReposit->update($user, $data);
        return redirect()->route('usuarios');
    }


    public function actualizarEstado(int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $Data = [
            'activo' => 0,
        ];
        //PATRON REPOSITORIO
        $user = $this->userReposit->find($id);
        $user = $this->userReposit->update($user, $Data);
        if ($user) {
            $usuarios =  $this->userReposit->findByState(1);
            $data = [
                'titulo' => ' Usuarios',
                'datos' => $usuarios,
            ];
        }
        return view('fdlUsuarios.dUsuarios', compact('data'));
    }
    public function usuariosEliminados()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        //PATRON REPOSITORIO
        $usuarios = $this->userReposit->findByState(0);
        return view('fdlUsuarios.eliminados', compact('usuarios'));
    }
    public function reingresar(int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $Dat = ['activo' => 1];
        //PATRON REPOSITORIO
        $user = $this->userReposit->find($id);
        $user = $this->userReposit->update($user, $Dat);
        if ($user) {
            $usuarios = $this->userReposit->findByState(1);
            $data = [
                'datos' => $usuarios,
                'titulo' => 'Usuarios'
            ];
        }
        return view('fdlUsuarios.dUsuarios', compact('data'));
    }


    public function changePass()
    {
        $id = session('id');
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        //REPOSITORIO
        $user = $this->userReposit->find($id);
        return view('fdlUsuarios.cambiar_password', compact('user'));
    }


    public function updatePass(Request $request)
    {
        $csrfToken = csrf_field();
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $id = session('id');
        $request->validate ( [
            'password' => 'required',
            'repassword' => 'required|same:password'
        ]);

        //REPOSITORIO
        $user = $this->userReposit->find($id);

        if ($request->input('password') == $request->input('repassword')) {
            $data = [
                'password' => $request->input('password'),
                '_token' => $csrfToken
            ];

            //REPOSITORIO
            $user = $this->userReposit->update($user, $data);
            if ($user) {
                return redirect()->route('dashboard')->with('success', 'Contraseña actualizada exitosamente');
            }
        } else {
            return back()->withErrors([
                'repassword' => 'El usuario o la contraseña no son válidos.',
            ]);
        }
    }
}
