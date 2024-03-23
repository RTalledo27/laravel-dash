@include('dHeader')
@section('nuevoctg')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?-->Nueva Categoría</h2>
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="/categorias/insertar" autocomplete="off"> <!--action= ?php echo base_url(); ?>/categorias/insertar-->
            @csrf
                <div class="form-group ">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" name="nombre" 
                                value=""autofocus required> <!--value= ?php echo set_value('nombre') ?>-->
                                <label for="floatingInputGrid">Ingrese el nombre</label>
                            </div>
                        </div>
                        <div class="col-md">
                        </div>   
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <br>
                <a href="/categorias" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ?>/categorias-->
                <button type="submit" class="btn btn-success"> Guardar </button> 
                </div>
            </form>
        </div>
    </main>
@endsection
@include('dFooter')