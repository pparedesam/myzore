<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderNivel extends Model
{

    use HasFactory;

    protected $table='provider_nivel';

    public function providers(){
        return $this->belongsToMany(Provider::class);
    }

}
