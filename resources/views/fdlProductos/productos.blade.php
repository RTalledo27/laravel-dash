@include('dHeader')

@section('productos')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">
                <center> Productos <!--?php echo $titulo;  ?--> </center>
            </h1>

            <br>


            <div class="table-responsive">
                <table id="dataTable" class="table table-striped" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr> 
                            <th>Id</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($productos as $producto)
                        <tr data-id="{{ $producto->id }}">
                            <td>{{$producto->id}}</td>
                            <td>{{$producto->codigo}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->precio_venta}}</td>
                            <td>{{$producto->stock}}</td>

                            <td><a href="/productos/editar/{{$producto->id}}"><i class="btn btn-warning bi bi-pencil"></i></a></td>
                            <td><a class="btn btn-danger" href="" 
                                data-bs-toggle="modal" data-bs-target="#modal-confirma{{$producto->id}}" 
                                data-bs-placement="top" title="Eliminar registro">{{$producto->id}}<i class="bi bi-trash3"></i></a>
                            </tr>

                            

                             <!-- Modal de Confirmacion -->
    <div class="modal fade" id="modal-confirma{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <a class="btn btn-danger btn-ok" href="{{ route('editar-estado', $producto->id) }}">Sí</a>
            </div>
          </div>
        </div>
      </div>
      
                        @endforeach
                        

                     
                        <!-- ?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> ?php echo $dato['id']; ?> </td>
                                <td> ?php echo $dato['codigo']; ?> </td>
                                <td> ?php echo $dato['nombre']; ?> </td>
                                <td> ?php echo $dato['precio_venta']; ?> </td>
                                <td> ?php echo $dato['stock']; ?> </td>
                                <td> <a href="?php echo base_url() . '/productos/editar/' . 
                                $dato['id']; ?>" class="btn btn-warning"> 
                                <i class="fas fa-pencil-alt"></i></a></td>

                                <td> <a class="btn btn-danger" href="#" data-href=" ?php 
                                echo base_url() . '/productos/eliminar/' . $dato['id']; ?>" 
                                data-bs-toggle="modal" data-bs-target="#modal-confirma" 
                                data-bs-placement="top" title="Eliminar registro"> 
                                <i class="fas fa-trash"></i></a></td>

                            </tr>
                        ?php } ? -->
                    </tbody>
                </table>
            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/productos/nuevo" class="btn btn-success">Agregar Nuevo Producto</a> <!--?php echo base_url() ?>/productos/nuevo-->

                <a href="/productos/eliminados" class="btn btn-dark">Ver Productos Eliminados</a> <!-- ?php echo base_url() ?>/productos/eliminados-->
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