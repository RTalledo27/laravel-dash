<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Repositories\Productos\ProductosRepository;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use App\Repositories\Categorias\CategoriasRepository;

class ProductosController extends Controller
{
    //



    protected $productosReposit;
    protected $categoriasReposit;

    public function __construct(ProductosRepository $productosRepository, CategoriasRepository $categoriasRepository)
    {
        $this->productosReposit = $productosRepository;
        $this->categoriasReposit = $categoriasRepository;
    }


    public function index($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $productos = $this->productosReposit->findByState($activo);

        return view('fdlProductos.productos', compact('productos'));
    }

    // index crear usuario
    public function newProductos($activo = 1)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $categorias = $this->categoriasReposit->findByState($activo);
        $data = [
            'titulo' => 'Agregar Producto',
            'categorias' => $categorias,
        ];

        return view('fdlProductos.newProducto', compact('data'));
    }

    ///// AGREGAR PRODUCTO A LA BD

    public function createProduct(Request $request)
    {

        $request->validate([
            'codigo' => 'required|min:3|alphanum|max:255',
            'nombre' => 'required|alpha|max:255',
            'precio_compra' => 'required|numeric|decimal:1,3S|min:0',
            'precio_venta' => 'required|numeric|decimal:1,3|min:0',
            'stock' => 'required|integer|min:0',
            'cantidad' => 'required|numeric|decimal:1,3',
            'unidad' => 'required',
            'idCategoria' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,jpg,JPEG,JPG',


        ]);


        // Guardar la imagen con filesystem
        $image = request()->file('imagen');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
      // Guardar el archivo en el directorio 'uploads' del sistema de archivos
        $image->storeAs('/public/uploads/', $imageName);
        //REPOSITORIO
        $Data = [
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'precio_compra' => $request->input('precio_compra'),
            'precio_venta' => $request->input('precio_venta'),
            'stock' => $request->input('stock'),
            'cantidad' => $request->input('cantidad'),
            'unidad' => $request->input('unidad'),
            'idCategoria' => $request->input('idCategoria'),
            'imagen' => $imageName,
            'activo' => 1,
        ];

        $producto = $this->productosReposit->create($Data);

        if ($producto) {
            // Redirigir al usuario a la página de detalles del producto
            return redirect()->route('edit-producto',$producto->id)->with('success','Producto creado exitosamente');
        }
    }


    /////
    ////




    //vista editar producto
    public function editProductos($id,$activo=1)
    {


        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $categorias = $this->categoriasReposit->findByState($activo);;
        $producto = $this->productosReposit->find($id);
        //dd($categorias);


        $data = [
            'titulo' => 'Editar Producto',
            'categorias' => $categorias,
            'productos' => $producto,
        ];

        return view('fdlProductos.editProducto', compact('data'));
    }


    public function updateProducto(Request $request, int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }





        // Guardar la imagen con filesystem
        $csrfToken = csrf_token();

        $request->validate([
            'codigo' => 'required|max:255',
            'nombre' => 'required|max:255',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cantidad' => 'required',
            'unidad' => 'required',
            'idCategoria' => 'required',
            'imagen' => 'image|mimes:jpeg,jpg,JPEG,JPG'

        ]);


         // Guardar la imagen con filesystem
         $image = request()->file('imagen');
         $imageName= '';
         $Data=[];

         if($image){
         $imageName = time() . '.' . $image->getClientOriginalExtension();
         $image->storeAs('/public/uploads/', $imageName);

        //REPOSITORIO

        $producto =$this->productosReposit->find($id);

        $Data=[
            'codigo' => $request->input('codigo'),
            'nombre' => $request->input('nombre'),
            'precio_compra' => $request->input('precio_compra'),
            'precio_venta' => $request->input('precio_venta'),
            'stock' => $request->input('stock'),
            'cantidad' => $request->input('cantidad'),
            'unidad' => $request->input('unidad'),
            'idCategoria' => $request->input('idCategoria'),
            'imagen' => $imageName,
            'activo' => 1,
            '_token' => $csrfToken,

        ];
         }else{
            $producto =$this->productosReposit->find($id);

            $Data=[
                'codigo' => $request->input('codigo'),
                'nombre' => $request->input('nombre'),
                'precio_compra' => $request->input('precio_compra'),
                'precio_venta' => $request->input('precio_venta'),
               'stock' => $request->input('stock'),
                'cantidad' => $request->input('cantidad'),
                'unidad' => $request->input('unidad'),
                'idCategoria' => $request->input('idCategoria'),
                'activo' => 1,
                '_token' => $csrfToken,

            ];
         }

        $producto = $this->productosReposit->update($producto,$Data);

        if($producto){
            // Redirigir al usuario a la página de detalles del producto
            return redirect()->route('productos',$producto->id)->with('success','Producto actualizado');
        }else{

        }
    }


    public function productosEliminados($activo = 0)
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $productos = $this->productosReposit->findByState($activo);


        return view('fdlProductos.eliminados', compact('productos'));
    }


    public function reingresar(int $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        //REPOSITORIO
        $producto = $this->productosReposit->find($id);

        $Data=['activo' => 1];
        // dd($producto);

        $producto = $this->productosReposit->update($producto,$Data);


        if ($producto) {
            $productos = $this->productosReposit->findByState(1);
            return redirect()->route('productos', compact('productos'))->with('success','Se ha actualizado el estado del Producto');
        } else {
            dd($producto);
        }


    }


    public function actualizarEstado(Request $request, int $id)
    {

        //Repositorio
        $producto = $this->productosReposit->find($id);
        $Data=['activo' => 0]; // Activo
        $producto = $this->productosReposit->update($producto,$Data);
        if($producto){
        return redirect()->route('productos')->with('success','Se ha actualizado el estado del producto');

        }

    }
}
