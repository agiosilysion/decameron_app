<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "hoteles";
    protected $fillable = ['nombre', 'direccion', 'ciudad', 'nit', 'numero_habitaciones'];
}
