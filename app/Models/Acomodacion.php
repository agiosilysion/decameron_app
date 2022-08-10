<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acomodacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "acomodaciones";
    protected $fillable = ['tipo'];
}
