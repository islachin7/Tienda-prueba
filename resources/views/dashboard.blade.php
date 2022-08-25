@extends('layouts.layout', ['noFooter' => true])

@section('title', 'Dashboard')

@section('footer')
@endsection

@section('content')
    @include('partials.navbar-dashboard')
    <section class="page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <x-alerta />
                </div>
            </div>
        </div>
    </section>
@endsection
