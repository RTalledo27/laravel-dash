@include('dHeader')
@section('editarrls')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> <!--?php echo $titulo;  ?-->Editar Rol</h1>
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="/roles/actualizar/{{$data['roles']->id}}" autocomplete="off"> <!--action= ?php echo base_url(); ?>/roles/actualizar-->
                @csrf
                <input type="hidden" value="" name="id" /> <!--value= ?php echo $datos['id'] ?>-->
                <div class="form-group">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                value="{{$data['roles']->rol}}" autofocus required> <!--value= ?php echo $datos['nombre'] ?>-->
                                <label for="floatingInputGrid">Ingrese el nuevo nombre</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <br>
                <a href="/roles" class="btn btn-danger"> Regresar </a> <!--href= ?php echo base_url(); ?>/roles-->
                <button type="submit" class="btn btn-success"> Actualizar </button> 
                </div>
            </form>
        </div>
    </main>
@endsection
@include('dFooter')