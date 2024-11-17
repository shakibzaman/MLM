<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'reward_type',
        'amount',
        'description'
    ];

    public function customer(){
      return $this->belongsTo(Customer::class);
    }
}
