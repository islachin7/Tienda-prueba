<option value="" selected>Ciudad:</option>
@forelse ($ciudades as $ciudad)
<option value="{{ $ciudad->idCiu }}">{{ $ciudad->ciudad }}</option>
@empty
                                        
@endforelse  