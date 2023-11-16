<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
