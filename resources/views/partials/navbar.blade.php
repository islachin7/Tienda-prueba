<style>

.form-control::placeholder { color: black; }

.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
}

</style>
 


<nav class="navbar navbar-expand-lg navbar-light bg-warning justify-content-center">
  <a class="navbar-brand" href="{{ route('index') }}">
  <img class="img-fluid" style="width:220px;" src="{{ url('/images/nuevologo.png') }}" alt="logo">
  </a>
  <button class="navbar-toggler" type="button" id="raton" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-center text-center" id="nosdsd">
  <ul class="navbar-nav mr-auto"></ul>
 
  <div class="dropdown justify-content-center text-center">
    @guest
        <a href="#" class="btn btn-info ml-2" data-toggle="modal" data-target="#registro" data-hover="Registrarme">Registrarme</a>
        <a href="#" class="btn btn-info ml-2" data-toggle="modal" data-target="#login" data-hover="Entrar">Entrar</a>
    @else

    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Hola: {{ Auth::user()->name }} <i class="fa fa-user"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editar">Perfil</a>
        <a class="dropdown-item" href="{{ route('mis_pedidos') }}" >Mis pedidos</a>
        @can('dashboard')
        <a class="dropdown-item" href="{{ route('dashboard') }}">Dash</a> 
        @endcan
        <a class="dropdown-item" href="{{ route('logout') }}">Salir</a>
    </div>
    @endguest

</div>
  
  </div>

</nav>



<script>

$('#raton').on('click',function(){

   if($('#nosdsd').hasClass("show") == true){
    $('#nosdsd').removeClass("show");
   }else{
    $('#nosdsd').addClass("show");
   }


});
</script>


<!-- Modal registro -->
<div class="modal fade" id="registro"  role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" id="registro-cerrar" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <section class="page-section-ptb">
        <div class="container">
            <div class="row">
                        <div class="col-lg-12 text-center title-line mb-50">
                            <h2 class="slick-title">Registro</h2>
                            <p>Completa tus datos para poder registrarte.</p>
                        </div>

                        <div class="login-form">
                            <form method="post" class="text-center" action="{{ route('post-register') }}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="apellido_paterno" placeholder="Apellido Paterno">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" maxlength="30" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" minlength="4" maxlength="8" placeholder="Contraseña">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn theme-button  animated slideInRight">Registrarme</button>
                            </form>
                            <div class="row">
                                <div class="col text-center">
                                    <a href="#" id="ingreso-bon" data-toggle="modal" data-target="#login" class="float-right">Ingresar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
      </div>
    </div>
  </div> 
</div>


