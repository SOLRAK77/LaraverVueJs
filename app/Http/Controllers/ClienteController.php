<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class ClienteController extends Controller
{
    /*

     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $numPaginas=3;
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        //if (!$request->ajax()) return redirect('/');     
        if($buscar==''){
            $personas = Persona::orderBy('id','desc')->paginate($numPaginas);
        }else{
            $personas = Persona::where($criterio,'like','%'.$buscar.'%')->paginate($numPaginas);
        }
        //$categorias = Categoria::all();        
        //return $categorias;
        return [
            "pagination" => [
                'total'=>        $personas->total(),
                'current_page'=> $personas->currentPage(),
                'per_page'=>     $personas->perPage(),
                'last_page'=>    $personas->lastPage(),
                'from'=>         $personas->firstItem(),
                'to'=>           $personas->lastItem(),
                ],
                'personas' => $personas
        ];
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = new Persona();
        $persona->nombre =          $request->nombre;
        $persona->tipo_documento =  $request->tipo_documento;
        $persona->num_documento =   $request->num_documento;
        $persona->direccion =       $request->direccion;
        $persona->telefono =        $request->telefono;
        $persona->email =           $request->email;
        $persona->save();
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $persona = Persona::findOrFail($request->id);
        $persona->nombre =          $request->nombre;
        $persona->tipo_documento =  $request->tipo_documento;
        $persona->num_documento =   $request->num_documento;
        $persona->direccion =       $request->direccion;
        $persona->telefono =        $request->telefono;
        $persona->email =           $request->email;
        $persona->save();
    }
}
