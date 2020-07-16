<?php

namespace sisOTB\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use sisOTB\AporteModel;
use sisOTB\Http\Requests;
use sisOTB\SocioModel;

class AporteController extends Controller
{
    public function index(){
        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateString();
        $socios= \DB::table('socio as s')
            ->join('medidor as m','s.idSocio','=','m.idSocio')
            ->select('s.*','m.*')
            ->where('s.estado','=','Habilitado')
            ->get();

        return view('aporte.create', compact('fecha', 'socios'));
    }

    public function store(Requests\AporteRequest $request){
        $request['mes'] = Carbon::parse($request->fecha_cobro)->format('m');
        AporteModel::create($request->all());
        return redirect('aporte/index');
    }

    public function lista(){

        $aportes = AporteModel::join('socio as s', 'aporte.idSocio', '=', 's.idSocio')
            ->join('medidor as m', 's.idSocio', '=', 'm.idSocio')
            ->select('aporte.*', 's.*', 'm.*')
            ->get();

        return view('aporte.lista', compact('aportes'));
    }
}
