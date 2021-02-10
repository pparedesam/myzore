<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KardexDetalle extends Model
{
    use HasFactory;

    protected $table = 'kardexdetalle';

    protected $guarded = ['id','created_at','updated_at'];

    public function kardex(){
        
        return $this->belongsTo(Kardex::class);
    }

    public function tipo(){
        
        return $this->belongsTo(KardexTipoDetalle::class);
    }
}
