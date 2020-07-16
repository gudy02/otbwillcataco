@extends('layout.admin')
@section('scripts')
<script >

  $(document).ready(function(){
    $('#lecturaActual').keyup(function(){
      var value=$(this).val();
      $('#cantidadConsumo').val(value-($('#lecturaAnterior').val()));
      var totalPagar=$('#cantidadConsumo').val()*2;
      if (totalPagar<10) {
        $('#totalPagar').val(10);
      }
      else{

        $('#totalPagar').val(totalPagar);
      }
    });
  });
   $('.habilitar').on('click',function(){
      $('input[name="cantidadConsumo"]').attr('readonly',false);
      $('input[name="totalPagar"]').attr('readonly',false);
      $('input[name="lecturaAnterior"]').attr('readonly',false);
  });

</script>
@endsection
@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3>Nueva Lectura del Socio: <b> {{$socio->nombre.' '.$socio->apellidoP.' '.$socio->apellidoM}} </b> con el Medidor: <b> {{$medidor->codigo}} </b></h3>
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::open(array('url' =>'administracion/lectura' ,'method'=>'POST','autocomplete'=>'off'))!!}
      {{Form::token()}}
          <div class="col-xs-6">
            <div class="form-group">
              <label for="lecturaAnterior">Lectura Anterior</label>
              <input type="text" name="lecturaAnterior" id="lecturaAnterior" class="form-control"  value="{{$lectura->lecturaActual}}" readonly>
            </div>
            <div class="form-group">
              <label for="lecturaActual">Lectura Actual</label>
              <input type="text"  name="lecturaActual" class="form-control" placeholder="Lectura de este mes" id="lecturaActual" value="{{old('lecturaActual')}}">
            </div>
            <div class="form-group">
              <label for="mes">Mes</label>
              <input type="text" name="mes" class="form-control" readonly  value="{{$mess}}">
            </div>
            <div class="form-group" style="display:none">
              <label for="medidor">idMedidor</label>
              <input type="text" name="medidor" class="form-control"  readonly  value="{{$medidor->idMedidor}}">
            </div>
            <div class="form-group">
              <label for="fechaLectura">Fecha Lectura</label>
            <input type="date" name="fechaLectura" class="form-control"  value="{{$fecha}}">
            </div>
            <div class="form-group">
              <label for="fechaRegistro">Fecha Registro</label>
            <input type="text" name="fechaRegistro" class="form-control"  value="{{$fecha}}" readonly>
            </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label for="cantidadConsumo">Cantida de Consumo</label>
                <input type="text"  name="cantidadConsumo" class="form-control" id="cantidadConsumo" readonly  value="{{old('cantidadConsumo')}}">
              </div>
              <div class="form-group">
                <label for="totalPagar">Total a pagar Bs.-</label>
                <input type="text" name="totalPagar" id="totalPagar" class="form-control" readonly  value="{{old('cantidadConsumo')}}">
              </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="mesa" id="" value="checkedValue" >
                    Mesa Directiva
                  </label>
                </div>
            <div class="form-group">
              <label for="usuario">Registrado por:</label>
              <input type="text" name="usuario" class="form-control"  value="{{Auth::user()->name.' '.Auth::user()->apellidoP}}" readonly>
            </div>

            </div>
          <div class="col-xs-12">
            <button type="submit" name="button" class="btn btn-primary">Registrar</button>
            <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
            <button type="button" name="button" class="btn btn-success habilitar" style="float: right;">Habilitar Campos</button>
          </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection


