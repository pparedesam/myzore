<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Provider extends Model
{
    use HasFactory;

    protected $table = 'producto_provider';

    protected $guarded = ['id','created_at','updated_at'];

    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function providers(){
        return $this->belongsToMany(Provider::class);
    }
}
