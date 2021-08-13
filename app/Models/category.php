<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $guarded=[];
    function parent(){
    return $this->belongsTo(category::class, 'category_id');
    }
}
