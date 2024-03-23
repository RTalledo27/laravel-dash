@yield('configuracion')
@yield('productos')
@yield('nuevoprd')
@yield('editarprd')
@yield('eliminadosprd')
@yield('categorias')
@yield('nuevoctg')
@yield('editarctg')
@yield('eliminadosctg')
@yield('usuarios')
@yield('nuevousr')
@yield('editarusr')
@yield('eliminadosusr')
@yield('restablecer')
@yield('cajas')
@yield('nuevocjs')
@yield('editarcjs')
@yield('eliminadoscjs')
@yield('roles')
@yield('nuevorls')
@yield('editarrls')
@yield('eliminadosrls')
@yield('ofertas')
@yield('nuevoofr')
@yield('editarofr')
@yield('eliminadosofr')

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


<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>
