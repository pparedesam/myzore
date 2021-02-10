<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaJuridica extends Model
{
    protected $table='personasjuridicas';
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function setRazonSocialAttribute($value)
    {
        $this->attributes['razonSocial'] = strtoupper($value);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

}
