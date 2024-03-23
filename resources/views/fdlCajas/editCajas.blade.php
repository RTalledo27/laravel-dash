@include('dHeader')
@section('editarcjs')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> <!--?php echo $titulo;  ?-->Editar Caja</h1>
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="/cajas/actualizar/{{$caja->id}}" autocomplete="off"> <!--action= ?php echo base_url(); ?>/cajas/actualizar-->
                @csrf
                <input type="hidden" value="" name="id" /> <!--value= ?php echo $datos['id'] ?>-->
                
                <div class="form-group">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="numero_caja" name="numero_caja" 
                                value="{{$caja->numero_caja}}" autofocus required> <!--value= ?php echo $datos['numero_caja'] ?> -->
                                <label for="floatingInputGrid">Ingrese el nuevo numero de caja</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre"  name="nombre" 
                                value="{{$caja->nombre}}" required> <!--value= ?php echo $datos['nombre'] ?>-->
                                <label for="floatingInputGrid">Ingrese el nuevo nombre</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <br>
                <a href="/cajas" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ?>/cajas--> 
                <button type="submit" class="btn btn-success"> Actualizar </button> 
                </div>
            </form>
            @include("errores")
        </div>
    </main>
@endsection
@include('dFooter')