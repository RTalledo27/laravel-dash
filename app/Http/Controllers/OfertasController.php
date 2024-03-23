<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Ofertas\OfertasRepository;

class OfertasController extends Controller
{
    //


    protected $ofertasReposit;

    public function __construct(OfertasRepository $ofertasRepository)
    {

        $this->ofertasReposit = $ofertasRepository;
    }


    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $ofertas =  $this->ofertasReposit->findByState(1);
        return view('fdlOfertas.ofertas', compact('ofertas'));
    }

    public function newOferta()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }



        return view('fdlOfertas.newOferta');
    }


    public function createOferta(Request $request)
    {



        $request->validate([
            'img_ofertas' => 'required|image|mimes:jpg,jpeg,png',
            'nombre' => 'required|min:5|alpha',

        ]);


        $image = request()->file('img_ofertas');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/public/uploads/ofertas/', $imageName);

        $Data = [
            'imgOferta' => $imageName,
            'nombre' => $request->input('nombre'),
            'activo'=>1
        ];

        $oferta = $this->ofertasReposit->create($Data);
        if ($oferta) {
            return redirect()->route('ofertas')->with('success','Oferta creada exitosamente');
        }
    }


    public function editOferta($id, $activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }


        $ofertas = $this->ofertasReposit->find($id);
        return view('fdlOfertas.editOferta', compact('ofertas'));
    }



    public function updateOferta(Request $request,$id){
        $csrfToken = csrf_token();

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $request->validate([
        'nombre' => 'required|min:5|alpha',
        'img_ofertas' => 'image|mimes:jpg,jpeg,png',
    ]);

    //REPOSITORIO

    $image = request()->file('img_ofertas');
    $imageName= '';
    $Data=[];

    if($image){
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('/public/uploads/ofertas/', $imageName);
         $oferta = $this->ofertasReposit->find($id);
         $Data=[
            'imgOferta' => $imageName,
        'nombre' => $request->input('nombre'),
            '_token' => $csrfToken,
        ];

    }else{
        $oferta = $this->ofertasReposit->find($id);
        $Data=[
            'nombre' => $request->input('nombre'),
            '_token' => $csrfToken,
        ];
    }

    $oferta = $this->ofertasReposit->update($oferta,$Data);

    if($oferta){
        return redirect()->route('ofertas')->with('success','Oferta se actualizo con exito');
    }
}

public function actualizarEstado(int $id){
    if(!auth()->check()){
        return redirect()->route('login');
    }

    //REPOSITORIO
    $oferta = $this->ofertasReposit->find($id);

    $Data=['activo'=>0];

    $oferta = $this->ofertasReposit->update($oferta,$Data);

    if($oferta){
        $ofertas= $this->ofertasReposit->findByState(1);
        return redirect()->route('ofertas',compact('ofertas'))->with('success','Se ha actualizado el estado de la oferta');

    }

}


public function ofertasEliminadas(){
    if(!auth()->check()){
        return redirect()->route('login');
    }

    //REPOSITORIO
    $ofertas = $this->ofertasReposit->findByState(0);


    return view('fdlOfertas.eliminados',compact('ofertas'));
}

public function reingresar(int $id){

    if(!auth()->check()){
        return redirect()->route('login');
    }

    //REPOSITORIO
    $oferta = $this->ofertasReposit->find($id);

    $Data=['activo'=>1];

    $oferta = $this->ofertasReposit->update($oferta,$Data);

    if($oferta){
        $ofertas = $this->ofertasReposit->findByState(1);
        return redirect()->route('ofertas',compact('ofertas'))->with('success','Se ha actualizado el estado de la caja');
    }



}
}
