<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function generoable()
    {
        return $this->morphTo();
    }

    //Relacion uno a muchos
    

    //Relación muchos a muchos
    public function productos(){
        return $this->belongsToMany(Producto::class);
    }
    


}
