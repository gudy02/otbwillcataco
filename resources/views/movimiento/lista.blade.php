@extends('layout.admin')
@section('contenido')
    <h3>Reporte de Movimiento Economico</h3>
    {!!Form::open(array('url' =>'movimiento/generate_lista_movimiento' ,'method'=>'POST','autocomplete'=>'off','files'=>'false'))!!}
    {{Form::token()}}
        <div class="col-xs-6">

            <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                <label >Tipo Movimiento</label>
                <select class="form-control" name="tipo_movimiento">
                    <option value="0">Egreso</option>
                    <option value="1">Ingreso</option>
                </select>
            </div>

            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label for="fecha">Fecha de Inicio</label>
                <input type="date" name="fecha_start" class="form-control" >
                @if ($errors->has('fecha'))
                    <span class="help-block">
                          <strong>{{ $errors->first('fecha') }}</strong>
                      </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label for="fecha">Fecha de Fin</label>
                <input type="date" name="fecha_end" class="form-control" >
                @if ($errors->has('fecha'))
                    <span class="help-block">
                          <strong>{{ $errors->first('fecha') }}</strong>
                      </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                <label >Categoria del Movimiento</label>
                <select class="form-control" name="tipo_id" id="tipo_id">
                    @foreach($tipo_movimiento as $tm)
                        <option value="{{$tm->id}}">{{$tm->nombre}}</option>
                    @endforeach
                    <option value="otro">Todos</option>
                </select>
            </div>

        </div>
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary">Generar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    {{Form::Close()}}

@endsection
