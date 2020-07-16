{!!Form::open(array('url'=>'administracion/socio','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre, apellido y carnet de Identidad" value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar Socio</button>
        </span>
    </div>
</div>
{{Form::close()}}
