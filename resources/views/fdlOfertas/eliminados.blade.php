@include('dHeader')

@section('editarofr')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <!--?php echo $titulo;?-->Ofertas Eliminadas</h2>

            <div class="table-responsive">
                <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
                    <thead class="table-dark">

                        @foreach ($ofertas as $oferta)


                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Reingresar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$oferta->id}}</td>
                            <td>{{$oferta->nombre}}</td>
                            <td> <a class="btn btn-success" href="#" data-href="" data-bs-toggle="modal" data-bs-target="#modal-confirma{{$oferta->id}}" data-bs-placement="top" title="Reingresar registro"> <i class="bi bi-arrow-up-circle"></i></a></td>
                        </tr>



 <!-- Modal de Confirmacion-->
 <div class="modal fade" id="modal-confirma{{$oferta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reingresar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea reingresar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="/ofertas/reingresar/{{$oferta->id}}" class="btn btn-danger btn-ok">Sí</a>
            </div>
        </div>
    </div>
</div>

                        @endforeach








                        <!--?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> <php echo $dato['id']; ?> </td>
                                <td> <php echo $dato['nombre']; ?> </td>
                                <td> <a class="btn btn-success" href="#" data-href="
                                <php echo base_url() . '/ofertas/reingresar/' .
                                $dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma"
                                data-bs-placement="top" title="Reingresar Oferta">
                                <i class="fas fa-arrow-alt-circle-up"></i></a></td>
                            </tr>
                        ?php } ?-->
                    </tbody>
                </table>

            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/ofertas" class="btn btn-danger">Regresar</a> <!--?php echo base_url() ?>/ofertas-->
            </div>
        </div>
    </main>

@endsection

@include('dFooter')
