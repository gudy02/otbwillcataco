@extends('layout.admin')
@section('scripts')
  <script>
    $(document).ready(function(){
      $('#otraMulta').hide();
      $('select#tipoMulta').on('change',function(){
        var tipoPago=$(this).val();
        if (tipoPago=='otro') {
          $('#otraMulta').show(1000);
        } else {
          $('#otraMulta').hide(1000);

        }
      });
    });
  </script>
@endsection
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Registro de Multa</h3>

      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::open(array('url' =>'administracion/multa' ,'method'=>'POST','autocomplete'=>'off'))!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
                <label for="tipoPago">Socio</label>
                <select name="socio" id="" class="form-control selectpicker" data-live-search="true">
                   <option value="SeleccioneSocio">Seleccione Socio</option>
                @foreach($socio as $soc)
                    <option value="{{$soc->idSocio}}">{{$soc->nombre.' '.$soc->apellidoP.' '.$soc->apellidoM}} / MEDIDOR: {{$soc->codigo}} </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
              <label for="usuario">Registrado por:</label>
              <input type="text" name="usuario" class="form-control"  value="{{Auth::user()->name.' '.Auth::user()->apellidoP}}" disabled>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="multa">Multa por:</label>
              <select class="form-control" name="multa" id="tipoMulta">
                @foreach($tipoMulta as $tm)
                    <option value="{{$tm->idTipoMulta}}">{{$tm->nombre}}</option>
                @endforeach
                <option value="otro">Otro...</option>
              </select>
              <div class="form-group" id="otraMulta">
                <label for="otraMulta">Nueva Multa</label>
                <input type="text" name="otraMulta" class="form-control" placeholder="Nueva multa" value="{{old('otraMulta')}}">
              </div>

            </div>
            <div class="form-group">
              <label for="concepto">Descripcion</label>
              <input type="text" name="concepto" class="form-control" placeholder="Motivo de la multa" value="{{old('concepto')}}">
            </div>
            <div class="form-group">
              <label for="monto">Monto <b>Bs</b></label>
              <input type="number" name="monto" class="form-control" placeholder="Monto de la multa" value="{{old('monto')}}">
            </div>
            <div class="form-group">
              <label for="fecha">Fecha Multa</label>
              <input type="date" name="fecha" class="form-control"  value="{{$fecha}}">
            </div>
          </div>
          <div class="col-xs-12">
            <button type="submit" name="button" class="btn btn-primary">Registrar</button>
            <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
          </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
