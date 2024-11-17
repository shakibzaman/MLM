<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'description',
        'payment_through',
        'transaction_id',
        'amount',
        't_type',
        'type'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
