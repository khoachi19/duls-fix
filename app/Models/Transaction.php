<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'shipping_id',
        'branch_id',
        'district_id',
        'invoice',  
        'address',
        'total',
        'status',
        'snap_token',
    ];

     public function TransactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
     public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
     public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
     public function district()
    {
        return $this->belongsTo(District::class);
    }

}
