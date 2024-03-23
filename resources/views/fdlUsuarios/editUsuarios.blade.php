@include('dHeader')
@section('editarusr')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> <!--?php echo $titulo; ?-->Editar Usuario</h1>
            <br>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="{{route('update-usuarios',$data['usuario']->id)}}" autocomplete="off"> <!--action= ?php echo base_url(); ?>/usuarios/actualizar-->
            @csrf
            <input type="hidden" value="" name="id" /> <!--?php echo $datos['id'] ?>-->
                <div class="row">
                    <div class="col-md-3 text-center">
                         
                    </div>
                    <div class="col-md-9 text-center">
                            <div class="form-group ">
                                <div class="row g-3">
                                <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="usuario" placeholder="Ingrese el usuario" name="usuario" 
                                            value="{{$data['usuario']->usuario}}" autofocus required> <!--value ?php echo $datos['usuario'] ?>-->
                                            <label for="floatingInputGrid">Ingrese el usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" name="nombre" 
                                            value="{{$data['usuario']->nombre}}" required> <!--value= ?php echo $datos['nombre'] ?>-->
                                            <label for="floatingInputGrid">Ingrese el nombre</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" placeholder="Ingrese la contraseña" name="password" 
                                            value="{{$data['usuario']->password}}" required> <!--value= ?php echo $datos['password'] ?>-->
                                            <label for="floatingInputGrid">Ingrese la contraseña</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <select class="form-select" name="id_caja" id="id_caja"  required>
                                            <option value="">Seleccionar cajas</option>
                                            @foreach ($data['cajas'] as $cajas)
                                            <option value="{{$cajas->id}}">{{$cajas->nombre}}

                                            @endforeach 

                                            <!--?php foreach ($cajas as $caja) { ?>
                                                <option value="<php echo $caja['id']; ?>"
                                                <php if($caja['id'] == $datos['id_caja']){ echo 'selected'; } ?>
                                                ><php echo $caja['nombre']; ?>
                                                </option>
                                            <php } ?-->
                                        </select>
                                    </div>

                                    <div class="col-md">
                                        <select class="form-select" name="id_rol" id="id_rol"  required>
                                            <option value="">Seleccionar rol</option>

                                            @foreach ($data['rol'] as $roles)
                                            <option value="{{$roles->id}}">{{$roles->rol}}

                                            @endforeach 
                                            <!--?php foreach ($roles as $rol) { ?>
                                                <option value="<php echo $rol['id']; ?>"
                                                <php if($rol['id'] == $datos['id_rol']){ echo 'selected'; } ?>
                                                ><php echo $rol['nombre']; ?>
                                                </option>
                                            <php } ?-->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <br>
                    <a href="/usuarios" class="btn btn-danger"> Regresar </a>
                    <button type="submit" class="btn btn-success"> Guardar </button>
                </div>
                </div>
            </form>
        </div>
    </main>
@endsection
@include('dFooter')