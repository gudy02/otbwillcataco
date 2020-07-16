<?php

namespace sisOTB\Http\Controllers;

use Illuminate\Http\Request;

use sisOTB\Http\Requests;
use sisOTB\User;
use sisOTB\Rol;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisOTB\Http\Requests\UsuarioFormRequest;
use DB;
use Carbon\Carbon;
class UsuarioController extends Controller
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
          $usuario=DB::table('users as u')
              ->join('rol as r','r.idRol','=','u.idRol')
              ->select('u.id','.u.apellidoP','u.apellidoM','u.carnetIdentidad','u.foto','u.name','r.nombre as rol','u.email')
              ->where('u.estado','=','Habilitado')
              ->paginate(10);
              return view('seguridad.usuario.index',['searchText'=>$query,'usuario'=>$usuario]);
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
      $usuario=DB::table('users')->get();
      $rol=DB::table('rol as r')
        ->where('r.estado','=','Habilitado')
        ->get();
      return view('seguridad.usuario.create',['fecha'=>$fecha,'usuario'=>$usuario,'rols'=>$rol]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioFormRequest $request)
    {
      $usuario=new User;
      $rol=new Rol;
        try {
          DB::begintransaction();

          //**OTRO ROL***
          // if ($request->rol=='otro') {
          //   $rol->estado='Habilitado';
          //   $rol->nombre=$request->nuevoRol;
          //   $rol->save();
          //   $usuario->idRol=$rol->idRol;
          // }
          // else{
          //   $usuario->idRol=$request->rol;
          //
          // }


          $usuario->idRol=$request->rol;
          $usuario->name=$request->name;
          $usuario->apellidoP=$request->apellidoP;
          $usuario->apellidoM=$request->apellidoM;
          $usuario->carnetIdentidad=$request->carnetIdentidad;
          if (Input::hasFile('imagen')) {
            $foto=Input::file('imagen');
            $foto->move(public_path().'/imagenes/usuario/',$foto->getClientOriginalName());
            $usuario->foto=$foto->getClientOriginalName();
          }
          else{
            $usuario->foto='photo.jpg';
          }
          $usuario->email=$request->email;
          $usuario->password=bcrypt($request->password);
          $usuario->estado='Habilitado';
          $usuario->save();
          DB::commit();

        } catch (\Exception $e) {
          DB::rollback();
        }
        return Redirect::to('/seguridad/usuario');

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
        $usuario=User::findOrFail($id);
        $rol=DB::table('rol')->get();
        return view('seguridad.usuario.edit',['usuario'=>$usuario,'rols'=>$rol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioFormRequest $request, $id)
    {
      $rol=new Rol;
      $usuario=User::findOrFail($id);

      //***Actualizar nuevo Rol***
      // if ($request->rol=='otro') {
      //   $rol->estado='Habilitado';
      //   $rol->nombre=$request->nuevoRol;
      //   $rol->save();
      //   $usuario->idRol=$rol->idRol;
      // }
      // else{
      //   $usuario->idRol=$request->rol;
      //
      // }
      
        $usuario->idRol=$request->rol;
        $usuario->name=$request->name;
        $usuario->apellidoP=$request->apellidoP;
        $usuario->apellidoM=$request->apellidoM;
        $usuario->carnetIdentidad=$request->carnetIdentidad;
        if (Input::hasFile('imagen')) {
          $foto=Input::file('imagen');
          $foto->move(public_path().'/imagenes/usuario/',$foto->getClientOriginalName());
          $usuario->foto=$foto->getClientOriginalName();
        }
        $usuario->email=$request->email;
        $usuario->password=bcrypt($request->password);
        $usuario->idRol=$request->rol;
        $usuario->update();
        return Redirect::to('/seguridad/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->estado='Deshabilitado';
        $usuario->update();
        return Redirect::to('/seguridad/usuario');
    }
}
