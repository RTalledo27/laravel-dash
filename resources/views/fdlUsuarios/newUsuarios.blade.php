@include('dHeader')
@section('nuevousr')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"> <!--?php echo $titulo;  ?-->Agregar Empleado</h2>
            <br>
            
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="/usuarios/insertar" 
            autocomplete="off"> <!--action= ?php echo base_url(); ?>/usuarios/insertar"-->
            @csrf    
            <div class="row">
                    <div class="col-md-3 text-center">
                         
                    </div>
                    <div class="col-md-9 text-center">
                            <div class="form-group ">
                                <div class="row g-3">
                                <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="usuario" placeholder="Ingrese el usuario" name="usuario" 
                                            value="" autofocus required> <!--value= ?php echo set_value('usuario') ?>-->
                                            <label for="floatingInputGrid">Ingrese el usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre" name="nombre" 
                                            value="" required> <!--value= ?php echo set_value('nombre') ?>-->
                                            <label for="floatingInputGrid">Ingrese el nombre</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" placeholder="Ingrese la contraseña" name="password" 
                                            value="" required> <!--value= ?php echo set_value('password') ?>-->
                                            <label for="floatingInputGrid">Ingrese la contraseña</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="repassword" placeholder="Reingrese la contraseña" name="repassword"
                                            value="" required> <!--value= ?php echo set_value('repassword') ?>-->
                                            <label for="floatingInputGrid">Reingrese la contraseña</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <select class="form-select" name="id_caja" id="id_caja"  required>
                                            <option value="">Seleccionar cajas</option>

                                            @foreach ($data['cajas'] as $caja)
                                                <option value="{{$caja->id}}">
                                                    {{$caja->nombre}}
                                                </option>

                                            @endforeach

                                            <!--?php foreach ($cajas as $caja) { ?>
                                                <option value="<php echo $caja['id']; ?>">
                                                    <php echo $caja['nombre']; ?>
                                                </option>
                                            <php } ?-->
                                        </select>
                                    </div>

                                    <div class="col-md">
                                        <select class="form-select" name="id_rol" id="id_rol"  required>
                                            <option value="">Seleccionar rol</option>
                                            @foreach ($data['roles'] as $caja)
                                            <option value="{{$caja->id}}">
                                                {{$caja->rol}}
                                            </option>

                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                
                        
                        
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <br>
                    <a href="/usuarios" class="btn btn-danger"> Regresar </a> <!--href= ?php echo base_url(); ?>/usuarios-->
                    <button type="submit" class="btn btn-success"> Guardar </button>
                </div>
                </div>
            </form>
        </div>
        @include('errores')
    </main>
@endsection
@include('dFooter')