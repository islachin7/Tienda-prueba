@extends('layouts.layout', ['noFooter' => true])

@section('title', 'Producto')

@section('content')
    @include('partials.navbar-proveedor')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">

<style>
.login-form form input, .login-form form textarea {
    width: 100%;
    border-radius: 30px;
    padding: 15px;
    color: #000;
}

.form-control {
    border: none;
    background-color: #f2f2f2;
}

.form-control {
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

.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}


.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}

.theme-button {
    padding: 10px 25px;
    border-radius: 25px;
    background-color: #00c0e9;
    color: #fff;
    text-transform: uppercase;
    display: inline-block;
    z-index: 100;
}
.btn {
    font-size: 14px;
}
.btn {
    font-weight: 600 !important;
}
a, .btn {
    -webkit-transition: all 0.3s ease-out 0s;
    -moz-transition: all 0.3s ease-out 0s;
    -ms-transition: all 0.3s ease-out 0s;
    -o-transition: all 0.3s ease-out 0s;
    transition: all 0.3s ease-out 0s;
    font-family: 'Montserrat', sans-serif;
}
.slideInRight {
    -webkit-animation-name: slideInRight;
    animation-name: slideInRight;
}
.animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-sm, .btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
</style>


    <section class="page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Productos :</h1>
                    <button class="btn btn-primary my-4" type="button" onclick="modal_producto()">Nuevo producto</button>
                    <x-alerta />
                    <table class="table table-responsive table-bordered" style="border-radius:20px;" id="tabla-productos">
                    <thead class="bg-dark">
                        <tr>
                            <th scope="col" class="text-light text-center">#</th>
                            <th scope="col" class="text-light text-center" width="200">Nombre</th>
                            <th scope="col" class="text-light text-center" width="200">Precio</th>
                            <th scope="col" class="text-light text-center" width="200">Descripcion</th>
                            <th scope="col" class="text-light text-center" width="500">Imagen</th>
                            <th scope="col" class="text-light text-center" width="100">Editar</th>
                            <th scope="col" class="text-light text-center" width="100">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $index => $producto)
                            <tr>
                                <th class="text-dark align-middle text-center">{{ $index+1 }}</th>
                                <th class="text-dark align-middle text-center" >{{ $producto->nombre }}</th>
                                <td class="text-dark align-middle text-center">{{ $producto->precio }}</td>
                                <td class="text-dark align-middle text-center">{{ $producto->descripcion }}</td>
                                <td class="text-dark align-middle text-center" width="600">
                                    <img src="{{ url('/images/productos/' . $producto->imagen) }}"
                                        style="width:100px; height: 100px;" class="img-fluid" alt="img-producto"
                                        srcset="">
                                </td>
                                <td class="text-dark align-middle text-center">
                                    <button class="btn btn-lg btn-warning" onclick="modal_producto({{ $producto->id_producto }})">
                                    <i style="font-size:large;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                                <td class="text-dark align-middle text-center">
                                    <form action="{{ route('producto.destroy', $producto->id_producto) }}" method="post">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button  type="submit" class="btn btn-lg btn-danger" onclick="return confirm('Estas seguro de eliminar este producto')">
                                        <i style="font-size:large;" class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                        <!--
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
                        -->
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

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tabla-productos').DataTable({
                //para cambiar el lenguaje a español
                    "language": {
                    "lengthMenu": "Mostrar _MENU_ ",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":">>",
                        "sPrevious": "<<"
                    },
                    "sProcessing":"Procesando...",
                    }
            });
        });
    </script>

@endsection
