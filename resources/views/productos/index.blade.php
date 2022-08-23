@extends('layouts.layout', ['noFooter' => true])

@section('title', 'Producto')

@section('content')
    @include('partials.navbar-dashboard')
    <section class="page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-0">
                    <h1>Listado productos</h1>
                    <button class="btn btn-primary my-4" type="button" onclick="modal_producto()">Nuevo producto</button>
                    <x-alerta />
                </div>
                <hr>
                <table class="table table-striped table-bordered table-sm" id="tabla-productos">
                    <thead>
                        <tr>
                            <th scope="col" class="text-dark">#</th>
                            <th scope="col" class="text-dark">Nombre</th>
                            <th scope="col" class="text-dark">Precio</th>
                            <th scope="col" class="text-dark">Descripcion</th>
                            <th scope="col" class="text-dark">Imagen</th>
                            <th scope="col" class="text-dark">Editar</th>
                            <th scope="col" class="text-dark">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $index => $producto)
                            <tr>
                                <th class="text-dark align-middle text-center">{{ $index+1 }}</th>
                                <th class="text-dark align-middle text-center" >{{ $producto->nombre }}</th>
                                <td class="text-dark align-middle text-center">{{ $producto->precio }}</td>
                                <td class="text-dark align-middle text-center">{{ $producto->descripcion }}</td>
                                <td class="text-dark align-middle text-center">
                                    <img src="{{ url('/images/productos/' . $producto->imagen) }}"
                                        style="width:100px; height: 100px;" class="img-fluid" alt="img-producto"
                                        srcset="">
                                </td>
                                <td class="text-dark align-middle text-center">

                                    <button class="btn btn-lg btn-outline-warning" onclick="modal_producto({{ $producto->id_producto }})">
                                    <i style="font-size:large;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>

                                    
                                </td>
                                <td class="text-dark align-middle text-center">
                                    <form action="{{ route('producto.destroy', $producto->id_producto) }}" method="post">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button  type="submit" class="btn btn-lg btn-outline-danger" onclick="return confirm('Estas seguro de eliminar este producto')">
                                        <i style="font-size:large;" class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="6">Aun no existe ni un producto</th>
                            </tr>
                        @endforelse
                        <div class="row" style="width: 100% !important;">
                            <div class="col-md-8">
                                {{ $productos->links() }}
                            </div>
                            <div class="col-md-4">
                                <form class="form-inline my-4 my-lg-0 row" method="get" {{ route('producto.index') }} class="p-0 m-0 row" style="width: 100% !important;">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <input class="form-control" type="search" name="search" placeholder="Buscar producto" maxlength="10" aria-label="Search">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Filtrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>

    <!-- Modal -->
     <div class="modal" id="modal-producto" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-body-producto">
            </div>
        </div>
    </div> 

    <script>
        function modal_producto(id = null)
        {
            let url_editar = id == null 
                ? "{{ route('producto.create') }}"
                : "{{ route('producto.edit', ':id') }}".replace(":id", id);

            $.ajax({
                url: `${url_editar}`,
                type: "GET",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#modal-producto").modal("show");
                    $("#modal-body-producto").html(data);
                },
            });
        }
    </script>

@endsection
