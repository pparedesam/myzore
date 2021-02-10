<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id','nivel_id'];

    
    public function personajuridica(){
        return $this->belongsTo(PersonaJuridica::class);
    }

    public function nivel(){
        return $this->belongsTo(ProviderNivel::class);
    }

    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function wareHouses(){
        return $this->belongsToMany(Warehouse::class);
    }
}
