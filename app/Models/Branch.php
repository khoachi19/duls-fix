<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

     public function district()
    {
        return $this->hasMany(District::class);
    }
}
