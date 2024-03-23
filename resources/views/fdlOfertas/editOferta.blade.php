@include('dHeader')

@section('editarofr')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> <!--?php echo $titulo;  ?--> Editar Oferta</h1>
            <br>
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="{{route('update-oferta',$ofertas->id)}}" autocomplete="off"> <!--action=?php echo base_url(); ?>/ofertas/actualizar-->
                @csrf
                <input type="hidden" value="" name="id" id='id'/> <!--value= ?php echo $datos['id'] ?>-->
                <div class="row">
                    <div class="col-md-3 text-center">
                        <label for="floatingInputGrid">Actualiazar Imagen</label>
                            <br>
                            <br>
                            <img src="{{ asset('storage').'/uploads/ofertas/'.$ofertas->imgOferta }}"
                            class="img-responsive" width="200"/> <!--src= ?php echo base_url() . '/imagen/oferta/'.$datos['id'].'.jpg'?>-->
                            <br>
                            <br>
                            <input type="file" id="img_ofertas" name="img_ofertas" accept="image/*">
                            <p class="text-danger">Cargar imagen en formato jpg</p>
                    </div>
                    <div class="col-md-9 text-center">
                            <div class="form-group ">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" placeholder="Oferta Asignado" name="nombre"
                                            value="" required> <!--value= ?php echo $datos['nombre'];?>-->
                                            <label for="floatingInputGrid">Oferta Asignado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <br>
                    <a href="/ofertas" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ?>/ofertas-->
                    <button type="submit" class="btn btn-success"> Actualizar </button>
                </div>
                </div>
            </form>
        </div>
    </main>

@endsection

@include('dFooter')
