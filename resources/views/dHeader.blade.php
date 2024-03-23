


<!DOCTYPE html>
<html lang="es">
   
{{$nombre = session('nombre'),
$usuario = session('usuario'),
$rol = session('rol'),
$id = session('id')
}}
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Karina Store</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="icon" href="{{ asset('img/tienda.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" crossorigin="anonymous">
    <script src="{{ asset('js/all.min.js') }}"></script>
</head>


<body class="sb-nav-fixed">
  
    @if (auth()->check())
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="/configuracion"><i class="bi bi-shop-window"> </i> Karina Store</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" 
        href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" 
                data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-user fa-fw"></i> {{$usuario}} <!--?php echo $user_session->nombre ?-->  </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a href="{{route('change-password',compact('id'))}}" class="dropdown-item" >Cambiar Contraseña</a></li> <!--href="?php echo base_url(); ? /usuarios/cambiar_password"-->
                  
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a href="{{ route('logout') }}" class="dropdown-item" >Cerrar Sesion</a></li> <!--href="?php echo base_url(); ? /usuarios/logout"-->
                </ul>
            </li>
        </ul>
    </nav>
@endif

    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="sb-sidenav-menu-heading ">Menú de opciones</div>
                        <a class="nav-link collapsed" id="productos"href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" a
                        ria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/productos">Productos</a> <!--href="?php echo base_url(); ?>/productos"-->
                                <a class="nav-link" href="/categorias" >Categorías</a> <!--href="?php echo base_url(); ?>/categorias"-->
                            <!--<a class="nav-link" href="/presentaciones">Presentaciones</a> <!--href="?php echo base_url(); ?>/presentaciones"-->
                            <!--    <a class="nav-link" href="/unidades">Unidades</a> <!--href="?php echo base_url(); ?>/unidades"-->
                            
                            </nav>
                        </div>

                        @if ($rol=='Admin')
                        <a class="nav-link" href="/usuarios"> <!--href="?php echo base_url(); ?>/clientes"-->
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Empleados</a>
                        @endif
                        
                 
                        <a class="nav-link collapsed" id="administracion" href="#" data-bs-toggle="collapse" data-bs-target="#admin" a
                        ria-expanded="false" aria-controls="admin"><div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Administracion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="admin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                              <!--  <a class="nav-link" href="/configuracion">Empresa</a> --> <!--?php echo base_url(); ?>/configuracion-->
                              <!--  <a class="nav-link" href="/usuarios">Usuarios</a>--> <!--?php echo base_url(); ?>/usuarios-->
                                <a class="nav-link" href="/cajas">Cajas</a> <!--?php echo base_url(); ?>/cajas-->
                                <a class="nav-link" href="/roles">roles</a> <!--?php echo base_url(); ?>/roles-->
                    
                            </nav>
                        </div> 
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#oferta" a
                        ria-expanded="false" aria-controls="oferta"><div class="sb-nav-link-icon"><i class="fas fa-bookmark"></i></div>
                            Ofertas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="oferta" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/ofertas">Oferta</a> <!--?php echo base_url(); ?>/ofertas-->
                            </nav>
                        </div> 
                    </div>
                </div>
            </nav>
        </div>

        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>