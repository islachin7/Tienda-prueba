 <!--item-->
 @forelse ($productos as $index => $producto)
                                <div class="col-lg-2 col-6" style="padding:2px;">
						<div class="card productblock product-list-wrap product-list" >
							<div class="Content">
								<a href="{{ route('producto.show', $producto['nombre']) }}">
								<img class="img-fluid" src="{{ url('/images/productos/' . $producto['imagen']) }}" alt="">		
								</a>
								 <!-- <span class="new">NEW</span>-->

								<div class="product-title" style="height:50px"><a href="#">{{ $producto['nombre'] }}</a></div>
                                <hr>
								<div class="row" style="display: flex; align-items: center;">
                                        <div class="col-lg-6">
                                         <h6>S/. {{ number_format($producto->precio, 2) }}</h6>
                                        </div>
                                        <div class="col-lg-6">
                                        <a class="btn btn-success btn-sm mb-2" href="{{ route('producto.show', $producto['nombre']) }}">Comprar</a>
                                        </div>
                                </div>
							</div>
						</div>
					</div>
                                @empty
                                    <p class="text-danger font-weight-bold ml-3">Aun no hay productos disponibles !</p>
                                @endforelse
                                <div class="w-100"></div>
                                {{ $productos->links() }}