<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $filled=[
        'id',
        'name',
    ] ;
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
