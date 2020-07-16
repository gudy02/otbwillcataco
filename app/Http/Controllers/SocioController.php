<?php

namespace sisOTB\Http\Controllers;

use Illuminate\Http\Request;

use sisOTB\Http\Requests;
use sisOTB\SocioModel;
use sisOTB\PagoAccionModel;
use sisOTB\TipoPagoModel;
use sisOTB\TipoMonedaModel;
use sisOTB\MedidorModel;
use sisOTB\LecturaModel;
use sisOTB\User;

use sisOTB\CobroAccionModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use sisOTB\Http\Requests\SocioFormRequest;
use sisOTB\Http\Requests\ContratoFormRequest;
use sisOTB\Http\Requests\CobroAccionFormRequest;
use DB;
use Carbon\Carbon;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
       $this->middleware('auth');
     }
    public function index()
    {
          $socio=DB::table("socio as s")
          ->join('medidor as m','s.idSocio','=','m.idSocio')
          ->join('cobroaccion as cA','s.idSocio','=','cA.idSocio')
          ->select('s.idSocio','s.nombre','s.apellidoP','s.apellidoM','s.carnetIdentidad','m.codigo','s.foto','s.direccion','cA.idCobroAccion','s.estado')
          ->where('s.estado','=','Habilitado')
          ->orderBy('s.idSocio', 'desc')
          ->paginate(15000);
          $cantidad=SocioModel::count();
          return view('administracion.socio.index',['socio'=>$socio,'cantidad'=>$cantidad]);
    }
    public function buscar(Request $request)
    {
        if ($request) {
          
          $query=trim($request->searchText);
          $socio=DB::select("SELECT DISTINCT socio.*,medidor.*,cobroaccion.* FROM socio, medidor,cobroaccion,users WHERE socio.idSocio=medidor.idSocio AND cobroaccion.idSocio=socio.idSocio AND socio.estado ='Habilitado' AND (socio.nombre = 'carlos' OR socio.apellidoM='limpias')");
          return view('administracion.socio.index',['searchText'=>$query,'socio'=>$socio]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $myTimes=Carbon::now( 'America/La_Paz');
      $fecha=$myTimes->toDateString();
      $tipoPago=DB::table('tipopago')->get();
      $tipoCambio=DB::table('tipomoneda')->get();
      $cobroAcciob=DB::table('cobroaccion')->get();

       $socioUltimo=SocioModel::orderBy('idSocio','desc')->first();
       $medidor=0;
       $bandera=0;
       if ($socioUltimo!="") {
          
          $medidor=DB::table('medidor as m')
          ->where('m.idSocio',$socioUltimo->idSocio)
          ->first();
          $bandera=1;
       }
      
      return view('administracion.socio.create',['tipoPago'=>$tipoPago,'tipoCambio'=>$tipoCambio,'fecha'=>$fecha,'ultimo'=>$medidor,'bandera'=>$bandera]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoFormRequest $request)
    {
      $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
      $pagoAccion=new PagoAccionModel;
      $socio=new SocioModel;
      $medidor=new MedidorModel;
      $cobroAccion=new CobroAccionModel;


       try {
        DB::beginTransaction();

        $socio->nombre=ucfirst($request->nombre);
        $socio->apellidoP=ucfirst($request->apellidoP);
        $socio->apellidoM=ucfirst($request->apellidoM);
        $socio->carnetIdentidad=$request->carnetIdentidad;
        if (Input::hasFile('imagen')) {
          $foto=Input::file('imagen');
          $foto->move(public_path().'/imagenes/socio/',$foto->getClientOriginalName());
          $socio->foto=$foto->getClientOriginalName();
        }
        else{
          $socio->foto='photo.jpg';
        }
        $socio->direccion=ucfirst($request->direccion);
        $socio->idUsuario=Auth::user()->id;
        $socio->estado='Habilitado';
        $socio->save();

        $medidor->codigo=$request->medidor;
        $medidor->idSocio=$socio->idSocio;
        $medidor->save();

        $cobroAccion->accion=$request->accion;
        $cobroAccion->idSocio=$socio->idSocio;
        $cobroAccion->idUsuario=Auth::user()->id;
        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateTimeString();
        $cobroAccion->fechaReg=$fecha;
        $cobroAccion->idTipoPago=$request->tipoPago;
        $cobroAccion->idTipoMoneda=$request->tipoMoneda;
        $cobroAccion->concepto=ucfirst($request->concepto);
        $cobroAccion->save();


        $pagoAccion->monto=$cobroAccion->accion;
        $pagoAccion->fechaPago=$fecha;
        $pagoAccion->idCobroAccion=$cobroAccion->idCobroAccion;
        $var=$request->tipoPago;

        if ($var==4) {
          $pagoAccion->proximoPago=$request->fechaproximo;
          $pagoAccion->numeroPago='Primera Cuota';
        }
        else{
          $pagoAccion->numeroPago='Pago Contado';

        }

        $pagoAccion->idUsuario=Auth::user()->id;
        $pagoAccion->save();

        $lectura=new LecturaModel;
        $lectura->lecturaAnterior=0;
        $lectura->lecturaActual=$request->LecturaAnterior;
        $lectura->idMedidor=$medidor->idMedidor;
        $lectura->fechaLectura=$fecha;
        $lectura->fechaRegistro=$fecha;
        $lectura->idUsuario=Auth::user()->id;
        $lectura->cantidadConsumo=$request->LecturaAnterior-0;
        $lectura->mes=$request->mes;
        $lectura->year=$myTimes->format('Y');
        $lectura->totalPagar=($request->LecturaAnterior-0)*2;
        if ($request->LecturaAnterior==0) {
          $lectura->pago="Si";
        }
        else{

            $lectura->pago='No';
        }
        $lectura->save();
        DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
      }
      $socioID=SocioModel::all();
      $socioRecibo=DB::table('socio as s')
      ->join('cobroaccion as ca','s.idSocio','=','ca.idSocio')
      ->select('s.*','ca.*')
      ->where('s.idSocio','=',$socioID->last()->idSocio)
      ->first();
      // return redirect('/administracion/socio/recibo');
      return view('administracion/socio/show',['socio'=>$socioRecibo,'fecha'=>$fecha]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // <li><a href="{{url('Reporte/recibo')}}" target="_blank"><i class="fa fa-circle-o"></i>RECIBO</a></li>
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socio=SocioModel::findOrFail($id);
        $medidor=DB::table('medidor as m')
          ->where('idSocio','=',$socio->idSocio)
          ->first();
        return view('administracion.socio.edit',['socio'=>$socio,'medidor'=>$medidor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocioFormRequest $request, $id)
    {
        $socio=SocioModel::findOrFail($id);
        $obtenerDatos=DB::table('medidor as m')
          ->where('idSocio','=',$socio->idSocio)
          ->first();
        $medidor=MedidorModel::findOrFail($obtenerDatos->idMedidor);
        $socio->nombre=ucfirst($request->nombre);
        $socio->apellidoP=ucfirst($request->apellidoP);
        $socio->apellidoM=ucfirst($request->apellidoM);
        $socio->carnetIdentidad=$request->carnetIdentidad;
        if (Input::hasFile('fotoNueva')) {
          $foto=Input::file('fotoNueva');
          $foto->move(public_path().'/imagenes/socio/',$foto->getClientOriginalName());
          $socio->foto=$foto->getClientOriginalName();
        }
       
        $socio->direccion=ucfirst($request->direccion);
        $socio->update();
        $medidor->codigo=$request->medidor;
        $medidor->update();
        return  Redirect::to('/administracion/socio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $socio=SocioModel::findOrFail($id);
        $socio->estado='Deshabilitado';
        $socio->update();
        return Redirect::to('/administracion/socio');
    }
}
