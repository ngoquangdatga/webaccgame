<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable =[
        'title','description','images','status','order_category'
    ];
    public function phukien(){
        return $this->belongsTo(Phukien::class);
    }
    public function nick(){
        return $this->hasMany(Nick::class);
    }
}
