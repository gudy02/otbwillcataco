{!!Form::open(array('url'=>'administracion/usuario','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre" value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar Usuario</button>
        </span>
    </div>
</div>
{{Form::close()}}
