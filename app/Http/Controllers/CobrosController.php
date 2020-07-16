<?php

namespace sisOTB\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use sisOTB\IngresoModel;
use sisOTB\MultaModel;
use sisOTB\LecturaModel;

use sisOTB\CobroAguaModel;
use sisOTB\CobroAccionModel;

use sisOTB\CobroMultaModel;

use sisOTB\PagoMultaModel;

use sisOTB\PagoAccionModel;


use sisOTB\Http\Requests;
use sisOTB\Http\Requests\RequestCobro;


use DB;
use Carbon\Carbon;
class CobrosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }
    function lista(RequestCobro $request){

        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateTimeString();

        $socio=DB::table('socio')->where('idSocio','=',$request->socio)->first();
        $medidor=DB::table('medidor')->where('idSocio',$socio->idSocio)->first();
        $multa=DB::table('multa')
            ->where('multa.idSocio','=',$socio->idSocio)
            ->where('multa.pagado','=','No')
            ->get();

        $agua=DB::table('lectura as l')
            ->join('medidor as m','l.idMedidor','=','m.idMedidor')
            ->select('l.*','m.*')
            ->where('l.pago','=','No')
            ->where('m.idSocio','=',$socio->idSocio)
            ->get();
        $accion=DB::table('cobroaccion as ca')
            ->where('ca.idSocio','=',$socio->idSocio)
            ->first();

        return view('cobros.index',['multa'=>$multa,'socio'=>$socio,'agua'=>$agua,'accion'=>$accion,'fecha'=>$fecha,'medidor'=>$medidor]);
    }


    function cobrar(Request $request){
        $bandera=0;
        if ($request->isMethod('post')){
            $multa = $request->multa;
            $lectura = $request->lectura;
            $cobroAccion = $request->cobroAccion;


            $recibo2[]=array($lectura);
            $recibo1[]=array($multa);
            $recibo3[]=array($cobroAccion);


            $myTimes=Carbon::now('America/La_Paz');
            $fecha=$myTimes->toDateTimeString();

            if ($multa) {

                $contador=count($multa);

                for ($i=0; $i < $contador ; $i++) {

                    $id=$multa[$i];
                    $multas=DB::table('multa')
                        ->select('multa.*')
                        ->where('multa.idMulta','=',$id)
                        ->first();
                    $pagoMulta=new PagoMultaModel;
                    $pagoMulta->idMulta=$multa[$i];
                    $pagoMulta->monto=$multas->monto;
                    $pagoMulta->fechaPago=$fecha;
                    $pagoMulta->idUsuario=Auth::user()->id;
                    $pagoMulta->save();

                    IngresoModel::create([
                       'fecha' => $fecha,
                       'descripcion' => 'Cobro de Multa',
                        'monto' => $multas->monto,
                        'user_id' => Auth::user()->id,
                        'tipo_id' => 4,
                    ]);

                    $recMult= $multas->idMulta;

                    $mul=MultaModel::findOrFail($id);
                    $mul->pagado='Si';
                    $mul->update();

                    $recibo1[$i]=$recMult;
                }
            }
            if ($lectura) {

                $contador=count($lectura);

                for ($i=0; $i < $contador ; $i++) {

                    $id=$lectura[$i];
                    $lecturas=DB::table('lectura')
                        ->select('lectura.*')
                        ->where('lectura.idLectura','=',$id)
                        ->first();
                    $cobroAgua=new CobroAguaModel;
                    $cobroAgua->monto=$lecturas->totalPagar;
                    $cobroAgua->idLectura=$id;
                    $cobroAgua->fechaCobro=$fecha;
                    $cobroAgua->idUsuario=Auth::user()->id;
                    $cobroAgua->concepto='Pago por consumo de agua';
                    $cobroAgua->save();

                    IngresoModel::create([
                        'fecha' => $fecha,
                        'descripcion' => 'Cobro de Consumo de Agua',
                        'monto' => $lecturas->totalPagar,
                        'user_id' => Auth::user()->id,
                        'tipo_id' => 3,
                    ]);

                    $recLectura= $lecturas->idLectura;

                    $lect=LecturaModel::findOrFail($id);
                    $lect->pago='Si';
                    $lect->update();
                    $recibo2[$i]=$recLectura;
                }


            }
            if ($cobroAccion) {
                $id=$cobroAccion[0];
                $cobroAccion=DB::table('cobroaccion')
                    ->select('cobroaccion.*')
                    ->where('cobroaccion.idCobroAccion','=',$id)
                    ->first();

                $pagoA=new PagoAccionModel;
                $pagoA->monto=$request->montoPagar;
                $pagoA->idCobroAccion=$id;
                if ($request->montoPagar==(3500-$pagoA->monto)) {
                    $pagoA->numeroPago='Ultimo Pago';
                    $bandera=1;
                }
                else{
                    $pagoA->numeroPago='Cuota';
                    $pagoA->proximoPago=$request->proximoPago;

                }

                $pagoA->fechaPago=$fecha;

                $pagoA->idUsuario=Auth::user()->id;
                $pagoA->save();

                IngresoModel::create([
                    'fecha' => $fecha,
                    'descripcion' => 'Cobro de Consumo de Agua',
                    'monto' => $request->montoPagar,
                    'user_id' => Auth::user()->id,
                    'tipo_id' => 5,
                ]);

                $cobroA=CobroAccionModel::findOrFail($id);
                $cobroA->accion=$cobroA->accion+$request->montoPagar;

                if ($bandera==0) {
                    $cobroA->pago='No';
                    # code...
                }
                else{
                    $cobroA->pago='Si';

                }

                $cobroA->update();
                $recibo3[0]=$id;
            }
        }

        return response()->json([
            'm'=>$recibo1,
            'l'=>$recibo2,
            'a'=>$recibo3,
            'medidor'=>$request->medidor
        ]);
        // return view('cobros.reporte');
        // return view('cobros.reporte',['multa'=>$multa,'cobroAccion'=>$cobroAccion,'lecturas'=>$lectura]);
    }


