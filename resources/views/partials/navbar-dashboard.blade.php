

<nav class="navbar navbar-expand-lg bg-secondary justify-content-center">
 


  <div class="justify-content-center text-center">

  <ul class="navbar-nav mr-auto justify-content-center">
  <li class="nav-item active">
       <a class="btn btn-primary" href="{{ route('feedback.index') }}">BANDEJA</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary" href="{{ route('producto.index') }}">PRODUCTOS</a>
    </li>

  <div class="dropdown">

<button style="margin-left:1px !important;" class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Hola: {{ Auth::user()->name }} <i class="fa fa-user"></i>
</button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-left:1px;">
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editar">Perfil</a>
        @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 2)
        <a class="dropdown-item" href="{{ route('mis_pedidos') }}" >Mis pedidos</a>
        @endif

        @can('dashboard')
        <a class="dropdown-item" href="{{ route('dashboard') }}">Panel</a> 
        @endcan
        <a class="dropdown-item" href="{{ route('logout') }}">Salir</a>
    </div>

</div>



  </ul>

  
 
  
  
  </div>

</nav>