<!-- Modal editar registro  -->
<div class="modal fade" id="editar"  role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" id="registro-cerrar" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="datosEditar">

            <div class="row">
                        <div class="col-lg-12 text-center title-line">
                            <h2 class="slick-title">Perfil</h2>
                        </div>
                        <div class="login-form">
                            <form method="post" action=" {{ route('post-update') }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="text" hidden name="id" value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}">
                                <div class="row">
                                <div class="col-lg-6 text-center">
                                  <div class="form-group">
                                  <img id="preview"  height="200" alt="" src="{{ isset(Auth::user()->foto) ? url('/images/usuarios/' . Auth::user()->foto) : '' }}" width="180">
                                  <span class="btn btn-primary btn-file mt-3">
                                    Subir Imagen <input type="file" id="foto" value="{{ isset(Auth::user()->foto) ? Auth::user()->foto : '' }}" name="foto">
                                  </span>
                                  </div>
                                </div>
                                <div class="col-lg-6 row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" value=" {{ isset(Auth::user()->name) ? Auth::user()->name : '' }}" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="apellido_paterno" value="{{ isset(Auth::user()->apellido_paterno) ? Auth::user()->apellido_paterno : '' }}" placeholder="Apellido Paterno">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="documento" value="{{ isset(Auth::user()->documento) ? Auth::user()->documento : '' }}" placeholder="N. Documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="celular" value="{{ isset(Auth::user()->celular) ? Auth::user()->celular : '' }}"  placeholder="Celular">
                                        </div>
                                    </div>
                                </div>
   
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="PER" selected>PER</option>
                                                <option value="ARG">ARG</option>
                                            </select>
                                        </div>                                   
                                    </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select id="dpto" class="form-control" required="">    
                                                    <option value="" selected>Departamento:</option>
                                                    <option value="1">AMAZONAS</option>
                                                    <option value="2">ANCASH</option>
                                                    <option value="3">APURIMAC</option>
                                                    <option value="4">AREQUIPA</option>
                                                    <option value="5">AYACUCHO</option>
                                                    <option value="6">CAJAMARCA</option>
                                                    <option value="7">CALLAO</option>
                                                    <option value="8">CUSCO</option>
                                                    <option value="9">HUANCAVELICA</option>
                                                    <option value="10">HUANUCO</option>
                                                    <option value="11">ICA</option>
                                                    <option value="12">JUNIN</option>
                                                    <option value="13">LA LIBERTAD</option>
                                                    <option value="14">LAMBAYEQUE</option>
                                                    <option value="15">LIMA</option>
                                                    <option value="16">LORETO</option>
                                                    <option value="17">MADRE DE DIOS</option>
                                                    <option value="18">MOQUEGUA</option>
                                                    <option value="19">PASCO</option>
                                                    <option value="20">PIURA</option>
                                                    <option value="21">PUNO</option>
                                                    <option value="22">SAN MARTIN</option>
                                                    <option value="23">TACNA</option>
                                                    <option value="24">TUMBES</option>
                                                    <option value="25">UCAYALI</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div class="form-group">
                                        <select class="form-control" id="ciudad" required="">
                                            <option>Ciudad:</option>
                                        </select> 
                                        </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div class="form-group">
                                        <select class="form-control" name="idDist" id="distrito" required="">
                                            <option>Distrito</option>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="urbanizacion" value="{{ isset(Auth::user()->urbanizacion) ? Auth::user()->urbanizacion : '' }}"  placeholder="Urbanización">
                                        </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="form-group">
                                        <textarea name="direccion" id="" rows="2" maxlength="40" class="form-control"  placeholder="Dirección">{{ isset(Auth::user()->direccion) ? Auth::user()->direccion : '' }}</textarea>
                                        </div>
                                        </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" maxlength="30" value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="respuestaSecreta" minlength="4" maxlength="8" placeholder="respuesta Secreta" value="{{ isset(Auth::user()->respuestaSecreta) ? Auth::user()->respuestaSecreta : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn theme-button  animated slideInRight">ACtualizar</button>
                                </div>
                                
                            </form>
                        </div>
                </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal login-->
<div class="modal fade" id="login"  role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" id="login-cerrar" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <section class="page-section-ptb">
        <div class="container">
            <div class="row ">                    
                        <div class="col-lg-12 text-center title-line">
                            <h2 class="slick-title">LOGIN</h2>
                            <p>Ingresa a tu cuenta</p>
                        </div>
                        <div class="col-lg-12 text-center title-line">
                        <div class="login-form text-center">
                            <form method="post" class="text-center" action="{{ route('post-login') }}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" maxlength="30" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" minlength="4" maxlength="8" placeholder="Contraseña">
                                </div>
                                <button type="submit" class="btn theme-button animated slideInRight">INGRESAR</button>
                            </form>
                            <div class="row">
                                <div class="col text-center">
                                    <a href="#" class="float-right">Olvide mi clave</a>
                                    <a href="#" id="sincuenta" data-toggle="modal" data-target="#registro" class="float-left">No tengo cuenta</a>
                                </div>
                            </div>
                        </div>
                    </div>         
              </div>
            </div>
      </section>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(e) {

 $("#sincuenta").click(function(){

    $("#login-cerrar").click();
    $(".modal-backdrop").remove();
    
 });


 $("#ingreso-bon").click(function(){

    $("#registro-cerrar").click();
    $(".modal-backdrop").remove();
    
});


/* PREVIEW */
foto.onchange = evt => {
            const [file] = foto.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        };

});

</script>

<script>

        $('#dpto').on('change', cambiarCiudad);

        function cambiarCiudad()
        {
            $("#distrito").empty();
            $("#distrito").html('<option value="" selected>Distrito:</option>');

            var depart = $('#dpto').val();
            
            var url_buscar = "{{ route('cambiaCiudad') }}";
            $.ajax({
                url: `${url_buscar}`,
                type: "GET",
                data: { valor: depart },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#ciudad").html(data);
                },
            });
   
        }

</script>

<script>

        $('#ciudad').on('change', cambiaDistrito);

        function cambiaDistrito()
        { 
            var ciudad = $('#ciudad').val();
            
            var url_buscar = "{{ route('cambiaDistrito') }}";
            $.ajax({
                url: `${url_buscar}`,
                type: "GET",
                data: { valor: ciudad },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#distrito").html(data);
                },
            });
   
        }

</script>



