@include('dHeader')
@section('eliminadosprd')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?--> Productos Eliminados</h2>



            <div class="table-responsive">
                <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Reingresar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->codigo}} </td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->precio_venta}}</td>
                            <td>{{$producto->stock}}</td>
                            <td><a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#modal-confirma{{$producto->id}}" 
                                data-bs-placement="top" title="Reingresar Oferta" href=""><i class="bi bi-arrow-up-circle"></i></a></td>
                        </tr>


                        <div class="modal fade" id="modal-confirma{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a href="/productos/reingresar/{{$producto->id}}"class="btn btn-danger btn-ok">Sí</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!--?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> <php echo $dato['id']; ?> </td>
                                <td> <php echo $dato['codigo']; ?> </td>
                                <td> <php echo $dato['nombre']; ?> </td>
                                <td> <php echo $dato['precio_venta']; ?> </td>
                                <td> <php echo $dato['stock']; ?> </td>
                                <td> <a class="btn btn-success" href="#" data-href="
                                <php echo base_url() . '/productos/reingresar/' . 
                                $dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" 
                                data-bs-placement="top" title="Reingresar registro"> 
                                <i class="fas fa-arrow-alt-circle-up"></i></a></td>
                            </tr>
                        <php } ?-->
                    </tbody>
                </table>

            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/productos" class="btn btn-danger">Regresar</a> <!--href= ?php echo base_url() ?>/productos-->
            </div>
        </div>
    </main>
    <!-- Modal de Confirmacion-->
   
@endsection
@include('dFooter')