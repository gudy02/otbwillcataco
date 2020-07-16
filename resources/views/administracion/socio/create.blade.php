@extends('layout.admin')

@section('scripts')
  <script>

    $(document).ready(function(){  

    var valorOriginal=$('#medidor').val();  
      $('#proximoPago').hide();
      $('#accion').val('3500');
      $('#accion').prop('readonly');
      $('select#tipoMoneda').on('change',function(){
        var tipoMoneda=$(this).val();
        if (tipoMoneda==3) {
          $('#moneda').text('Bs.-');
        } else {
          $('#moneda').text('$.-');
        }
      });


      $('select#tipoPago').on('change',function(){
        var tipoPago=$(this).val();
        if (tipoPago==3) {
          $('#proximoPago').hide(1000);
          $('#accion').val('3500');
          $('#accion').prop('readonly',false);
          

        }
         else {
          $('#proximoPago').show(1000);
          $('#accion').val('');
          $('#accion').prop('readonly',false);

        }
      });
      $('#accion').on('keyup',function(){
        var value = $(this).val();
        if(value>=3500){
          $(this).val(3500);
          $('select#tipoPago').val(3);
          $('#proximoPago').hide(1000);
          $(this).prop('readonly',false);
        }
        else{
          $('select#tipoPago').val(4);
          $('#proximoPago').show(1000);
          $(this).prop('readonly',false);
        }
      });
      
      function codigoMedidor(n,ap,am){
        $valor=valorOriginal;
        $valor+=`${n.charAt(0).toUpperCase()}${ap.charAt(0).toUpperCase()}${am.charAt(0).toUpperCase()}`;
        $('#medidor').val($valor);
      }

      $('#nombre').on('keyup',function(){
        if ($(this).val()!="" && $('#ap').val()!="" && $('#am').val()!="") {
          codigoMedidor($(this).val(),$('#ap').val(),$('#am').val());
        }
        else{
          $('#medidor').val(valorOriginal);
        }
      })
      $('#am').on('keyup',function(){
        if ($(this).val()!="" && $('#ap').val()!="" && $('#nombre').val()!="") {
          codigoMedidor($('#nombre').val(),$('#ap').val(),$('#am').val());
        }
         else{
          $('#medidor').val(valorOriginal);
        }
      })
      $('#ap').on('keyup',function(){
        if ($(this).val()!="" && $('#nombre').val()!="" && $('#am').val()!="") {
          codigoMedidor($('#nombre').val(),$('#ap').val(),$('#am').val());
        }
         else{
          $('#medidor').val(valorOriginal);
        }
      })
    });

  </script>
  <script>
    var statSend = false;
      function checkSubmit() {
          if (!statSend) {
              statSend = true;
              return true;
          } else {
              alert("El formulario ya se esta enviando...");
              return false;
          }
      }
  </script>
@endsection

@section('contenido')
  <div class="row">
    <div class="col-xs-12">
      <h3> <b> Nuevo Socio</b></h3>
       @php
          if($bandera==0){
            $numero=0;
          }
          else{
            $numero=substr ($ultimo->codigo,0,3);
          }
       @endphp
      @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {!!Form::open(array('url' =>'administracion/socio' ,'method'=>'POST','autocomplete'=>'off','files'=>'true','onsubmit' => 'checkSubmit()'))!!}
      {{Form::token()}}
            <div class="col-xs-6">
              <div class="form-group">
                <label for="nombre">Nombre Socio:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del socio" value="{{old('nombre')}}">
              </div>
              <div class="form-group">
                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" id="ap" name="apellidoP" class="form-control" placeholder="Apellido Paterno" value="{{old('apellidoP')}}">
              </div>
              <div class="form-group">
                <label for="apellidoM">Apellido Materno</label>
              </div>
              <input type="text" name="apellidoM" id="am" class="form-control" placeholder="Apellido Materno" value="{{old('apellidoM')}}">
              <div class="form-group">
                <label for="carnetIdentidad">Carnet de Indentidad</label>
                <input type="text" name="carnetIdentidad" class="form-control" placeholder="Numero de Carnet de Identidad" value="{{old('carnetIdentidad')}}">
              </div>
              <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control" >
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" placeholder="calle, zona donde vive" value="{{old('direccion')}}">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label for="medidor">Número de Medidor</label>
                <input type="text" id="medidor" name="medidor" class="form-control" placeholder="Numero de su medidor" value="{{$numero+1}}" >
              </div>
              <div class="form-group">
                <label for="medidor">Mes Perteneciente</label>
                <select name="mes" id="mes">
                  <option value="Enero">Enero</option>
                  <option value="Febrero">Febrero</option>
                  <option value="Marzo">Marzo</option>
                  <option value="Abril">Abril</option>
                  <option value="Mayo">Mayo</option>
                  <option value="Junio">Junio</option>
                  <option value="Julio">Julio</option>
                  <option value="Agosto">Agosto</option>
                  <option value="Septiembre">Septiembre</option>
                  <option value="Octubre">Octubre</option>
                  <option value="Noviembre">Noviembre</option>
                  <option value="Diciembre">Diciembre</option>
                </select>
              </div>
               <div class="form-group">
                <label for="medidor">Lectura Inicial</label>
                <input type="text" id="LecturaAnterior" name="LecturaAnterior" class="form-control" placeholder="Lectura inicial del medidor" value="0" >
              </div>
              <div class="form-group">
                <label for="tipoPago">Tipo Pago</label>
                <select name="tipoPago" id="tipoPago" class="form-control">
                  @foreach($tipoPago as $tipp)
                  
                    <option value="{{$tipp->idTipoPago}}">{{$tipp->tipo}}</option>

                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="tipoMoneda">Tipo Moneda</label>
              <select name="tipoMoneda" id="tipoMoneda" class="form-control">
                @foreach($tipoCambio as $tipc)
                @if($tipc->idTipoMoneda==3)
                  <option value="{{$tipc->idTipoMoneda}}">{{$tipc->tipoCambio}}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="accion">Montó por Acción <b id="moneda">Bs.-</b> </label>
              <input type="number" name="accion" id="accion" class="form-control"  placeholder="Monto a cobrar por accion" value="{{old('accion')}}">
            </div>
            <div class="form-group" id="proximoPago">
              <label for="fechaproximo">Fecha Próximo Pagó</label>
              <input type="date" value="{{$fecha}}" name="fechaproximo" class="form-control" >
            </div>
            <div class="form-group">
              <label for="fecha">Fecha Registro</label>
              <input type="text" value="{{$fecha}}" name="fecha" class="form-control" disabled >
            </div>
            <div class="form-group">
              <label for="concepto">Observación</label>
              <input type="text" name="concepto" class="form-control" placeholder="Observación del Cobro" value="{{old('concepto')}}">
            </div>
            <div class="form-group">
              <label for="usuario">Registrado por:</label>
              <input type="text" name="usuario" class="form-control" value="{{ Auth::user()->name.' '.Auth::user()->apellidoP }}" disabled>
            </div>
          </div>
          <div class="col-xs-12">
            <button id="registrar" type="submit" name="button" class="btn btn-primary">Registrar</button>
            <button type="reset" name="button" class="btn btn-danger">Cancelar</button>
          </div>
      {{Form::Close()}}
    </div>
  </div>
@endsection
