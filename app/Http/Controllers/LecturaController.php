<?php

namespace sisOTB\Http\Controllers;

use Illuminate\Http\Request;
use sisOTB\Http\Requests;
use sisOTB\LecturaModel;
use sisOTB\MedidorModel;
use sisOTB\SocioModel;
use sisOTB\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use sisOTB\Http\Requests\LecturaFormRequest;
use Carbon\Carbon;
use DB;
class LecturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
       $this->middleware('auth');

     }
    public function index(Request $request)
    {
        if ($request) {
          $query=trim($request->searchText);

          // $lectura=DB::table('lectura as l')
          // ->select('l.*')
          // ->where('l.idMedidor','=',$socio->idMedidor)
          // ->first();
          // $myTimes=Carbon::now('America/La_Paz');
          // $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
          // $mes=$meses[$myTimes->format('m')-1];

          $socio=DB::table('socio as s')
              ->join('medidor as m','s.idSocio','=','m.idSocio')
              ->select('m.*','s.*')
              ->where('s.estado','=','Habilitado')
              ->where('s.nombre','LIKE','%'.$query.'%')
              ->where('s.apellidoP','LIKE','%'.$query.'%')
              ->where('s.apellidoM','LIKE','%'.$query.'%')
              ->where('s.carnetIdentidad','LIKE','%'.$query.'%')
              ->where('m.codigo','LIKE','%'.$query.'%')
              ->paginate(1000);



          return view('administracion.lectura.index',['socio'=>$socio,'searchText'=>$query]);
        }
    }

    // protected  function  nombremes($mes){
    //     setlocale(LC_TIME, 'America/La_Paz');
    //     $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
    //     return $nombre;
    //  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function create($medidor)
    {
      $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
      $mes='';
      $posicion=0;
      $lectura=DB::table('lectura as l')
        ->select('l.*')
        ->where('l.idMedidor','=',$medidor)
        ->max('l.idLectura');
      $id=$lectura;
      $myTimes=Carbon::now('America/La_Paz');
      $fecha=$myTimes->toDateString();
      $lectura2=LecturaModel::findOrFail($id);
      $medidor=MedidorModel::findOrFail($lectura2->idMedidor);
      $socio=DB::table('socio as s')
        ->select('s.*')
        ->where('s.idSocio','=',$medidor->idSocio)
        ->first();

      //$mes=\NumeroALetras::convertir($lectura2->mes+1);

      for ($i=0; $i < 11 ; $i++) {
        if ($lectura2->mes==$meses[$i]) {
          $mes=$meses[$i+1];
          $posicion=$i+1;
        }
      }

      if ($myTimes->format('m')==$posicion) {
        return view('administracion.lectura.invalid',['mes'=>$meses[$posicion-1]]);
      }
      else{

      //$mes=$this->nombremes($num);
        return view('administracion.lectura.create',['lectura'=>$lectura2,'fecha'=>$fecha,'medidor'=>$medidor,'socio'=>$socio,'mess'=>$mes]);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LecturaFormRequest $request)
    {
        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateString();
        $lectura=new LecturaModel;
        $lectura->lecturaAnterior=$request->lecturaAnterior;
        $lectura->lecturaActual=$request->lecturaActual;
        $lectura->idMedidor=$request->medidor;
        $lectura->fechaLectura=$request->fechaLectura;
        $lectura->idUsuario=Auth::user()->id;
        $lectura->cantidadConsumo=$request->cantidadConsumo;
        $lectura->mes=$request->mes;
        $lectura->year=$myTimes->format('Y');
        $lectura->fechaRegistro=$request->fechaRegistro;
        $lectura->totalPagar=$request->totalPagar;
        if ($request->mesa!=null) {
          # code...
          $lectura->pago='Si';
        } 
        else{

          $lectura->pago='No';
        }
        $lectura->save();
        return Redirect::to('/administracion/lectura');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medidor=DB::table('medidor as m')
        ->where('idMedidor','=',$id)
        ->first();

        $socio=DB::table('socio as s')
        ->where('s.idSocio','=',$medidor->idSocio)
        ->first();

        $lectura=DB::table('lectura as l')
          ->join('users as u','l.idUsuario','=','u.id')
          ->select('u.*','l.*')
          ->where('l.idMedidor','=',$medidor->idMedidor)
          ->get();

          return view('administracion.lectura.show',['socio'=>$socio,'medidor'=>$medidor,'lectura'=>$lectura]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
