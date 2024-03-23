<?php

namespace App\Http\Controllers;

use App\Repositories\Cajas\CajasRepository;
use Illuminate\Http\Request;

class CajasController extends Controller
{
    //

    protected $cajasReposit;


    public function __construct(CajasRepository $cajasRepository)
    {
        $this->cajasReposit = $cajasRepository;
    }

    public function index($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $cajas = $this->cajasReposit->findByState($activo);


        if($cajas){
            return view('fdlCajas.cajas', compact('cajas'));
        }


    }


    public function newCaja()
    {
        if (!auth()->check()) {
            return redirect()->route('/login');
        }

        return view('fdlCajas.newCajas');
    }

    public function createCaja(Request $request)
    {
        $csrf_token = csrf_field();
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'numero_caja' => 'required',
            'nombre' => 'required',
        ]);


        //REPOSITORIO
        $Data =[

            'numero_caja' => $request->input('numero_caja'),
            'nombre' => $request->input('nombre'),
            'folio' => 1,
            'activo' => 1,
            '_token' => $csrf_token
        ];


        $caja = $this->cajasReposit->create($Data);

        if ($caja) {
         return redirect()->route('cajas');
        }

    }


    public function editCaja(int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $caja = $this->cajasReposit->find($id);

        if ($caja) {

            return view('fdlCajas.editCajas', compact('caja'));
        }


    }

    public function updateCaja(Request $request, int $id){
        $csrf_token = csrf_field();
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $request->validate([
            'numero_caja'=> 'required|numeric',
            'nombre'=>'required'
        ]);

        $caja = $this->cajasReposit->find($id);

        $Data=[
            'numero_caja'=>$request->input('numero_caja'),
            'nombre'=>$request->input('nombre'),
            '_token'=>$csrf_token,
        ];

        $caja = $this->cajasReposit->update($caja,$Data);

        if($caja){
            $cajas = $this->cajasReposit->findByState(1);
        }

        return redirect()->route('cajas', compact('cajas'))->with('success','La caja ha sido actualizada');

    }


    public function actualizarEstado(int $id){
        if(!auth()->check()){
            return redirect()->route('login');
        }

        //REPOSITORIO
        $caja = $this->cajasReposit->find($id);

        $Data=['activo'=>0];

        $caja = $this->cajasReposit->update($caja,$Data);

        if($caja){
            $cajas= $this->cajasReposit->findByState(1);
            return redirect()->route('cajas',compact('cajas'))->with('success','Se ha cambiado el estado del rol');

        }

    }


    public function cajasEliminadas(){
        if(!auth()->check()){
            return redirect()->route('login');
        }

        //REPOSITORIO
        $cajas = $this->cajasReposit->findByState(0);


        return view('fdlCajas.eliminados',compact('cajas'));
    }

    public function reingresar(int $id){

        if(!auth()->check()){
            return redirect()->route('login');
        }

        //REPOSITORIO
        $caja = $this->cajasReposit->find($id);

        $Data=['activo'=>1];

        $caja = $this->cajasReposit->update($caja,$Data);

        if($caja){
            $cajas = $this->cajasReposit->findByState(1);
            return redirect()->route('cajas',compact('cajas'))->with('success','Se ha actualizado el estado de la caja');
        }



    }

}
