{!!Form::open(array('url'=>'administracion/multa','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombre multa" value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar Multa</button>
        </span>
    </div>
</div>
{{Form::close()}}
