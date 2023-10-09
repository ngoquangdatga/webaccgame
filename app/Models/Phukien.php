<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phukien extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'phukien';
    protected $fillable =[
        'title','status'
    ];
}
