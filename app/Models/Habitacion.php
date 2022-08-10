<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "habitaciones";
    protected $fillable = ['cantidad'];

    public function hoteles()
    {
        return $this->hasMany(Hotel::class);
    }

    public function tipoHabitaciones()
    {
        return $this->hasMany(TipoHabitacion::class);
    }

    public function acomodaciones()
    {
        return $this->hasOne(Acomodacion::class);
    }
}
