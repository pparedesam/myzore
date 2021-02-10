<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    //Relacion uno a muchos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function tipos()
    {
        return $this->hasMany(Tipo::class);
    }

    public function materiales()
    {
        return $this->hasMany(Material::class);
    }
    
}
