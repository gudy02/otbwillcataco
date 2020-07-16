@extends('layout.admin')
@section('contenido')
    <h3>Registro de Aporte</h3>
    {!!Form::open(array('url' =>'aporte/store' ,'method'=>'POST','autocomplete'=>'off','files'=>'false'))!!}
    {{Form::token()}}

    <div class="row">
        <div class="col-xs-12">
            <label for="socio">Socio</label>
            <select name="idSocio" id="" class="form-control selectpicker" data-live-search="true">
                <option value="seleccionar">Seleccionar un Socio</option>
                @foreach($socios as $soc)
                    <option value="{{$soc->idSocio}}">{{$soc->nombre.' '.$soc->apellidoP.' '.$soc->apellidoM}} / MEDIDOR: {{$soc->codigo}} </option>
                @endforeach
            </select>
        </div>

        <div class="col-xs-12">
            <div class="form-group{{ $errors->has('monto') ? ' has-error' : ''}}">
                <label for="monto">Monto</label>
                <input type="text" name="monto" class="form-control" placeholder="Monto de Ingreso" value="{{old('monto')}}">
                @if ($errors->has('monto'))
                    <span class="help-block">
                          <strong>{{ $errors->first('monto') }}</strong>
                      </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('fecha_cobro') ? ' has-error' : '' }}">
                <label for="fecha">Fecha Aporte</label>
                <input type="date" value="{{$fecha}}" name="fecha_cobro" class="form-control" placeholder="Fecha de Ingreso" >
                @if ($errors->has('fecha_cobro'))
                    <span class="help-block">
                          <strong>{{ $errors->first('fecha') }}</strong>
                      </span>
                @endif
            </div>

        </div>

    </div>




    <div class="col-xs-12">
        <button type="submit" class="btn btn-primary">Registrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </div>
    {{Form::Close()}}

@endsection
