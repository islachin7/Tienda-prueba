<option value="" selected>Distrito:</option>
@forelse ($distritos as $distrito)
<option value="{{ $distrito->idDist }}">{{ $distrito->distrito }}</option>
@empty
                                        
@endforelse  