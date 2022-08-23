@forelse ($productos as $index => $producto)
                                <div class="col-lg-3 margin-bottom-1x mb-2" >
                                    <div class="card text-center">
                                    <div class="card-body" style="height:230px;">
                                        <a href="{{ route('producto.show', $producto['nombre']) }}">
                                            <img class="img-fluid" src="{{ url('/images/productos/' . $producto['imagen']) }}" alt="img" style="height: 250px; width: 250px;">
                                        </a>                                        
                                    </div>
                                    <div class="card-body d-block mt-2" style="height:120px;">
                                        <h4 class="card-title">{{ $producto['nombre'] }}</h4>
                                        <div class="product-rating"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i> <i class="far fa-star"></i></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                         <h3 class="card-title">S/. {{ number_format($producto->precio, 2) }}</h3>
                                        </div>
                                        <div class="col-6">
                                        <a class="btn btn-success btn-sm mb-2" href="{{ route('producto.show', $producto['nombre']) }}">Comprar</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @empty
                                    <p class="text-danger font-weight-bold ml-3">Aun no hay productos disponibles !</p>
                                @endforelse
                                <div class="w-100"></div>
                                {{ $productos->links() }}	