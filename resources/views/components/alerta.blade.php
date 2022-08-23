@foreach ($errors->all() as $error)
    <script>
        toastr.error('{{ $error }}','Notificación',
        {"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-center",
            "preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000",
            "extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn",
            "hideMethod": "fadeOut"});
    </script>

@endforeach


@if (session()->has('message'))
    <script>
        toastr.info('{{ session()->get('message') }}','Notificación',
        {"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-center",
            "preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000",
            "extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn",
            "hideMethod": "fadeOut"});
    </script>
@endif
