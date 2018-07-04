<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
/*Importamos el modelo*/
use App\Categoria;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        ////ejemeplo con query_builder:
        ////Se importa la clase "use Illuminate\Support\Facades\DB"
        ////$users = DB::table('users')->paginate(15);
        //$categorias = DB::table('categorias')->paginate(4);        
        ////
        ////ejemeplo con eloquent.ORM:        
        ////La libreria "use Illuminate\Support\Facades\DB" no se utiliza en eloquent
        $categorias = Categoria::paginate(4);
        //$categorias = Categoria::all();        
        //return $categorias;
        return [
            "pagination" => [
                'total'=> $categorias->total(),
                'current_page'=> $categorias->currentPage(),
                'per_page'=> $categorias->perPage(),
                'last_page'=> $categorias->lastPage(),
                'from'=> $categorias->firstItem(),
                'to'=> $categorias->lastItem(),
                ],
                'categorias' => $categorias
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
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
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
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '1';
        $categoria->save();
    }
}
