<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $filled=[
        'title',
        'body',
        'category_id',
    ] ;
public function categories(){
    return $this->belongsTo(category::class);
}
public function user(){
    return $this->belongsTo(User::class);
}
public function comments(){
    return $this->belongsTo(Comment::class);
}
}
