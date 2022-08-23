<option value="">Seleccione</option>
@forelse ($departamentos as $departamento)
<option value="{{ $departamento->idDepa }}">{{ $departamento->departamento }}</option>
@empty
                                        
@endforelse                                       