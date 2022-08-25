<div class="container mt-2 mb-2 text-center">
<a class="btn btn-sm btn-primary" href="{{ route('proveedor') }}">Pedidos</a>
<a class="btn btn-sm btn-primary" href="{{ route('productosProveedor') }}">Productos</a>
<button style="margin-left:1px !important;" class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Hola: {{ Auth::user()->name }} <i class="fa fa-user"></i>
</button>
   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-left:1px;">
       <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editar">Perfil</a>
       @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 2)
       <a class="dropdown-item" href="{{ route('mis_pedidos') }}" >Mis pedidos</a>
       @endif
       <a class="dropdown-item" href="{{ route('logout') }}">Salir</a>
   </div>
</div>