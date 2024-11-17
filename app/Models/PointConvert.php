<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointConvert extends Model
{
    use HasFactory;
    protected $fillable = ['point', 'doller', 'customer_id', 'status', 'status_change_by', 'status_change_date'];

    public function changeby()
    {
        return $this->belongsTo(User::class, 'status_change_by', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
