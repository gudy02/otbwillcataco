<?php

namespace sisOTB\Http\Controllers;

use Illuminate\Http\Request;
use sisOTB\Http\Requests;
use sisOTB\Rol;
use sisOTB\UsuarioModel;
use sisOTB\User;

use Illuminate\Support\Facades\Redirect;
use sisOTB\Http\Requests\RolFormRequest;
use DB;
use Carbon\Carbon;
class RolController extends Controller
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
        $rol=DB::table('rol as r')
        ->select('r.idRol','r.nombre','r.estado')
        ->where('r.nombre', 'LIKE','%'.$query.'%')
        ->where('r.estado', '=','Habilitado')
        ->paginate(5);
        return view('administracion.roles.index',['rols'=>$rol,'searchText'=>$query]);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolFormRequest $request)
    {
        $rol=new Rol;
        $rol->nombre=$request->nombre;
        $rol->estado='Habilitado';
        $rol->save();
        return Redirect::to('/administracion/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol=Rol::findOrFail($id);
        return view('administracion.roles.edit',['rol'=>$rol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolFormRequest $request, $id)
    {
        $rol=Rol::findOrFail($id);
        $rol->nombre=$request->nombre;
        $rol->save();
        return Redirect::to('/administracion/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol=Rol::findOrFail($id);
        $rol->estado='Deshabilitado';
        $rol->update();
        return Redirect::to('/administracion/roles');
    }
}
