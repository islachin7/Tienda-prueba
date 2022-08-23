                <div class="row">
                        <div class="col-lg-12 text-center title-line">
                            <h2 class="slick-title">Manco</h2>
                        </div>
                        <div class="login-form">
                            <form method="post" action="{{ route('post-update') }}" autocomplete="off">
                                @csrf
                                <div class="row">
                                <div class="col-lg-6 text-center">
                                  <div class="form-group">
                                  <img id="preview"  height="200" width="180">
                                  <span class="btn btn-primary btn-file mt-3">
                                    Subir Imagen <input type="file" id="foto" name="foto">
                                  </span>
                                  </div>
                                </div>
                                <div class="col-lg-6 row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" value=" {{ isset($usuario->name) ? $usuario->name : '' }}" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="apellido_paterno" value="{{ isset($usuario->apellido_paterno) ? $usuario->apellido_paterno : '' }}" placeholder="Apellido Paterno">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="DNI">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="apellido_paterno"  placeholder="Celular">
                                        </div>
                                    </div>
                                </div>
   
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control" name="pais">
                                                <option value="PER" selected>Perú</option>
                                                <option value="ARG">Argentina</option>
                                            </select>
                                        </div>                                   
                                    </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select name="dpto" onclick="cambiandoUbigeo()" onchange="cambiandoUbigeo()" class="form-control" required="">
                                                    <option value="">Seleccione</option>
                                                    <option value="Lima" selected>Lima</option>
                                                    <option value="Amazonas">Amazonas</option>
                                                    <option value="Ancash">Ancash</option>
                                                    <option value="Apurímac">Apurímac</option>
                                                    <option value="Arequipa">Arequipa</option>
                                                    <option value="Ayacucho">Ayacucho</option>
                                                    <option value="Cajamarca">Cajamarca</option>
                                                    <option value="Callao">Callao</option>
                                                    <option value="Cuzco">Cuzco </option>
                                                    <option value="Huancavelica">Huancavelica</option>
                                                    <option value="Huánuco">Huánuco</option>
                                                    <option value="Ica">Ica</option>
                                                    <option value="Junín">Junín</option>
                                                    <option value="La_Libertad">La Libertad</option>
                                                    <option value="Lambayeque">Lambayeque</option>
                                                    <option value="Loreto">Loreto</option>
                                                    <option value="Madre_de_Dios">Madre de Dios</option>
                                                    <option value="Moquegua">Moquegua</option>
                                                    <option value="Pasco">Pasco</option>
                                                    <option value="Piura">Piura</option>
                                                    <option value="Puno">Puno</option>
                                                    <option value="San_Martín">San Martín</option>
                                                    <option value="Tacna">Tacna</option>
                                                    <option value="Tumbes">Tumbes</option>
                                                    <option value="Ucayali">Ucayali</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div class="form-group">
                                        <select class="form-control" name="selectProvincia" onchange="cambiaDistrito()" required="">
                                            <option>Seleccione la Ciudad</option>
                                        </select> 
                                        </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div class="form-group">
                                        <select class="form-control" name="selectDistrito" required=""><option>Seleccione el Distrito</option>
                                        </select>
                                        </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="urbanizacion" placeholder="Urbanización">
                                        </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="form-group">
                                        <textarea name="direccion" id="" rows="2" maxlength="40" class="form-control" placeholder="Dirección"></textarea>
                                        </div>
                                        </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" maxlength="30" value="{{ isset($usuario()->email) ? Auth::user()->email : '' }}" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn theme-button  animated slideInRight">ACtualizar</button>
                                </div>
                                
                            </form>
                        </div>
                </div>