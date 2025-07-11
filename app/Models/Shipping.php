<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['nama_kurir', 'harga_kurir'];

  
}