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
          <input type="text" name="usuario" class="form-control"  value="{{Auth::user()->name.' '.Auth::user()->apellidoP}}" disabled>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
            <select class="form-control" name="tipoMulta" id="tipoMulta">
              @foreach ($tipoMulta as $tm)
                @if ($tm->idTipoMulta==$multa->idTipoMulta)
                  <option value="{{$tm->idTipoMulta}}" selected>{{$tm->nombre}}</option>
                @else
                  <option value="{{$tm->idTipoMulta}}">{{$tm->nombre}}</option>
                @endif

              @endforeach
            </select>
        </div>
        <div class="form-group" id="otraMulta">
          <label for="otraMulta">Nueva Multa</label>
          <input type="text" name="otraMulta" class="form-control" placeholder="Nueva multa" value="{{old('otraMulta')}}">
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
      <div class="col-xs-12">
        <button type="submit" name="button" class="btn btn-primary">Modificar</button>
        <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
      </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
