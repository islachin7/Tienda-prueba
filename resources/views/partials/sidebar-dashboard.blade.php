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
    
    <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
            <h3>
                <a class="navbar-brand" href="#">
                <img class="img-fluid" style="width:220px;" src="{{ url('/images/nuevologo.png') }}" alt="logo">
            </a>
        </h3>
                <strong>PC</strong>
            </div>


            <ul class="list-unstyled components">
                <li>
                    <a href="#" id="raton2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="color:white;">
                        <i class="fas fa-user"></i>
                        Mi Perfil
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#" class="text-dark" data-toggle="modal" data-target="#editar">Editar</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"  class="text-dark">Salir</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('feedback.index') }}" style="color:white;">
                        <i class="fas fa-briefcase"></i>
                        BANDEJA
                    </a>
                </li>
                <li>
                    <a href="{{ route('producto.index') }}" style="color:white;">
                        <i class="fas fa-image"></i>
                        PRODUCTOS
                    </a>
                </li>  
            </ul>

        </nav>


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



        <script>

$('#raton2').on('click',function(){

   if($('#homeSubmenu').hasClass("show") == true){
    $('#homeSubmenu').removeClass("show");
   }else{
    $('#homeSubmenu').addClass("show");
   }


});
</script>