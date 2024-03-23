<?php

namespace App\Http\Controllers;

use App\Repositories\Roles\RolesRepository;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //

    protected $reglas;
    protected $session;
    protected $rolesReposit;


    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesReposit = $rolesRepository;

    }




    public function index($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $roles = $this->rolesReposit->findByState($activo);

        return view('fdlRoles.roles', compact('roles'));
    }


    public function newRol()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('fdlRoles.newRoles');
    }

    public function createRol(Request $request)
    {
        $csrfToken = csrf_token();

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'nombre' => 'required'
        ]);

        $Data = [
            'rol' => $request->input('nombre'),
            'activo' => 1,
            '_token' => $csrfToken
        ];

        //REPOSITORIO
        $rol = $this->rolesReposit->create($Data);
        if ($rol) {
            return redirect()->route('nuevo-rol')->with('success', 'Rol Creado Exitosamente');
        }
    }



    public function editRol(int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $roles = $this->rolesReposit->find($id);

        $data = [
            'titulo' => 'Editar Roles',
            'roles' => $roles,
        ];

        return view('fdlRoles.editRoles', compact('data'));
    }


    public function updateRol(Request $request, int $id)
    {
        $csrfToken = csrf_token();

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'nombre' => 'required',
        ]);

        //REPOSITORIO
        $rol = $this->rolesReposit->find($id);
        $Data = [
            'rol' => $request->input('nombre'),
            
            'activo' => 1,
            '_token' => $csrfToken
        ];

        $rol = $this->rolesReposit->update($rol, $Data);

        if ($rol) {
            return redirect()->route('roles')->with('success','El Rol ha sido actualizado correctamente');
        }
    }


    public function actualizarEstado(int $id, $activo = 1)
    {
        // dd($id);
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $rol = $this->rolesReposit->find($id);
        $Data=[
            'rol' => $rol->rol,
            'activo' => 0
        ];
        $rol = $this->rolesReposit->update($rol,$Data);

        if ($rol) {
            $roles = $this->rolesReposit->findByState($activo);

         return redirect()->route('roles', compact('roles'))->with('success','Se ha cambiado el estado del rol');

        }


    }

    public function rolesEliminados($activo =0)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $rol = $this->rolesReposit->findByState($activo);


        return view('fdlRoles.eliminados', compact('rol'));
    }

    public function reingresar(int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $rol = $this->rolesReposit->find($id);

        $Data=[
            'rol' => $rol->rol,
            'activo' => 1
        ];

        $rol = $this->rolesReposit->update($rol,$Data);

        if($rol){
        return redirect()->route('roles')->with('success','Se ha actualizado el estado del rol');

        }

    }
}
