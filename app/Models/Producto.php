<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at','codigo'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['descripcion'] = strtoupper($value);
    }

    public function setCodigoProveedorAttribute($value)
    {
        $this->attributes['codigoProveedor'] = strtoupper($value);
    }

    //Relacion uno a mucho inversa
    public function linea(){
        return $this->belongsTo(Linea::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

    //Relacion muchos a muchos
    public function tallas(){
        return $this->belongsToMany(Talla::class, 'producto_talla');
    }

    public function colors(){
        return $this->belongsToMany(Color::class, 'producto_color');
    }

    public function providers(){
        return $this->belongsToMany(Provider::class, 'producto_provider');
    }
}
