@include('dHeader')
@section('restablecer')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"> <!--?php echo $titulo;  ?-->Cambiar Contraseña</h1>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>
            <br>
            <form method="POST" action="{{route('update-password')}}" autocomplete="off"> <!--action= ?php echo base_url(); ?>/usuarios/actualizar_password-->
                @csrf
                <div class="row">
                    <div class="col-md-3 text-center">
                         
                    </div>
                    <div class="col-md-9 text-center">
                            <div class="form-group ">
                                <div class="row g-3">
                                <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="usuario" 
                                            placeholder="Ingrese el usuario" name="usuario" 
                                            value="{{$user->usuario}}" disabled /> <!--value= ?php echo $usuario['usuario'] ?>-->
                                            <label for="floatingInputGrid">Ingrese el usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nombre" 
                                            placeholder="Ingrese el nombre" name="nombre" 
                                            value="{{$user->nombre}}" disabled /> <!--value= ?php echo $usuario['nombre'] ?>-->
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
                                            <input type="password" class="form-control" id="password"
                                            placeholder="Ingrese Contraseña Nueva" name="password" autofocus required>
                                            <label for="floatingInputGrid">Ingrese Contraseña Nueva</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="repassword" 
                                            placeholder="Reingrese Contraseña Nueva" name="repassword" required/>
                                            <label for="floatingInputGrid">Reingrese Contraseña Nueva</label>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                  
                </div>   
                    <br>

                    <div class="d-grid gap-2 d-md-block">
                    <a href="/usuarios" class="btn btn-danger"> Regresar </a> <!--?php echo base_url(); ?>/usuarios-->
                    <button type="submit" class="btn btn-success"> Guardar </button>
                </div>
                <br>
                <br>
                
            </form>
            
       </div>    
       @if ($errors->has('mensaje'))
    <div class="alert alert-danger">
        {{ $errors->first('mensaje') }}
    </div>
@endif
    </main>
@endsection
@include('dFooter')
