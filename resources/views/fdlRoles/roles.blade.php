@include('dHeader')
@section('roles')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">
                <center> <!--?php echo $titulo;  ?-->Roles</center>
            </h1>

            <br>
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                        <tr data-id="{{$rol->id}}">
                                <td>{{$rol->id}}</td>
                                <td>{{$rol->rol}}</td>
                                <td> <a href="/roles/editar/{{$rol->id}}" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i></a></td>
                                <td> <a class="btn btn-danger" href="#" 
                                 data-bs-toggle="modal" data-bs-target="#modal-confirma{{$rol->id}}" 
                                 data-bs-placement="top" title="Eliminar Rol"> <i 
                                 class="fas fa-trash"></i></a></td>

                            </tr>


                             <!-- Modal de Confirmacion -->
    <div class="modal fade" id="modal-confirma{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar este Rol?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="/roles/eliminar/{{$rol->id}}" class="btn btn-danger btn-ok" data-bs-target="#modal-confirma">Sí</a>
                </div>
            </div>
        </div>
    </div>
                            @endforeach
                        <!--?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> <php echo $dato['id']; ?> </td>
                                <td> <php echo $dato['nombre']; ?> </td>

                                <td> <a href="<php echo base_url() . '/roles/editar/' 
                                . $dato['id']; ?>" class="btn btn-warning"> <i class="fas fa-pencil-alt"></i></a></td>

                                <td> <a class="btn btn-danger" href="#" data-href="<php 
                                echo base_url() . '/roles/eliminar/' . $dato['id']; ?>"
                                 data-bs-toggle="modal" data-bs-target="#modal-confirma" 
                                 data-bs-placement="top" title="Eliminar Rol"> <i 
                                 class="fas fa-trash"></i></a></td>

                            </tr>
                        <php } ?-->
                    </tbody>
                </table>
            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/roles/nuevo" class="btn btn-success">Agregar Nuevo Rol</a>

                <a href="/roles/eliminados" class="btn btn-dark">Ver Roles Eliminados</a>
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