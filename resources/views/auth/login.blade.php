<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karina Stores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="img/tienda.png"/>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" crossorigin="anonymous">
    <script src="js/all.min.js"></script>

    <style>
        body {
            background-image: url({{asset('img/login.JPG')}});
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <body class ="bg-primary">
        <!--user session nombre-->
       <div id="layoutAuthentication">
           <div id="layoutAuthentication_content">
               <main>
                   <div class="container">
                       <div class="row justify-content-center">
                           <div class="col-lg-5">
                               <div class="card shadow-lg border-0 rounded-lg mt-5">
                                   <div class="card-header">
                                       <h3 class="text-center font-weight-light my-4"><i class="bi bi-shop-window"></i> Tienda Karina Store </h3>
                                   </div>
                                   <div class="card-body">
                                    <form method="POST" action="/login">
                                        @csrf
                                        <div class="form-group"><i class="bi bi-person"></i>
                                            <label class="mb-1" for="usuario">Usuario</label>
                                            <br>
                                            <input class="form-control py-4" id="usuario" name="usuario" type="text"
                                            placeholder="Ingrese su Usuario" autofocus/> <!--propiedad required-->
                                        </div>
                                        <br>
                                        <div class="form-group"><i class="bi bi-lock"></i>
                                            <label class="mb-1" for="password">Contraseña</label>
                                            <input class="form-control py-4" id="password" name="password" type="password" 
                                            placeholder="Ingrese su Contraseña" /> <!--propiedad required-->
                                        </div>
                                        
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Ingresar</button>
                                        </div>
                                        <br>
                                       
                                       <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif-->

@if (isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <br>
       
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Karina Store <?php  echo date('Y');?></div>
                <div>
                    <a href="https://wa.me/+51999449386" target="_blank">WhastApp</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
            </div> 
        </footer>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/scripts.js"></script>
</body>

</html>