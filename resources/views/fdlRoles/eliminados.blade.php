@include('dHeader')
@section('eliminadosrls')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?-->Roles Eliminados</h2>
            <div class="table-responsive">
            <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
            <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Reingresar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rol as $rol)
                        <tr>
                                <td>{{$rol->id}}</td>
                                <td>{{$rol->rol}}</td>
                                <td> <a  class="btn btn-success" href="#" data-href="" data-bs-toggle="modal" data-bs-target="#modal-confirma{{$rol->id}}" 
                                data-bs-placement="top" title="Reingresar Rol"> <i class="fas fa-arrow-alt-circle-up"></i></a></td>
                            </tr>

                             <!-- Modal de Confirmacion-->
    <div class="modal fade" id="modal-confirma{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reingresar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea reingresar este Rol?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a  href="/roles/reingresar/{{$rol->id}}" class="btn btn-danger btn-ok">Sí</a>
                </div>
            </div>
        </div>
    </div>

                            @endforeach
                       
                    </tbody>
                </table>

            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/roles" class="btn btn-danger">Regresar</a>
            </div>
        </div>
    </main>
   
@endsection
@include('dFooter')