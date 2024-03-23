@include('dHeader')
@section('nuevocjs')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-5">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?-->Agregar Caja</h2>
            
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="/cajas/insertar" autocomplete="off"> <!--action= ?php echo base_url(); ?>/cajas/insertar-->
                @csrf
                <div class="form-group ">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="numero_caja" placeholder="Ingrese Numero de Caja" name="numero_caja" 
                                value="" autofocus required> <!--value= ?php echo set_value('numero_caja') ?>-->
                                <label for="floatingInputGrid">Ingrese Numero de Caja</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre de Caja" name="nombre" 
                                value="" required> <!--value= ?php echo set_value('nombre') ?>-->
                                <label for="floatingInputGrid">Ingrese el nombre de Caja</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                <a href="/cajas" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ?>/cajas-->
                <button type="submit" class="btn btn-success"> Guardar </button> 
                </div>
            </form>
        </div>
    </main>
@endsection
@include('dFooter')