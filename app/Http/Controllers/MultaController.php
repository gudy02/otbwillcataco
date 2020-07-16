<?php

namespace sisOTB\Http\Controllers;

use Illuminate\Http\Request;

use sisOTB\Http\Requests;
use sisOTB\MultaModel;
use sisOTB\SocioModel;
use sisOTB\TipoMultaModel;
use sisOTB\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use sisOTB\Http\Requests\MultaFormRequest;
use Carbon\Carbon;
use DB;
class MultaController extends Controller
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
          $multa=DB::table('multa as m')
          ->join('socio as s','m.idSocio','=','s.idSocio')
        //   ->join('users as u','m.idUsuario','=','u.id')
          ->join('tipoMulta as tm','m.idTipoMulta','=','tm.idTipoMulta')
          ->select('m.idMulta','tm.nombre','m.concepto','m.monto','m.pagado',DB::raw('CONCAT(s.nombre," ",s.apellidoP,  " " ,s.apellidoM ) as NombreSocio'), 'm.fechaMulta')
          ->where('m.estado','=','Habilitado')
          ->paginate(10);
          return view('administracion.multa.index',['multa'=>$multa,'searchText'=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoMulta=DB::table('tipoMulta as tm')->get();
        $socio=DB::table('socio as s')
            ->join('medidor as m','s.idSocio','=','m.idSocio')
            ->select('s.*','m.*')
            ->where('s.estado','=','Habilitado')
            ->get();
        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateString();
        return view('administracion.multa.create',['socio'=>$socio,'fecha'=>$fecha,'tipoMulta'=>$tipoMulta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MultaFormRequest $request)
    {

      $multa=new MultaModel;
      $tipoMulta=new TipoMultaModel;
        try {

          if ($request->multa=='otro') {
            $tipoMulta->nombre=ucfirst($request->otraMulta);
            $tipoMulta->save();
            $multa->idTipoMulta=$tipoMulta->idTipoMulta;

          }
          else {

            $multa->idTipoMulta=$request->multa;
          }

          DB::beginTransaction();
          $multa->monto=$request->monto;
          $multa->concepto=ucfirst($request->concepto);
          $multa->idSocio=$request->socio;
          $multa->idUsuario=1;
          $multa->estado='Habilitado';
          $multa->fechaMulta=$request->fecha;
          $myTimes=Carbon::now('America/La_Paz');
          $fecha=$myTimes->toDateTimeString();
          $multa->fechaRegistro=$fecha;

          if ($request->multa==4) {
            $multa->pagado='Si';
            
          } else {
            $multa->pagado='No';
          }
          
          $multa->save();
          DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return Redirect::to('/administracion/multa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $multa=DB::table('multa as m')
          ->join('socio as s','m.idSocio','=','s.idSocio')
          ->join('usuario as u','m.idUsuario','=','u.idUsuario')
          ->select('m.idMulta','m.nombreMulta','m.concepto','m.monto','s.nombre + s.apellidoP + s.apellidoM as NombreSocio', 'm.fechaMulta')
          ->where('m.idMulta','=' ,$id)
          ->first();
        return view('administracion.multa.show',['multa'=>$multa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // $multa=DB::table('multa as m')
      //     ->join('socio as s','m.idSocio','=','s.idSocio')
      //     ->join('medidor as me','s.idMedidor','=','me.idMedidor')
      //     ->select('s.*','me.*','m.*')
      //     ->where('s.estado','=','Habilitado')
      //     ->where('m.estado','=','Habilitado')
      //     ->where('m.idMulta','=',$id)
      //     ->get();
      $multa=MultaModel::findOrFail($id);
      $socio=DB::table('socio as s')
          ->join('medidor as m','s.idSocio','=','m.idSocio')
          ->select('s.*','m.*')
          ->where('s.estado','=','Habilitado')
          ->get();
      $tipoMulta=DB::table('tipoMulta as tm')
        ->select('tm.*')
        ->get();
        return view('administracion.multa.edit', ['multa'=>$multa,'socio'=>$socio,'tipoMulta'=>$tipoMulta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MultaFormRequest $request, $id)
    {
        $multa=MultaModel::findOrFail($id);
        $multa->idTipoMulta=$request->tipoMulta;
        $multa->monto=$request->monto;
        $multa->concepto=$request->concepto;
        $multa->idSocio=$request->socio;
        $multa->idUsuario=Auth::user()->id;
        $multa->fechaMulta=$request->fecha;
        $multa->update();
        return Redirect::to('/administracion/multa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $multa=MultaModel::findOrFail($id);
        $multa->estado='Deshabilitado';
        $multa->update();
        return Redirect::to('/administracion/multa');
    }
    /**
      **metodos nuevos
    */
    public function socioMulta(Request $request)
    {
        if ($request) {
          $query=trim($request->searchText);

        }
    }
}
