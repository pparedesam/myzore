<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','linea_id'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function linea(){
        return $this->belongsTo(Linea::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

}
