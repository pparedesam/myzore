<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function sexo(){
        return $this->belongsTo(Sexo::class);
    }

    public function estadoCivil(){
        return $this->belongsTo(EstadoCivil::class);
    }

}
