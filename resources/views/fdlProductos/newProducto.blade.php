@include('dHeader')

@section('nuevoprd')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> {{$data['titulo']}} <!--?php echo $titulo;  ?--> </h2>
            <br>
            
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data" action="/producto/insertar" autocomplete="off"> <!--?php echo base_url(); ?>/productos/insertar-->
            @csrf    
                <div class="row">
                    <div class="col-md-3 text">
                   
                    </div>
            
                    <div class="col-md-9">
                            <div class="form-group ">
                                <div class="row g-3">
                                <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="codigo" placeholder="Ingrese el código" name="codigo" 
                                            value="" autofocus required> <!--Value="?php echo set_value('codigo') ?>"-->
                                            <label for="floatingInputGrid">Ingrese el código</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto" name="nombre" 
                                            value="" required> <!--Value= ?php echo set_value('nombre') ?>-->
                                            <label for="floatingInputGrid">Ingrese el nombre del producto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                          
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="stock" placeholder="Ingrese el stock" name="stock" 
                                            value="" required> <!--Value= ?php echo set_value('stock') ?>-->
                                            <label for="floatingInputGrid">Ingrese el stock</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="precio_compra" placeholder="Ingrese el precio de compra" name="precio_compra"
                                            value="" required> <!--Value= ?php echo set_value('precio_compra') ?>-->
                                            <label for="floatingInputGrid">Ingrese el precio de compra</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="precio_venta" placeholder="Ingrese el código" name="precio_venta"
                                            value="" required> <!--Value= ?php echo set_value('precio_venta') ?>-->
                                            <label for="floatingInputGrid">Ingrese el precio de venta</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <select class="form-select" name="idCategoria" id="idCategoria"  required>
                                            <option value="">Seleccionar categoria</option>

                                            @foreach ($data['categorias'] as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                            <!-- ?php foreach ($categorias as $categoria) { ?>
                                                <option value=" ?php echo $categoria['id']; ?>">
                                                    ?php echo $categoria['nombre']; ?>
                                                </option>
                                            ?php } ? -->
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cantidad" placeholder="Ingrese el precio de compra" name="cantidad"
                                            value="" required> <!--Value= ?php echo set_value('precio_compra') ?>-->
                                            <label for="floatingInputGrid">Ingrese Cantidad</label>
                                        </div>
                                    </div>
                                   


                            <br>
                            <div class="form-group">
                                <div class="row g-3">
                                   

                                    <div class="col-md">
                                        <select class="form-select" name="unidad" id="unidad"  required>
                                            <option value="">Seleccionar Unidad</option>


                                            <option value="kg">Kg</option>
                                            <option value="Unidad">Unidad</option>
                                            <option value="Lt">Litros</option>
                                            <!--?php foreach ($presentaciones as $presentacion) { ?>
                                                <option value="?php echo $presentacion['id']; ?>">
                                                    ?php echo $presentacion['nombre']; ?>
                                                </option>
                                            ?php } ?-->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br> 
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <label for="floatingInputGrid">Ingrese Imagen</label>
                                        <br>
                                        <br>
                                        <input type="file" id="imagen" name="imagen" accept="image/*">
                                        <p class="text-danger">Cargar imagen en formato jpg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <br>
                    <div class="d-grid gap-2 d-md-block">
                        <br>
                    <a href="/productos" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ?>/productos-->
                    <button type="submit" class="btn btn-success"> Guardar </button>
                </div>
                </div>
            </form>

           @include("errores")
        </div>
    </main>
    
@endsection

@include('dFooter')