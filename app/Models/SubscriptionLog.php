<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLog extends Model
{
    use HasFactory;

  protected $fillable = ['customer_id', 'membership_id', 'amount','expires_at'];

  public function customer(){
    return $this->belongsTo(Customer::class,'customer_id');
  }

  public function package(){
    return $this->belongsTo(LifetimePackage::class,'membership_id');
  }
}
