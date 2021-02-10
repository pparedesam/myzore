<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;
    protected $table='kardexes';
    protected $guarded = ['id','created_at','updated_at'];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function wareHouse(){
        return $this->belongsTo(Warehouse::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function talla(){
        return $this->belongsTo(Talla::class);
    }

    public function movimientos(){
        return $this->belongsToMany(KardexDetalle::class);
    }
}
