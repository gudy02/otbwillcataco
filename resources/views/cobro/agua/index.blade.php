@extends('layout.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3>Registro de Cobros</h3>
    @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
      {{Form::open(array('url' =>'cobros/lista' ,'method'=>'post' ))}}
      {{Form::token()}}
        <div class="col-xs-8">
        <label for="socio">Socio</label>
        <select name="socio" id="" class="form-control selectpicker" data-live-search="true">
        <option value="seleccionar">Seleccionar un Socio</option>
          @foreach($socio as $soc)
            <option value="{{$soc->idSocio}}">{{$soc->nombre.' '.$soc->apellidoP.' '.$soc->apellidoM}} / MEDIDOR: {{$soc->codigo}} </option>
        @endforeach
        </select>
      </div>
        <div class="col-xs-4">
          <input type="submit" style="margin-top:6%" value="Verificar Deudas" class="btn btn-primary">
          {{-- <a href="{{url('cobros/lista')}}/{{37}}" class="btn btn-primary">Verificar Deudas</a> --}}
        </div>
      {{Form::close()}}
  </div>
</div>
@endsection
