@include('dHeader')
@section('cajas')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">
                    <center> <!--?php echo $titulo;  ?-->Cajas</center>
                </h1>

                <br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Numero_Caja</th>
                                <th>Nombre</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cajas as $caja)
                                <tr>
                                    <td>{{ $caja->id }}</td>
                                    <td>{{ $caja->numero_caja }}</td>
                                    <td>{{ $caja->nombre }}</td>
                                    <td> <a href="/cajas/editar/{{ $caja->id }}" class="btn btn-warning"> <i
                                                class="fas fa-pencil-alt"></i></a></td>

                                    <td> <a class="btn btn-danger" href="#" data-href="" data-bs-toggle="modal"
                                            data-bs-target="#modal-confirma{{ $caja->id }}" data-bs-placement="top"
                                            title="Eliminar Cajas"> <i class="fas fa-trash"></i></a></td>


                                    <!-- Modal de Confirmacion -->
                                    <div class="modal fade" id="modal-confirma{{$caja->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Caja</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea eliminar esta Caja?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                    <a href="/cajas/eliminar/{{$caja->id}}" class="btn btn-danger btn-ok">Sí</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                            <!--?php foreach ($datos as $dato) { ?>
                                <tr>
                                    <td> <php echo $dato['id']; ?> </td>
                                    <td> <php echo $dato['numero_caja']; ?> </td>
                                    <td> <php echo $dato['nombre']; ?> </td>

                                    <td> <a href="<php echo base_url() . '/cajas/editar/' 
                                . $dato['id']; ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i></a></td>

                                    <td> <a class="btn btn-danger" href="#" data-href="<php 
                                echo base_url() . '/cajas/eliminar/' . $dato['id']; ?>"
                                     data-bs-toggle="modal" data-bs-target="#modal-confirma"
                                     data-bs-placement="top" title="Eliminar Cajas"> <i
                                     class="fas fa-trash"></i></a></td>

                                </tr>
                            <php } ?-->
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="cajas/nuevo" class="btn btn-success">Agregar Caja Nueva</a>
                    <!--<php echo base_url() ?>/cajas/nuevo-->

                    <a href="cajas/eliminados" class="btn btn-dark">Ver Cajas Eliminadas</a>
                    <!--?php echo base_url() ?>/cajas/eliminados-->
                </div>
            </div>
        </main>
        <br>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @endsection
    @include('dFooter')
