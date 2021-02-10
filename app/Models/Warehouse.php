<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = strtoupper($value);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }

    public function distrito(){
        return $this->belongsTo(Distrito::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kardexes(){
        return $this->belongsToMany(Kardex::class);
    }
}
