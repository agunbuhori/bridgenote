<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'item_name',
        'client_id',
        'quantity'
    ];
    public $timestamps = false;
}
