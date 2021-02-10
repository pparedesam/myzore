<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at','codigo'];

    public function type(){
        return $this->belongsTo(CatalogType::class);
    }
    public function products(){
        return $this->belongsTo(Producto::class, 'catalog_products');
    }
}
