@extends('layouts.layout', ['noFooter' => true])

@section('title', 'Pedidos')

@php
    function formatear_total($pedido)
    {
        if( !isset($pedido->detalle->cantidad) && !isset($pedido->detalle->producto->precio) ){
            return 0;
        }
        return number_format(($pedido->detalle->cantidad * $pedido->detalle->producto->precio), 2);
    }
@endphp

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
                <h1>Pedidos :</h1>
                    <x-alerta />
                    <table class="table table-responsive table-bordered" style="border-radius:20px;" id="tablas">
                    <thead class="bg-dark">
                       <tr>
                        <th class="text-light" width="200">Foto</th>
                        <th class="text-light" width="200">Nombre</th>
                        <th class="text-light">Total</th>
                        <th class="text-light" width="200">Fecha Compra</th>
                        <th class="text-light">Metodo Pago</th>
                        <th class="text-light">Proveedor</th>
                        <th class="text-light">Mensaje Proveedor</th>
                        <th class="text-light">Estado</th>
                        <th class="text-light">Reclamo</th>
                       </tr>
                    </thead>
                    <tbody>
                     @forelse ($pedidos as $pedido)
                       <tr>
                         <td class="thumbnail">
                            <img class="img-fluid rounded"src="{{ url('/images/productos/'.$pedido->detalle->producto->imagen) ?? '' }}" alt="" style="height: 70px; width: 70px" />
                          </td>
                          <td class="text-dark">{{ $pedido->detalle->producto->nombre ?? '' }}</td>
                          <td class="text-dark">S/ {{  formatear_total($pedido) }}</td>
                          <td class="text-success">{{ Carbon\Carbon::parse($pedido->fecha_compra)->format('d/m/Y') }}</td>
                          <td class="text-dark">{{ $pedido->detalle->metodo_pago->valor ?? '' }}</td>
                          <td class="text-dark">{{ $pedido->detalle->producto->proveedor->name ?? '' }}</td>
                          <td class="text-dark">{{ $pedido->mensaje_proveedor }}</td>
                          <td class="text-dark text-weight-bold">{{ config('helpers.estado_orden')[$pedido->estado] }}</td>
                          <td class="remove-product text-dark">
                              <button class="btn btn-danger" onclick="modal_feedback({{ $pedido->id_orden }})">Reclamo <i class="fa fa-exclamation-circle ml-2" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                       @empty
                       @endforelse
                         {{ $pedidos->links() }}
                       </tbody>                        
                    </table>   
                </div>
            </div>
        </div>
    </section>


     <!-- Modal -->
        <div class="modal" id="modal-reclamo" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-body-reclamo">
            </div>
        </div>
    </div> 

    <script>
        function modal_feedback(orden_id)
        {
            let url_editar = "{{ route('feedback.edit', ':id') }}".replace(":id", orden_id);
            $.ajax({
                url: `${url_editar}`,
                type: "GET",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                dataType: "HTML",
                success: function (data) {
                    $("#modal-reclamo").modal("show");
                    $("#modal-body-reclamo").html(data);
                },
            });
        }
    </script>

    
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablas').DataTable({
                //para cambiar el lenguaje a español
                    "language": {
                    "lengthMenu": "Mostrar _MENU_",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "",
                    "infoEmpty": "",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
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

