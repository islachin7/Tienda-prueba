@extends('layouts.layout', ['noFooter' => true])

@section('title', 'Reclamo')

@section('content')

    @include('partials.navbar-dashboard')

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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">

<section class="page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h1>Reclamos :</h1>
                    <x-alerta />
                    <table class="table table-responsive table-bordered" style="border-radius:20px;" id="tablita">
                        <thead class="bg-dark">
                            <tr>
                                <th scope="col" class="text-center text-light">#</th>
                                <th scope="col" class="text-center text-light" width="200">Fecha y Hora</th>
                                <th scope="col" class="text-center text-light" width="200">Cliente</th>
                                <th scope="col" class="text-center text-light" width="200">tienda</th>
                                <th scope="col" class="text-center text-light" width="500">Reclamo</th>
                                <th scope="col" class="text-center text-light">Estado</th>     
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($feedbacks as $index => $feedback)
                                <tr>
                                    <th scope="row" class="text-center text-dark align-middle">{{ $index + 1 }}</th>
                                    <td class="text-center text-dark align-middle">
                                        {{ Carbon\Carbon::parse($feedback->fecha_creacion)->format('d/m/Y 00:00') }}
                                    </td>
                                    <th scope="row" class="text-center text-dark align-middle">Mario</th>
                                    <th scope="row" class="text-center text-dark align-middle">Rosatel</th>
                                    <td class="text-center text-dark align-middle">{{ $feedback->comentario }}</td>
                                    <th scope="row" class="text-center align-middle">Abierto</th>
                                </tr>
                            @empty
                            @endforelse
                            {{ $feedbacks->links() }}
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </section>


    
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablita').DataTable({
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
