<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_products extends Model
{
    use HasFactory;
    protected $primaryKey='cartproduct_id';
    protected $fillable = [
        'quantity',
        
    ];
}
