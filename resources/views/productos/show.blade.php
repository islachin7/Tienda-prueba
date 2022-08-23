@extends('layouts.layout')

@section('title', $producto->nombre)

@section('content')

<link rel="stylesheet" href="{{ asset('css/icons.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<style>
 .opciss{
text-transform: lowercase;

}
</style>



    <div class="wrapper">

        <input type="hidden" name="precio_producto" id="precio_producto" value="{{ $producto->precio }}">

        <!--=====Product Detail Section =====-->
        <section class="page-section-pt">
            <div class="container">
                <x-alerta />
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4 col-lg-4 row">
                    <div class="w-100"></div>
                            <div class="root">
                            <div class="gallery row text-center">
                                <div class="col-6 row">
                                    @forelse ($producto_detalle as $index => $detalle)
                                        <div class="col-12">
                                        <div class="gallery__item icon-expand">
                                            <img src="{{ url('/images/productos/'.$detalle->imagen) }}" alt="Imagen de galería" class="gallery__img">
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse

                                </div>
                                <div class="col-6">
                                <div class="gallery__item icon-expand">
                                    <img src="{{ url('/images/productos/' . $producto->imagen) }}" alt="Imagen de galería" class="gallery__img">
                                </div>
                            
                                </div>
                               
                                
                                <div class="gallery-lightbox">
                                    <div class="gallery-lightbox__modal">
                                        <span class="gallery-lightbox__control icon-close"></span>
                                        <span class="gallery-lightbox__control icon-back"></span>
                                        <span class="gallery-lightbox__control icon-next"></span>
                                        <img src="img/img-1.html" class="gallery-lightbox__img">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!--Product detail-->
                    <div class="col-12 col-sm-6 col-lg-5 col-lg-5">
                        <div class="product-list-view xs-mb-20">
                            <h4>
                                <a href="javascript:void(0)">
                                    Proveedor - {{ $producto->proveedor->name ?? '' }} {{  $producto->proveedor->apellido_paterno ?? '' }}
                                </a>
                            </h4>
                            <h5><a href="javascript:void(0)">Producto - {{ $producto->nombre }}</a></h5>
                            <!-- <div class="product-price"> <ins>S/. {{ number_format($producto->precio, 2) }}</ins></div> -->
                            <ul class="tag-list mt-2">
                                <li><a href="#">{{ $producto->subCategoria->nombre_subCategoria ?? '' }}</a></li>
                            </ul>
                            <p class="d-md-none d-lg-block text-justify">
                                {{ $producto['descripcion'] }}
                            </p>
                            <div class="w-100"></div>
                            @guest
                              <p class="text-danger">Inicie session para poder comprar el producto!</p>
                            @else
                                <div class="w-100"></div>
                                <form style="width: 100% !important;" class="mx-auto" action="{{ route('orden.store') }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        
                                        <input type="hidden" name="id_producto" id="id_producto" value="{{ $producto->id_producto }}">
                                        <input type="hidden" name="comision" id="comision" value="">

                                        <div class="col-6 col-md-6 col-lg-6 mt-3">
                                            <select class="form-control" name="SelectPeru">
                                                <option value="" >Pais:</option>
                                                <option value="Peru" selected>Perú</option>
                                                <option value="Argentina">Argentina</option>
                                            </select>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6 mt-3">
                                        <select id="dptoshop" class="form-control opciss" required="" >
                                                    <option value="">Departamento:</option>
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
                                                    <option value="15" selected>LIMA</option>
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
                                        <div class="col-6 col-md-6 col-lg-6 mt-3">
                                        <select class="form-control opciss" id="ciudadshop" required="">
                                            <option>Ciudad:</option>
                                        </select> 
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6 mt-3">
                                        <select class="form-control opciss" id="distritoshop" required="">
                                            <option>Distrito:</option>
                                        </select>
                                        </div>

                                        <div class="col-12 col-md-12 col-lg-12 mt-3">
                                        <input type="text" class="form-control" name="urbanizacion" placeholder="Urbanización:">
                                        </div>

                                        <div class="col-12 col-md-12 col-lg-12 mt-3">
                                        <textarea name="direccion" id="" rows="2" maxlength="40" class="form-control" placeholder="Dirección:"></textarea>
                                        </div>

                                        
                                        <div class="col-12 col-md-12 col-lg-12 mt-3">
                                            <input type="text" readonly="" name="cliente" value="Cliente: {{ Auth::user()->name }}" class="form-control">
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6 mt-3">
                                            <label for="fecha">Fecha de entrega</label>
                                            <input type="date" min="{{ date("Y-m-d") }}" value="{{ date("Y-m-d") }}" max="{{ date('Y-m-d', strtotime("+3 day")) }}" name="fecha_entrega" class="form-control">
                                        </div>

                                        <div class="col-3 col-md-3 col-lg-3 mt-3">
                                            <label for="hora_entrega">Hora</label>
                                            <select name="hora_entrega" id="hora_entrega" class="form-control text-sm">
                                                @for ($i = 0; $i <= 24; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 mt-3">
                                            <label for="minuto_entrega" id="minuto_entrega">Minuto</label>
                                            <select class="form-control p-1" name="minuto_entrega">
                                                <option value="00" >00</option>
                                                <option value="15">15</option>
                                                <option value="30" selected >30</option>
                                                <option value="45" >45</option>
                                            </select>
                                        </div>

                                        <div class="col-3 col-md-3 col-lg-3 mt-3">
                                            <label for="cantidad">Cantidad</label>
                                            <select name="cantidad" class="form-control" id="cantidad">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 mt-3">
                                            <label for="cantidad">Precio U.</label>
                                            <input type="text" readonly="" id="precio_producto" class="form-control" value="S/. {{ number_format($producto->precio, 2) }}">
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6 mt-3 text-center">
                                            <label for="cantidad">Sub Total:</label>
                                            <h3>S/. <span class="subto"></span></h3>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-12 mt-3">
                                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" maxlength="80" placeholder="Mensaje al proveedor:"></textarea>
                                        </div>
                                        <div class="col-7 col-md-7 col-lg-7 mt-3">
                                            <select class="form-control p-0" id="id_metodo_pago" name="id_metodo_pago">
                                                 <option value="">Método pago:</option>
                                                @forelse ($metodos_pago as $metodo)
                                                    <option value="{{ $metodo->id_maestro_detalle }}">{{ $metodo->valor }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-5 col-md-5 col-lg-5 mt-3">
                                            <button type="submit" class="btn btn-lg btn-success animated slideInRight" id="btn-comprar">COMPRAR</button>
                                        </div>
                                    </div>
                                </form>
                            @endguest
                        </div>
                    </div>
                    <!--product detail end-->

                   <!--checkout-->
                     <div class="col-12 col-sm-12 col-lg-3 col-lg-3">
                        <div class="main-block">
                          <div class="filter-title" style="border: none !important">
                            <h5 class="pb-0 mb-0">Detalle</h5>
                          </div>
                          <table class="table table-borderless mb-0">
                            <tbody>
                              <tr class="border-top border-theme">
                                <td class="pb-0"><h6 class="mb-0">Delivery</h6></td>
                                <td class="float-right pb-0">S/. 3.00</td>
                              </tr>
                              <tr class="border-top border-theme">
                                <td class="pb-0"><h6 class="mb-0">Sub Total</h6></td>
                                <td class="float-right pb-0">S/. <span class="subto"></span></td>
                              </tr>
                              <tr class="border-top border-theme">
                                <td class="pb-0"><h5 class="mb-0">Total</h5></td>
                                <td class="float-right pb-0">S/. <span id="total"></span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                     <!--checkout-->


                </div>
            </div>
        </section>
        <!--=====End Product detail Section =====-->   
        
    <script>
        
        let precio = $('#precio_producto').val();

        $( document ).ready(function(){
            $('#btn-comprar').prop("disabled", true)
            calcular_total();
        });


        $('#cantidad').on('change', calcular_total);

        function calcular_total()
        {
            let cantidad = $('#cantidad').val();
            let delivery = 3;
            let subtotal = cantidad*precio;
            let comision = Math.round((subtotal*5)/100);
            let total = subtotal + delivery;

            $('#comision').val(comision.toFixed(2));
            $('.subto').html(subtotal.toFixed(2));
            $('#total').html(total.toFixed(2));

            $('#btn-comprar').prop("disabled", false);
        }

    </script>

    
<script>

$('#dptoshop').on('change', cambiarCiudad25);

function cambiarCiudad25()
{

    $("#distritoshop").empty();
    $("#distritoshop").html('<option value="" selected>Distrito:</option>');

    var depart = $('#dptoshop').val();
    
    var url_buscar = "{{ route('cambiaCiudad') }}";
    $.ajax({
        url: `${url_buscar}`,
        type: "GET",
        data: { valor: depart },
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        dataType: "HTML",
        success: function (data) {
            $("#ciudadshop").html(data);
        },
    });

}

</script>

<script>

$('#ciudadshop').on('change', cambiaDistrito25);

function cambiaDistrito25()
{ 
    var ciudad = $('#ciudadshop').val();
    
    var url_buscar = "{{ route('cambiaDistrito') }}";
    $.ajax({
        url: `${url_buscar}`,
        type: "GET",
        data: { valor: ciudad },
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        dataType: "HTML",
        success: function (data) {
            $("#distritoshop").html(data);
        },
    });

}

</script>

<script src="{{ asset('js/app.js') }}"></script>


@endsection
