@include('dHeader')
@section('nuevoofr')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?--> Nueva Oferta</h2>
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data" action="/ofertas/insertar" autocomplete="off"> <!--action= ?php echo base_url(); ?>/ofertas/insertar-->
                @csrf
                <div class="row">
                    <div class="col-md-3 text">

                    </div>

                    <div class="col-md-9">
                            <div class="form-group ">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre de la Oferta" name="nombre"
                                            value="" required> <!--value= ?php echo set_value('nombre') ?>-->
                                            <label for="floatingInputGrid">Ingrese el nombre de la Oferta</label>
                                        </div>
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
                                        <input type="file" id="img_ofertas" name="img_ofertas" accept="image/*">
                                        <p class="text-danger">Cargar imagen en formato jpg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <br>
                    <div class="d-grid gap-2 d-md-block">
                        <br>
                    <a href="/ofertas/nuevo" class="btn btn-danger"> Regresar </a> <!--href= ?php echo base_url(); ?>/ofertas-->
                    <button type="submit" class="btn btn-success"> Guardar </button>
                </div>
                </div>
            </form>
        </div>

        @include('errores')
    </main>
@endsection
@include('dFooter')
