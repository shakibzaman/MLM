<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyCoupon extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'coupon_id', 'coupon_point', 'status', 'status_change_by', 'status_change_date'];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
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
