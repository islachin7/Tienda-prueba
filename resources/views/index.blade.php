@extends('layouts.layout')

@section('title', Config::get('app.name'))

@section('content')


<style>
    #nombre::placeholder { color: #545E62 !important; font-weight: normal !important}
    .expanded>a{color:orange;}

.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 100%;
  left: 0%;
  margin-top: -1px;
}

.letras { height: 100vh; }

.form-controlito {
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

}


</style>


    <div class="wrapper">
        <section class="page-section-pt" style="background-color:#f5f5f5;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <x-alerta />
                    </div>
                    <div class="w-100"></div>

                    <div class="col-lg-1 col-md-1 col-sm-1"></div>                     

                        <!--Product Right-->
                        <div class="col-lg-10 col-md-10">
                            <div class="product-widget mb-3 text-center">
                                <div class="row">

                                    <div class="col-lg-3 mb-2">

                                    <div class="dropdown ">
                                        <button class="btn btn-info form-control dropdown-toggle"  style="background-color:#17a2b8;" type="button" data-toggle="dropdown">Todas las Categorias
                                        </button>
                                        <ul class="dropdown-menu">
                                        @forelse ($categorias as $categoria)
                                        <!-- <li><a class="dropdown-item" tabindex="-1" href="#">HTML</a></li> -->
                                        <li class="dropdown-submenu">
                                            <a class="test dropdown-toggle dropdown-item"  tabindex="-1" href="#">{{ $categoria->nombre_categoria }}</a>
                                            <ul class="dropdown-menu">
                                                @forelse($subcategorias as $subcategoria)
                                                    @if($categoria->id_categoria == $subcategoria->id_categoria)
                                                        <li><a class="dropdown-item buscarCategoria" valor="{{ $subcategoria->id_subCategoria }}" tabindex="-1" href="#">{{ $subcategoria->nombre_subCategoria }}</a></li>
                                                    @endif
                                                    @empty
                                                    <li class="dropdown-item">Sin Categorias</li>
                                                @endforelse
                                                
                                            </ul>
                                        </li>
                                        @empty
                                        <li class="dropdown-item">Sin Categorias</li>
                                        @endforelse

                                        </ul>
                                    </div>

                                    </div>

                                    
                                    <div class="col-lg-6 mb-2 text-center">
                                        <input class="form-control" type="text" name="nombre" id="nombreProducto" style="color: black !important;border: 1px solid grey;" placeholder="Buscar Producto" value="{{ request()->input('nombre') }}">
                                    </div>

                                    <div class="col-lg-3 mb-2">
                                        <select name="precio" class="custom-select" id="precio">
                                            <option value="">Ordenar por</option>
                                            <option value="ofer" selected>Ofertas</option>
                                            <option value="asc" {{ request()->input('precio') == 'asc' ? 'selected' : ''}}>Precio bajo - alto</option>
                                            <option value="desc" {{ request()->input('precio') == 'desc' ? 'selected' : ''}}>Price alto - bajo</option>
                                            
                                        </select>
                                    </div>

                                    
                                    <div class="col-lg-4 mb-2"></div>
                                    <div class="col-lg-4 mb-2"></div>

                                    <div class="col-lg-4 mb-2 text-right">
                                        <a href="#" id="todasCate" hidden="" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Quitar Filtro</a>
                                    </div>
                                    

                                </div>
                            </div>

                            <div class="row justify-content-center" id="lista">
                                <!--item-->
                                @forelse ($productos as $index => $producto)
                                <div class="col-lg-2 col-6" style="padding:2px;">
						<div class="card productblock product-list-wrap product-list" >
							<div class="Content">
								<a href="{{ route('producto.show', $producto['id_producto']) }}">
								<img class="img-fluid" src="{{ url('/images/productos/' . $producto['imagen']) }}" alt="">		
								</a>
                                @if($producto['oferta']==1)
                                <span class="new"><small>OFERTA</small></span>
                                @endif
                                 
								<div class="product-title" style="height:50px"><a href="#">{{ $producto['nombre'] }}</a></div>
                                <hr>
								<div class="row" style="display: flex; align-items: center;">
                                        <div class="col-lg-6">
                                         <h6>S/. {{ number_format($producto->precio, 2) }}</h6>
                                        </div>
                                        <div class="col-lg-6">
                                        @guest
                                        <a class="btn btn-success btn-sm mb-2" href="#" data-toggle="modal" data-target="#login" >Comprar</a>
                                        @else
                                        <a class="btn btn-success btn-sm mb-2" href="{{ route('producto.show', $producto['id_producto']) }}">Comprar</a>
                                        @endguest
                                        </div>
                                </div>
							</div>
						</div>
					</div>
                                @empty
                                    <p class="text-danger font-weight-bold ml-3">Aun no hay productos disponibles !</p>
                                @endforelse
                                <div class="w-100"></div>
                                {{ $productos->links() }}
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1"> </div>
                </div>
            </div>
        </section>
    </div>


    <script>

        $('#nombreProducto').on('keyup', buscarNombre);

        function buscarNombre()
        { 
            var producto = $('#nombreProducto').val();
            var url_buscar = "{{ route('filtroNombre') }}";
            $.ajax({
                url: `${url_buscar}`,
                type: "GET",
                data: { nombre: producto },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#lista").html(data);
                },
            });
   
        }


        $('#precio').on('change', ordenarPrecio);

        function ordenarPrecio()
        { 
            var precioProducto = $('#precio').val();
            var url_buscar = "{{ route('filtroPrecio') }}";
            $.ajax({
                url: `${url_buscar}`,
                type: "GET",
                data: { precio: precioProducto },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#lista").html(data);
                },
            });
   
        }

        

        $('.buscarCategoria').on('click', buscarCategory);

        function buscarCategory()
        { 
            $('#todasCate').attr('hidden',false);
            var category = "";
            category = $(this).attr('valor');
            var url_buscar = "{{ route('filtroCategoria') }}";

            $.ajax({
                url: `${url_buscar}`,
                type: "GET",
                data: { categoria: category },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#lista").html(data);
                },
            });
   
        }

        

        $('#todasCate').on('click', quitarFiltroCategoria);

        function quitarFiltroCategoria()
        { 
            $('#todasCate').attr('hidden',true);
            var url_buscar = "{{ route('filtroCategoria') }}";

            $.ajax({
                url: `${url_buscar}`,
                type: "GET",
                data: { categoria: "" },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#lista").html(data);
                },
            });
   
        }

        


        $(document).ready(function(){
        //hides all subnav lists
            $('.infobox.lightbox.inlinks ul > li > ul').hide(); 
            $('.infobox.lightbox.inlinks ul > li').click(function(e){
                    if($(this).children('ul').length>0){
                        e.preventDefault();
                        if($(this).children('ul').is(':visible')){
                        $(this).find('ul').slideUp(),
                        $(this).removeClass("expanded");
                        }else{
                        $(this).find('ul').slideDown(),
                        $(this).addClass("expanded"); 
                        }
                    }
            });
        });
 

    </script>


<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>    



@endsection
