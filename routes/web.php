<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CajasController;
use App\Http\Controllers\OfertasController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('dashboard');


Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }


    return view('configuracion.configuracion');
})->name('dashboard');




//productos:

Route::controller(ProductosController::class)->group(function () {
    Route::get('/productos', 'index')->name('productos');

    Route::get('/productos/nuevo', 'newProductos')->name('nuevo-producto');
    Route::post('/producto/insertar', 'createProduct')->name('usuario-insertar');

    Route::get('/productos/editar/{id}', 'editProductos')->name('edit-producto');
    Route::post('/producto/actualizar/{id}', 'updateProducto')->name('update-producto');


    Route::get('/producto/eliminar/{id}', 'actualizarEstado')->name('editar-estado');
    //Route::get('/producto/eliminar/{id}',[ProductosController::class,'actualizarEstado'])->name('editar-estado');

    ///VER Productos INACTIVOS
    Route::get('/productos/eliminados', 'productosEliminados')->name('viewP-eliminados ');
    //DESHACER ROL INACTIVO
    Route::get('/productos/reingresar/{id}', 'reingresar')->name('reingresar-productos');
});




///CATEGORIAS:
Route::controller(CategoriasController::class)->group(function () {
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias');
    Route::get('/categorias/nuevo', [CategoriasController::class, 'newCategoria'])->name('nueva-categoria');
    Route::post('/categorias/insertar', [CategoriasController::class, 'createCategoria'])->name('categoria-insertar');

    Route::get('/categorias/editar/{id}', [CategoriasController::class, 'editCategoria'])->name('editar-categorias');
    Route::post('/categorias/actualizar/{id}', [CategoriasController::class, 'updateCategoria'])->name('update-categorias');



    //DESACTIVAR CATEGORIAS
    Route::get('/categorias/eliminar/{id}', [CategoriasController::class, 'actualizarEstado'])->name('delete-categoria');

    ///VER Categorias INACTIVOS
    Route::get('/categorias/eliminados', [CategoriasController::class, 'categoriasEliminados'])->name('view-categoria ');
    //DESHACER Categoria INACTIVO
    Route::get('/categorias/reingresar/{id}', [CategoriasController::class, 'reingresar'])->name('reingresar-categoria');
});


//Usuarios:

Route::controller(UsuariosController::class)->group(function () {
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios');


    Route::get('/usuarios/nuevo', [UsuariosController::class, 'newUsuarios'])->name('nuevo-usuario');
    Route::post('/usuarios/insertar', [UsuariosController::class, 'createUsuario'])->name('producto-insertar');
    Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'editUsuario'])->name('editar-usuarios');
    Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'updateUsuario'])->name('update-usuarios');

    //DESACTIVAR CATEGORIAS
    Route::get('/usuarios/eliminar/{id}', [UsuariosController::class, 'actualizarEstado'])->name('delete-usuario');

    ///VER Categorias INACTIVOS
    Route::get('/usuarios/eliminados', [UsuariosController::class, 'usuariosEliminados'])->name('view-usuario ');
    //DESHACER Categoria INACTIVO
    Route::get('/usuarios/reingresar/{id}', [UsuariosController::class, 'reingresar'])->name('reingresar-usuario');
});





//ROLES:

Route::controller(RolesController::class)->group(function () {
    Route::get('/roles', 'index')->name('roles');



    Route::middleware('role:Admin')->group(function () {
        Route::get('/roles/nuevo', 'newRol')->name('nuevo-rol');
        Route::post('/roles/insertar', 'createRol')->name('rol-insertar');

        Route::get('/roles/editar/{id}', 'editRol')->name('editar-rol');
        Route::post('/roles/actualizar/{id}', 'updateRol')->name('update-rol');
        ///DESACTIVAR ROL, ELIMINAR
        Route::get('/roles/eliminar/{id}', 'actualizarEstado')->name('delete-rol');
        ///VER ROLES INACTIVOS
        Route::get('/roles/eliminados', 'rolesEliminados')->name('viewR-eliminados ');
        //DESHACER ROL INACTIVO
        Route::get('/roles/reingresar/{id}', 'reingresar')->name('reingresar-rol');
    });
});

//CAJAS

Route::controller(CajasController::class)->group(function () {
    Route::get('/cajas',  'index')->name('cajas');


    Route::middleware('role:Admin')->group(function(){
 Route::get('/cajas/nuevo',  'newCaja')->name('nueva-caja');
    Route::post('/cajas/insertar', 'createCaja')->name('caja-insertar');

    Route::get('/cajas/editar/{id}', 'editCaja')->name('editar-caja');
    Route::post('/cajas/actualizar/{id}', 'updateCaja')->name('update-caja');

    ///DESACTIVAR ROL, ELIMINAR
    Route::get('/cajas/eliminar/{id}', 'actualizarEstado')->name('delete-caja');
    ///VER ROLES INACTIVOS
    Route::get('/cajas/eliminados', 'cajasEliminadas')->name('viewC-eliminados ');
    //DESHACER ROL INACTIVO
    Route::get('/cajas/reingresar/{id}', 'reingresar')->name('reingresar-caja');

    });

});

//OFERTAS

Route::get('/ofertas', [OfertasController::class, 'index'])->name('ofertas');
Route::get('/ofertas/nuevo', [OfertasController::class, 'newOferta'])->name('nueva-oferta');
Route::post('/ofertas/insertar', [OfertasController::class, 'createOferta'])->name('oferta-insertar');

Route::get('/ofertas/editar/{id}', [OfertasController::class, 'editOferta'])->name('editar-oferta');
Route::post('/ofertas/actualizar/{id}', [OfertasController::class, 'updateOferta'])->name('update-oferta');
///DESACTIVAR ROL, ELIMINAR
Route::get('/ofertas/eliminar/{id}', [OfertasController::class, 'actualizarEstado'])->name('delete-oferta');
///VER ROLES INACTIVOS
Route::get('/ofertas/eliminados', [OfertasController::class, 'ofertasEliminadas'])->name('viewO-eliminados ');
//DESHACER ROL INACTIVO
Route::get('/ofertas/reingresar/{id}', [OfertasController::class, 'reingresar'])->name('reingresar-oferta');






//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Reset contraseña

Route::get('/password', [UsuariosController::class, 'changePass'])->name('change-password');
Route::post('/password', [UsuariosController::class, 'updatePass'])->name('update-password');
