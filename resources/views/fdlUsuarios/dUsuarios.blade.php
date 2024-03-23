@include('dHeader')
@section('nuevousr')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">
                    <center> {{ $data['titulo'] }} </center>

                </h1>

                <br>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Contraseña</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data['datos'] as $usuarios)
                                <tr>
                                    <td>{{ $usuarios->id }}</td>
                                    <td>{{ $usuarios->usuario }}</td>
                                    <td>{{ $usuarios->nombre }}</td>
                                    <td>{{ $usuarios->password }}</td>
                                    <td> <a href="/usuarios/editar/{{ $usuarios->id }}" class="btn btn-warning"> <i
                                                class="fas fa-pencil-alt"></i></a></td>
                                    <td> <a class="btn btn-danger" href="#" data-href="/usuarios/eliminar/"
                                            data-bs-toggle="modal" data-bs-target="#modal-confirma{{$usuarios->id}}" data-bs-placement="top"
                                            title="Eliminar Usuario"> <i class="fas fa-trash"></i></a></td>
                                </tr>



                                <!-- Modal de Confirmacion -->
                                <div class="modal fade" id="modal-confirma{{$usuarios->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Desea eliminar este usuario?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">No</button>
                                                <a href="/usuarios/eliminar/{{$usuarios->id}}" class="btn btn-danger btn-ok">Sí</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!--?php foreach ($datos as $dato) { ?>
                                <tr>
                                    <td> <php echo $dato['id']; ?> </td>
                                    <td> <php echo $dato['usuario']; ?> </td>
                                    <td> <php echo $dato['nombre']; ?> </td>

                                    <td> <a href="<php echo base_url() . '/usuarios/editar/' .
                                $dato['id']; ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i></a></td>

                                    <td> <a class="btn btn-danger" href="#" data-href="<php
                                echo base_url() . '/usuarios/eliminar/' . $dato['id']; ?>"
                                     data-bs-toggle="modal" data-bs-target="#modal-confirma"
                                     data-bs-placement="top" title="Eliminar Usuario"> <i
                                     class="fas fa-trash"></i></a></td>

                                </tr>
                            <php } ?-->
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="/usuarios/nuevo" class="btn btn-success">Agregar Nuevo Usuario</a>

                    <a href="/usuarios/eliminados" class="btn btn-dark">Ver Usuarios Eliminados</a>
                    <!--href= ?php echo base_url() ?>-->
                </div>
            </div>
        </main>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <br>
    @endsection
    @include('dFooter')
