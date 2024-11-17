<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraReward extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'reward_mapping_id', 'status', 'image', 'url', 'status_change_by', 'status_change_date'];

    public function reward_mapping()
    {
        return $this->belongsTo(RewardTypeMapping::class, 'reward_mapping_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function changeby()
    {
        return $this->belongsTo(User::class, 'status_change_by', 'id');
    }
}
