<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //protected $table = 'categorias';
    //protected $primarykey = 'id';

    //con la propiedad fillable, se indica los campos de la tabla
    protected $fillable = ['nombre','descripcion','condicion'];

    public function articulos(){
        return $this->hasMany('App\Articulo');
    }
}
