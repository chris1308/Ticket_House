<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;
    
    public $timestamps = false; //kalo gaada ini otomatis dibuatkan createdAt dan updatedAt
    protected $guarded = [];
}
