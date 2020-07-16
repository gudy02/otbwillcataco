<?php

namespace sisOTB\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use sisOTB\EgresoModel;
use sisOTB\Http\Requests;
use sisOTB\IngresoModel;

class MovimientoEconomicoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index_ingreso(){
        $tipo_ingreso = \DB::table('tipo_movimiento_economico')
            ->where('tipo', 1)
            ->get();

        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateString();
        return view('movimiento.ingreso', compact('fecha', 'tipo_ingreso'));
    }

    public function index_egreso(){
        $tipo_ingreso = \DB::table('tipo_movimiento_economico')
            ->where('tipo', 0)
            ->get();

        $myTimes=Carbon::now('America/La_Paz');
        $fecha=$myTimes->toDateString();
        return view('movimiento.egreso', compact('fecha', 'tipo_ingreso'));
    }

    public function index_lista(){
        $tipo_movimiento = \DB::table('tipo_movimiento_economico')->get();
        return view('movimiento.lista', compact('tipo_movimiento'));
    }

    public function store(Requests\IngresoRequest $request) {
        $request['user_id'] = Auth::user()->id;

        $myTimes = Carbon::now('America/La_Paz');
        $request['fecha_registro'] = $myTimes->toDateString();
        IngresoModel::create($request->all());
        return redirect('movimiento/ingreso');

    }

    public function store_egreso(Requests\EgresoRequest $request) {
        $request['user_id'] = Auth::user()->id;

        $myTimes = Carbon::now('America/La_Paz');
        $request['fecha_registro'] = $myTimes->toDateString();
        EgresoModel::create($request->all());
        return redirect('movimiento/egreso');

    }

    public function generate_reporte_movimiento(Request $request){

        if ($request->tipo_movimiento == 0){

            if ($request->tipo_id != 'otro'){
                $response = EgresoModel::whereBetween('fecha', [$request->fecha_start, $request->fecha_end])
                    ->where('tipo_id', $request->tipo_id)
                    ->get();
            }
            else{
                $response = EgresoModel::whereBetween('fecha', [$request->fecha_start, $request->fecha_end])
                    ->get();
            }
        }

        if ($request->tipo_movimiento == 1) {

            if ($request->tipo_id != 'otro') {
                $response = IngresoModel::whereBetween('fecha', [$request->fecha_start, $request->fecha_end])
                    ->where('tipo_id', $request->tipo_id)
                    ->get();
            } else {
                $response = IngresoModel::whereBetween('fecha', [$request->fecha_start, $request->fecha_end])
                    ->get();
            }
        }

        $tipo_movimiento = ($request->tipo_movimiento) ? 'Ingreso' : 'Egreso';
        $fecha = Carbon::now()->format('d-m-Y');

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');

        $pdf=PDF::loadView('administracion.pdf.movimiento_economico',['response'=>$response, 'fecha' => $fecha, 'tipo_movimiento' => $tipo_movimiento]);
        return $pdf->stream('movimiento_economico.pdf');
    }
}
