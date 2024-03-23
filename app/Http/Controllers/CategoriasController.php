<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Categorias\CategoriasRepository;

class CategoriasController extends Controller
{
    //

    protected $categoriasReposit;



    public function __construct(CategoriasRepository $categoriasRepository)
    {

        $this->categoriasReposit = $categoriasRepository;

        /*$this->validationRules = [
            'nombre' => [
                'required',
            ],
        ];*/
    }

    public function index($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $categorias = $this->categoriasReposit->findByState($activo);



        return view('fdlCategorias.categorias', compact('categorias'));
    }


    public function newCategoria($activo =1){
        if(!auth()->check()){
            return redirect()->route('login');
        }


        return view('fdlCategorias.newCategoria');
    }

    public function createCategoria(Request $request){

        $csrfToken = csrf_token();
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $request->validate([
            'nombre'=>'required|min:4|max:15|alpha'
        ]);

        //REPOSITORIO

 $Data = [
        'nombre' => $request->input('nombre'),
        'activo' => 1,
        '_token'=>$csrfToken,
    ];

    $categoria = $this->categoriasReposit->create($Data);

    if($categoria){
        return redirect()->route('categorias')->with('success','Categoria Creada con exito');

    }

    }







    public function editCategoria($id){
        if(!auth()->check()){
            return redirect()->route('login');
        }

        //REPOSITORIO
        $categoria = $this->categoriasReposit->find($id);

        if($categoria){
            return view('fdlCategorias.editCategoria',compact('categoria'));

        }


    }


    public function updateCategoria(Request $request,$id){
        $csrfToken = csrf_token();

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'nombre'=>'required|min:4|max:15|alpha'
    ]);

    //REPOSITORIO


    $categorias = $this->categoriasReposit->find($id);

    $Data=[
        'nombre' => $request->input('nombre'),
        '_token' => $csrfToken,
    ];

    $categorias = $this->categoriasReposit->update($categorias,$Data);

    if($categorias){
        return redirect()->route('categorias')->with('success','Categoria se actualizo con exito');

    }
}



public function actualizarEstado(int $id){
    if(!auth()->check()){
        return redirect()->route('login');
    }

    //REPOSITORIO
    $categorias = $this->categoriasReposit->find($id);

    $Data=['activo'=>0];

    $categorias = $this->categoriasReposit->update($categorias,$Data);

    if($categorias){
        return redirect()->route('categorias')->with('success','Se ha actualizado el estado de la categoria');

    }






}

public function categoriasEliminados(){
        if(!auth()->check()){
            return redirect()->route('login');
        }

        //REPOSITORIO
        $categorias = $this->categoriasReposit->findByState(0);

        if($categorias){
            return view('fdlCategorias.eliminados',compact('categorias'));
        }



}


public function reingresar(int $id){
    if(!auth()->check()){
        return redirect()->route('login');
    }


    //REPOSITORIO

    $categoria = $this->categoriasReposit->find($id);


        $Data=['activo'=>1];

        $categoria = $this->categoriasReposit->update($categoria,$Data);

        if($categoria){
            $categorias =$this->categoriasReposit->findByState(1);
            return redirect()->route('categorias')->with('success','Se ha actualizado el estado de la categoria');
        }






}


}
