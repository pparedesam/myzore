<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
