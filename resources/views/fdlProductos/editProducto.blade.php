@include('dHeader')
@section('editarprd')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> Editar Producto <!--?php echo $titulo;  ?--></h1>
            <br>
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST"  enctype="multipart/form-data" action="{{route('update-producto',$data['productos']->id)}}" autocomplete="off"> <!--action= ?php echo base_url(); ?>/productos/actualizar-->
                @csrf
            <input type="hidden" value="{{$data['productos']->id}}" name="id" id='id'/> <!--value= ?php echo $datos['id'] ?>-->
                <div class="row">
                    <div class="col-md-3 text-center">
                        <label for="floatingInputGrid">Actualiazar Imagen</label>
                            <br>
                            <br>
                            <img src="{{ asset('storage').'/uploads/'.$data['productos']->imagen }}"
                            class="img-responsive" width="200"/> <!--src= ?php echo base_url() . '/imagen/producto/'.$datos['id'].'.jpg'?>-->
                            <br>
                            <br>
                            <input type="file" id="imagen" name="imagen" accept="image/*">
                            <p class="text-danger">Cargar imagen en formato jpg</p>

                    </div>
                    <div class="col-md-9 text-center">
                            <div class="form-group ">
                                <div class="row g-3">
                                <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="{{$data['productos']->codigo}}"
                                            name="codigo" value="{{$data['productos']->codigo}}" autofocus required> <!--value= ?php echo $datos['codigo'];?>-->
                                            <label for="floatingInputGrid">Ingrese el código</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" name="nombre"
                                            value="{{$data['productos']->nombre}}" required> <!--value= ?php echo $datos['nombre'];?>-->
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
                                            <input type="text" class="form-control" id="stock" name="stock" placeholder="Ingrese el stock del producto" name="stock"
                                            value="{{$data['productos']->stock}}" required> <!--?php echo $datos['stock'];?>-->
                                            <label for="floatingInputGrid">Ingrese el stock del producto</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="precio_compra" name="precio_compra" placeholder="Ingrese el precio de compra" name="precio_compra"
                                            value="{{$data['productos']->precio_compra}}" required> <!--value= ?php echo $datos['precio_compra'];?>-->
                                            <label for="floatingInputGrid">Ingrese el precio de compra</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="precio_venta" name="precio_venta" placeholder="Ingrese el código" name="precio_venta"
                                            value="{{$data['productos']->precio_venta}}" required> <!--value= ?php echo $datos['precio_venta'];?>-->
                                            <label for="floatingInputGrid">Ingrese el precio de venta</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <select class="form-select" name="idCategoria" id="id_categoria" required>
                                            <option value="{{$data['productos']->idCategoria}}">Seleccionar categoria</option>

                                            @foreach($data['categorias'] as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                            <!--?php foreach ($categoria as $categoria) { ?>
                                                <option value="?php echo $categoria['id']; ?>"
                                                ?php if($categoria['id'] == $datos['id_categoria']){ echo 'selected'; } ?>
                                                ><php echo $categoria['nombre']; ?>
                                                </option>
                                            ?php } ?-->
                                        </select>
                                    </div>

                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese el precio de compra"
                                            value="{{$data['productos']->cantidad}}" required> <!--Value= ?php echo set_value('precio_compra') ?>-->
                                            <label for="floatingInputGrid">Ingrese Cantidad</label>
                                        </div>
                                    </div>



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
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <br>
                    <a href="/productos" class="btn btn-danger"> Regresar </a> <!--href= ?php echo base_url(); ?>/productos-->
                    <button type="submit" class="btn btn-success"> Actualizar </button>
                </div>
                </div>
            </form>
           @include("errores")

        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    </main>
@endsection
@include('dFooter')
