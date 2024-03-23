
@include('dHeader')
@section('configuracion')
{{$nombre = session('nombre'),
$usuario = session('usuario')
}}
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-5">
            <h1 class="mt-4">Datos de la Empresa</h1> <!--php echo $titulo;-->
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <!-- <form method="POST"  autocomplete="off"> <!--action=" ?php echo base_url(); ? /configuracion/actualizar"-->
                @csrf


                <div class="form-group">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tienda_nombre"
                                placeholder="Nombre de la Tienda" name="tienda_nombre"
                                value="" autofocus require> <!--"?php echo $nombre['valor'] ?"-->
                                <label for="floatingInputGrid">Nombre de la Tienda</label>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-floating">
                                <textarea  class="form-control py-5" name="tienda_direccion"
                                placeholder="Direccion de la Tienda" id="tienda_direccion"
                                 require></textarea> <!--?php echo $direccion['valor']; ?-->
                                <label for="floatingInputGrid">Mision</label>
                            </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="form-floating">
                                <textarea  class="form-control py-5" name="tienda_direccion"
                                placeholder="Direccion de la Tienda" id="tienda_direccion"
                                 require disabled></textarea> <!--?php echo $direccion['valor']; ?-->
                                <label for="floatingInputGrid" >Vision</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating">
                                <textarea class="form-control py-5" id="ticket_leyenda"
                                placeholder="Leyenda de la Tienda" name="ticket_leyenda"
                                 require></textarea> <!--?php echo $leyenda['valor']; ?-->
                                <label for="floatingInputGrid">Valores</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="form-floating">
                                <textarea  class="form-control py-5" name="tienda_direccion"
                                placeholder="Direccion de la Tienda" id="tienda_direccion"
                                 require></textarea> <!--?php echo $direccion['valor']; ?-->
                                <label for="floatingInputGrid">Horarios de Atención</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-floating">
                                <textarea class="form-control py-5" id="ticket_leyenda"
                                placeholder="Leyenda de la Tienda" name="ticket_leyenda"
                                 require></textarea> <!--?php echo $leyenda['valor']; ?-->
                                <label for="floatingInputGrid">Historia</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <br>
                <a href="" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ? /clientes-->
                <button type="submit" class="btn btn-success"> Actualizar </button>
                </div>

            </form>
            </div>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    </main>
@endsection
@include('dFooter')
