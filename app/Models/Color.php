<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','hexadecimal'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    //Relación muchos a muchos
    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function images(){
        return $this->belongsToMany(ProductoImagenes::class,'productoimagenes');
    }
}
