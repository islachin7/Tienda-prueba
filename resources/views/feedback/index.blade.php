@extends('layouts.layout', ['noFooter' => true])

@section('title', 'Reclamo')

@section('content')
    @include('partials.navbar-dashboard')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">



    <section class="page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 p-0">
                    <h1>Reclamos :</h1>
                    <x-alerta />
                    <table class="table table-striped table-bordered table-sm" id="tablita">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center text-dark">#</th>
                                <th scope="col" class="text-center text-dark">Fecha y Hora</th>
                                <th scope="col" class="text-center text-dark">Cliente</th>
                                <th scope="col" class="text-center text-dark">tienda</th>
                                <th scope="col" class="text-center text-dark">Reclamo</th>
                                <th scope="col" class="text-center text-dark">Estado</th>     
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
                                    <th scope="row" class="text-center align-middle"><select class="form-control" name="" id="">
                                        <option value="" selected>Abierto</option>
                                        <option value="">Resuelto</option>
                                        <option value="">Cerrado</option>
                                    </select></th>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Aun no existe ni un feedback</th>
                                </tr>
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
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
