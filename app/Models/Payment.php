<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
      'payment_type',
      'payment_for_id',
      'customer_id',
      'amount',
      'gateway',
      'status',
      'paymentable_type',
      'paymentable_id',
      'transaction_id'
      ];


//  public function paymentable()
//  {
//    return $this->morphTo();
//  }
}
