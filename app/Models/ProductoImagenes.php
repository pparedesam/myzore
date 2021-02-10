<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoImagenes extends Model
{
    use HasFactory;

    protected $table = 'productoimagenes';

    protected $guarded = ['id','created_at','updated_at'];

    public function producto(){
        
        return $this->belongsTo(Producto::class);
    }

    public function type(){
        
        return $this->belongsTo(ProductImageType::class);
    }
}
