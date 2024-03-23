@include('dHeader')
@section('editarctg')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h1 class="mt-4"> <!--?php echo $titulo;  ?-->Editar Categoría</h1>
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="post" action="{{route('update-categorias',$categoria->id)}}" autocomplete="off"> <!--action= ?php echo base_url(); ?>/categorias/actualizar-->
            @CSRF   
            <input type="hidden" value="{{$categoria->id}}" name="id" /> <!--value= ?php echo $datos['id'] ?>-->
                <div class="form-group ">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" name="nombre" 
                                value="{{$categoria->nombre}}" autofocus required > <!--value= ?php echo $datos['nombre'] ?>-->
                                <label for="floatingInputGrid">Ingrese el nuevo nombre</label>
                            </div>
                        </div>  
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <br>
                <a href="/categorias" class="btn btn-danger">Regresar</a> <!--href= ?php echo base_url(); ?>/categorias-->
                <button type="submit" class="btn btn-success"> Actualizar </button>
                </div>
            </form>
        </div>
    </main>
@endsection
@include('dFooter')