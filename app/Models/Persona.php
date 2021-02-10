<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function documento(){
        return $this->belongsTo(Documento::class);
    }

    public function personanatural(){
        return $this->hasOne(PersonaNatural::class);
    }

    public function personajuridica(){
        return $this->hasOne(PersonaJuridica::class);
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
}
