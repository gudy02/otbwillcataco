<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use sisOTB\EgresoModel;
use sisOTB\IngresoModel;

/*
|--------------------------------------------------------------------------
| Application Routes
|-------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/login', function () {
    return view('auth/login');
});

Route::get('/administracion', function () {
    return view('layout.admin');
});

Route::group(['middleware'=>['admin']],function(){

    Route::resource('administracion/socio','SocioController');
    Route::resource('administracion/roles','RolController');
    Route::resource('administracion/multa','MultaController');
    Route::resource('seguridad/usuario','UsuarioController');

    Route::get('Reporte/socioList',function(){
        // $socio=sisOTB\SocioModel::all();
        $socio=\DB::table('socio as s')
            ->join('medidor as m','s.idSocio','=','m.idSocio')
            ->select('s.nombre','s.apellidoP','s.apellidoM','m.codigo','m.idMedidor')
            ->orderBy('s.nombre','asc')
            ->get();
        $pdf=PDF::loadView('administracion.pdf.vista',['socio'=>$socio]);
        return $pdf->stream('socio.pdf');
    });
    Route::get('asistencia',function(){
        // $socio=sisOTB\SocioModel::all();
        $socio=\DB::table('socio as s')
            ->join('medidor as m','s.idSocio','=','m.idSocio')
            ->select('s.nombre','s.apellidoP','s.apellidoM','m.codigo')
            ->orderBy('s.nombre','asc')
            ->get();
        $myTimes=Carbon::now( 'America/La_Paz');
        $fecha=$myTimes->toDateString();
        $pdf=PDF::loadView('administracion.pdf.asistencia',['socio'=>$socio,'fecha'=>$fecha]);
        return $pdf->stream('socio.pdf');
    });

    Route::get('Reporte/socioMulta',function(){
        $socio= \DB::table('socio as s')
            ->join('multa as m','s.idSocio','=','m.idSocio')
            ->select('s.*','m.*')
            ->where('m.pagado','=','No')
            ->get();
        $pdf=PDF::loadView('administracion.pdf.socioMulta',['socio'=>$socio]);
        return $pdf->stream('socio.pdf');
    });
    Route::get('Reporte/retraso',function(){
        $socio= \DB::table('socio as s')
            ->join('multa as m','s.idSocio','=','m.idSocio')
            ->join('tipomulta as tm','m.idTipoMulta','=','tm.idTipoMulta')
            ->select('s.*','m.*','tm.nombre as tipMul')
            ->where('tm.nombre','=','retraso')
            ->get();
        $pdf=PDF::loadView('administracion.pdf.retrasados',['socio'=>$socio]);
        return $pdf->stream('socio.pdf');
    });

    Route::get('Reporte/corte',function(){
        $array=[];
        $medidor= \DB::table('medidor as me')
            ->join('socio as s','me.idSocio','=','s.idSocio')
            ->select('s.idSocio','me.idMedidor')
            ->where('s.estado','=','Habilitado')
            ->get();
        foreach ($medidor as $me) {
            $lectura=\DB::table('lectura as lec')
                ->join('medidor as me','lec.idMedidor','=','me.idMedidor')
                ->join('socio as s','me.idSocio','=','s.idSocio')
                ->select('s.*,lec.mes')
                ->where('lec.pago','=','No')
                ->where('lec.idMedidor','=',$me->idMedidor)
                ->count();

            if ($lectura>=3) {
                array_push($array, $me->idSocio);
            }




        }

        $socios=\DB::table('socio as s')
            ->join('medidor as m','s.idSocio','=','m.idSocio')
            ->select('s.*','m.codigo')
            ->whereIn('s.idSocio',$array)
            ->get();


        $pdf=PDF::loadView('administracion.pdf.corte',['socio'=>$socios]);
        return $pdf->stream('socio.pdf');
    });

    Route::get('deudor/accion',function(){
        $array=[];
        $deudores=\DB::table('cobroaccion as ca')
            // ->join('pagoaccion as pa','ca.idCobroAccion','=','pa.idCobroAccion')
            ->join('socio as s','ca.idSocio','=','s.idSocio')
            ->join('medidor as m','s.idSocio','=','m.idSocio')
            // \DB::raw('SUM(pa.monto) as montoPagado')
            ->select('s.nombre','s.apellidoP','s.apellidoM','m.codigo','ca.accion')
            ->where('s.estado','Habilitado')
            ->where('ca.accion','<','3500')
            ->get();


        $pdf=PDF::loadView('administracion.pdf.accion',['deudores'=>$deudores]);
        return $pdf->stream('deudores.pdf');
    });

    Route::get('Reporte/recibo',function(){
        $socioID=sisOTB\SocioModel::all();
        $socio=\DB::table('socio as s')
            ->join('cobroaccion as ca','s.idSocio','=','ca.idSocio')
            ->select('s.*','ca.*')
            ->where('s.idSocio','=',$socioID->last()->idSocio)
            ->get();
        $pdf=PDF::loadView('administracion.pdf.socioRecibo',['socio'=>$socio]);
        return $pdf->stream('socio.pdf');
    })->name('recibo');

});

Route::group(['middleware'=>'rol:1,2',],function(){
    Route::get('administracion/lectura/create/{parametro1}','LecturaController@create');
    Route::resource('administracion/lectura','LecturaController');
    Route::resource('administracion/lectura','LecturaController',['except'=>[
        'create',
    ]]);
});

Route::resource('cobro/agua', 'CobroAguaController');
Route::get('movimiento/ingreso', 'MovimientoEconomicoController@index_ingreso');
Route::post('movimiento/store', 'MovimientoEconomicoController@store');

Route::get('movimiento/egreso', 'MovimientoEconomicoController@index_egreso');
Route::post('movimiento/store_egreso', 'MovimientoEconomicoController@store_egreso');

Route::get('movimiento/lista', 'MovimientoEconomicoController@index_lista');

Route::get('aporte/index', 'AporteController@index');
Route::get('aporte/lista', 'AporteController@lista');
Route::post('aporte/store', 'AporteController@store');


Route::post('movimiento/generate_lista_movimiento', function (\Illuminate\Http\Request $request){
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

    $pdf= PDF::loadView('administracion.pdf.movimiento_economico',['response'=>$response, 'fecha' => $fecha, 'tipo_movimiento' => $tipo_movimiento]);
    return $pdf->stream('movimiento_economico.pdf');
});

//Route::resource('administracion/personal','PersonalController');

Route::auth();

Route::get('/', 'HomeController@index');
Route::post('cobro/agua/listado', 'CobroAguaController@listado');
Route::get('/acercaDe', function(){
    return view('acerca.acercaDe');
});
Route::get('/error', function(){
    return view('errorUs.errorUs');
});

Route::get('/{slug?}','HomeController@index');
Route::post('cobros/lista','CobrosController@lista');

Route::post('cobro/cobros','CobrosController@cobrar')->name('cobros');
Route::get('cobro/lista/agua','CobrosController@listaAgua');
Route::get('cobro/lista/accion','CobrosController@listaAccion');
Route::get('cobro/lista/multa','CobrosController@listaMulta');

//Route::get('/cobros/reporte/{datos}/{datos2}/{datos3}/{datos4}','CobrosController@reporte')->name('cobro_reporte');
Route::post('/cobros/reporte/','CobrosController@reporte')->name('cobro_reporte');

Route::post('/listaAccion/socio','CobrosController@listaAccion');
Route::post('listaAgua/socio','CobrosController@listaAgua');
Route::post('listaMulta/socio','CobrosController@listaMulta');
// Route::get('/cobros/reporte/{datos}',function($datos){
//   return view('cobros.reporte',['datos'=>$datos]);
// });