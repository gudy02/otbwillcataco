@extends('layout.admin')
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Editar Multa</h3>
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::model($multa,['method'=>'PATCH','route'=>['administracion.multa.update',$multa->idMulta]])!!}
      {{Form::token()}}
      <div class="col-xs-6">
        <div class="form-group">
          <label for="multa">Nombre Multa:</label>
          <input type="text" name="multa" class="form-control" placeholder="Nombre de la multa" value="{{$multa->nombreMulta}}">
        </div>
        <div class="form-group">
          <label for="concepto">Concepto</label>
          <input type="text" name="concepto" class="form-control" placeholder="Motivo de la multa" value="{{$multa->concepto}}">
        </div>
        <div class="form-group">
          <label for="monto">monto <b>Bs</b></label>
        <input type="number" name="monto" class="form-control" placeholder="Monto de la multa" value="{{$multa->monto}}">
      </div>
        <div class="form-group">
          <label for="fecha">fecha Multa</label>
          <input type="date" name="fecha" class="form-control"  value="{{$multa->fechaMulta}}">
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
            <label for="tipoPago">Socio</label>
            <select name="socio" id="" class="form-control selectpicker" data-live-search="true">
            @foreach($socio as $soc)
                @if ($soc->idSocio==$multa->idSocio)
                  <option value="{{$soc->idSocio}}" selected>{{$soc->nombre.' '.$soc->apellidoP.' '.$soc->apellidoM}} / MEDIDOR: {{$soc->codigo}} </option>
                @else
                <option value="{{$soc->idSocio}}">{{$soc->nombre.' '.$soc->apellidoP.' '.$soc->apellidoM}} / MEDIDOR: {{$soc->codigo}} </option>
              @endif
            @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="usuario">Modificado por:</label>
          <input type="text" name="usuario" class="form-control"  value="1" disabled>
        </div>
      </div>
      <div class="col-xs-12">
        <button type="submit" name="button" class="btn btn-primary">Modificar</button>
        <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
      </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
