@include('dHeader')
@section('nuevorls')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?-->Agregar Rol</h2>
            <br>
            
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="/roles/insertar" autocomplete="off"> <!--action= ?php echo base_url(); ?>/roles/insertar-->
                @csrf
                <div class="form-group ">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" name="nombre" 
                                value="" autofocus required> <!--value= ?php echo set_value('nombre') ?>-->
                                <label for="floatingInputGrid">Ingrese el Nombre</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <br>
                <a href="/roles" class="btn btn-danger"> Regresar </a> <!--href= ?php echo base_url(); ?>/roles-->
                <button type="submit" class="btn btn-success"> Guardar </button> 
                </div>
            </form>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        </div>
    </main>
@endsection
@include('dFooter')