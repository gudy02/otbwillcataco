@extends('layout.admin')
@section('contenido')
    <h3>Registro de Ingreso</h3>
    {!!Form::open(array('url' =>'movimiento/store' ,'method'=>'POST','autocomplete'=>'off','files'=>'false'))!!}
    {{Form::token()}}
        <div class="col-xs-6">

            <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                <label >Tipo de Ingreso</label>
                <select class="form-control" name="tipo_id" id="tipo_id">
                    @foreach($tipo_ingreso as $tm)
                        <option value="{{$tm->id}}">{{$tm->nombre}}</option>
                    @endforeach
                    <option value="otro">Otro...</option>
                </select>
            </div>

            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label"></label>
                <input type="text" class="form-control" placeholder="descripcion del ingreso" name="descripcion" value="{{ old('descripcio') }}">
                @if ($errors->has('descripcion'))
                    <span class="help-block">
                          <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('monto') ? ' has-error' : ''}}">
                <label for="monto">Monto</label>
                <input type="text" name="monto" class="form-control" placeholder="Monto de Ingreso" value="{{old('monto')}}">
                @if ($errors->has('monto'))
                    <span class="help-block">
                          <strong>{{ $errors->first('monto') }}</strong>
                      </span>
                @endif
            </div>


            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label for="fecha">Fecha de Ingreso</label>
                <input type="date" value="{{$fecha}}" name="fecha" class="form-control" placeholder="Fecha de Ingreso" >
                @if ($errors->has('fecha'))
                    <span class="help-block">
                          <strong>{{ $errors->first('fecha') }}</strong>
                      </span>
                @endif
            </div>




        </div>
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    {{Form::Close()}}

@endsection
