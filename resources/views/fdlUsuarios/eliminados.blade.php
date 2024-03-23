@include('dHeader')
@section('editarusr')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?-->Usuarios Eliminados</h2>

            

            <div class="table-responsive">
            <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
            <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Usuarios</th>
                            <th>Nombre</th>
                            <th>Reingresar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->id}}</td>
                            <td>{{$usuario->usuario}}</td>
                            <td>{{$usuario->nombre}}</td>
                            <td> <a class="btn btn-success" href="#" data-href="" data-bs-toggle="modal" data-bs-target="#modal-confirma{{$usuario->id}}" 
                                data-bs-placement="top" title="Reingresar Usuario"> <i class="fas fa-arrow-alt-circle-up"></i></a></td>
                        </tr>


                         <!-- Modal de Confirmacion-->
    <div class="modal fade" id="modal-confirma{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reingresar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea reingresar este Usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="/usuarios/reingresar/{{$usuario->id}}" class="btn btn-danger btn-ok">Sí</a>
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
                                <td> <a class="btn btn-success" href="#" data-href="<php echo base_url() . '/usuarios/reingresar/' 
                                . $dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" 
                                data-bs-placement="top" title="Reingresar Usuario"> <i class="fas fa-arrow-alt-circle-up"></i></a></td>
                            </tr>
                        <php } ?-->
                    </tbody>
                </table>

            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/usuarios" class="btn btn-danger">Regresar</a> <!--href= ?php echo base_url() ?>/usuarios-->
            </div>
        </div>
    </main>
   
@endsection
@include('dFooter')