//    function reporte($variable,$variable2,$variable3,$variable4)
    function reporte(Request $request)
    {
        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateString();

        $arreglo=explode(",",$request->ml[0]);
        $arreglo2=explode(",",$request->lc[0]);
        $arreglo3=explode(",",$request->ca[0]);

        $idSoc="";

        $multa = DB::table('multa')
            ->whereIn('idMulta', $arreglo)
            ->get();


        $lectura = DB::table('lectura')
            ->whereIn('idLectura', $arreglo2)
            ->get();


        $pagoAccion=DB::table('pagoaccion')
            ->whereIn('idCobroAccion',$arreglo3)
            ->get();

        $medidor=DB::table('medidor as m')
            ->join('socio as s','m.idSocio','=','s.idSocio')
            ->select('s.*','m.codigo')
            ->where('m.codigo',$request->medidor)
            ->first();

        return response()->json([
            'view' => view('cobros.reporte', ['arreglo'=>$multa,'fecha'=>$fecha,'lecturas'=>$lectura,'pagoAccion'=>$pagoAccion,'medidor'=>$medidor])->render()
        ]);
    }
    public function listaAgua(Request $request){
        $socio=DB::table('socio')
            ->where('estado','Habilitado')
            ->get();
        if($request->idSocio){

            $cobro=DB::table('cobroagua as ca')
                ->join('lectura as l','ca.idLectura','=','l.idLectura')
                ->join('medidor as m','l.idMedidor','=','m.idMedidor')
                ->join('socio as s','m.idSocio','=','s.idSocio')
                ->select('l.*','ca.*','l.mes','m.codigo as medidor','s.nombre as nombreSocio','s.*')
                ->where('l.pago','Si')
                ->where('s.idSocio',$request->idSocio)
                ->orderBy('ca.fechaCobro','desc')

                // ->paginate(70);
                ->get();
        }
        else{

            $cobro=DB::table('cobroagua as ca')
                ->join('lectura as l','ca.idLectura','=','l.idLectura')
                ->join('medidor as m','l.idMedidor','=','m.idMedidor')
                ->join('socio as s','m.idSocio','=','s.idSocio')
                ->select('l.*','ca.*','l.mes','m.codigo as medidor','s.nombre as nombreSocio','s.*')
                ->where('l.pago','Si')
                ->orderBy('l.mes','desc')
                // ->paginate(70);

                ->get();
        }
        return view('cobro.agua.listadoAgua',['socio'=>$socio,'cobro'=>$cobro]);
    }
    public function listaMulta(Request $request){
        $socio=DB::table('socio')
            ->where('estado','Habilitado')
            ->get();
        if($request->idSocio){

            $multa=DB::table('pagomulta as pm')
                ->join('multa as m','pm.idMulta','=','m.idMulta')
                ->join('tipomulta as tm','m.idTipoMulta','=','tm.idTipoMulta')
                ->join('socio as s','m.idSocio','=','s.idSocio')
                ->select('m.*','pm.fechaPago','s.nombre as nombreSocio','s.*','tm.nombre as tipoMulta')
                ->where('m.pagado','Si')
                ->where('s.idSocio',$request->idSocio)
                ->get();
        }
        else{

            $multa=DB::table('pagomulta as pm')
                ->join('multa as m','pm.idMulta','=','m.idMulta')
                ->join('tipomulta as tm','m.idTipoMulta','=','tm.idTipoMulta')
                ->join('socio as s','m.idSocio','=','s.idSocio')
                ->select('m.*','pm.fechaPago','s.nombre as nombreSocio','s.*','tm.nombre as tipoMulta')
                ->where('m.pagado','Si')
                ->get();
        }
        return view('cobro.agua.listadoMulta',['socio'=>$socio,'multa'=>$multa]);
    }
    public function listaAccion(Request $request){
        $socio=DB::table('socio')
            ->where('estado','Habilitado')
            ->get();
        if($request->idSocio){

            $accion=DB::table('pagoaccion as pa')
                ->join('cobroaccion as ca','pa.idCobroAccion','=','ca.idCobroAccion')
                ->join('socio as s','ca.idSocio','=','s.idSocio')
                ->select('pa.*','ca.*','s.*')
                ->where('s.idSocio',$request->idSocio)
                ->get();
        }
        else{
            $accion=DB::table('pagoaccion as pa')
                ->join('cobroaccion as ca','pa.idCobroAccion','=','ca.idCobroAccion')
                ->join('socio as s','ca.idSocio','=','s.idSocio')
                ->select('pa.*','ca.*','s.*')
                ->get();
        }
        return view('cobro.agua.listadoAccion',['accion'=>$accion,'socio'=>$socio]);
    }
}