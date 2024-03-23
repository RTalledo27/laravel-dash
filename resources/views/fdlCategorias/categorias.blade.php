@include('dHeader')

@section('categorias')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> <center> Categorias<!--?php echo $titulo;  ?--> </center></h1>
            
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
    @foreach ($categorias as $categoria)
    <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nombre}}</td>                                
                                <td> <a href="/categorias/editar/{{$categoria->id}}" 
                                        class="btn btn-warning"> <i class="fas fa-pencil-alt"></i></a></td>
                                <td> <a class="btn btn-danger" href="#" data-href="" data-bs-toggle="modal" data-bs-target="#modal-confirma{{$categoria->id}}" data-bs-placement="top" 
                                title="Eliminar registro"> <i class="fas fa-trash"></i></a></td>
                            </tr>



                            <!-- Modal de Confirmacion -->
    <div class="modal fade" id="modal-confirma{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="/categorias/eliminar/{{$categoria->id}}" class="btn btn-danger btn-ok">Sí</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
                            

                        <!--?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> <php echo $dato['id']; ?> </td>
                                <td> <php echo $dato['nombre']; ?> </td>                                
                                <td> <a href="<php echo base_url() . '/categorias/editar/' . $dato['id']; ?>" 
                                        class="btn btn-warning"> <i class="fas fa-pencil-alt"></i></a></td>
                                <td> <a class="btn btn-danger" href="#" data-href="<php echo base_url() . '/categorias/eliminar/' . 
                                $dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" 
                                title="Eliminar registro"> <i class="fas fa-trash"></i></a></td>
                            </tr>
                        <php } ?-->
                    </tbody>
                </table>
            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/categorias/nuevo" class="btn btn-success">Agregar Nueva Categoría</a> <!--?php echo base_url() ?>/categorias/nuevo-->

                <a href="/categorias/eliminados" class="btn btn-dark">Ver Categorías Eliminadas</a> <!--?php echo base_url() ?>/categorias/eliminados-->
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