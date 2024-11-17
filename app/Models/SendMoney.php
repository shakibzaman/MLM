<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMoney extends Model
{
    use HasFactory;
    protected $fillable = ['sent_from', 'sent_to', 'amount', 'note', 'status', 'status_change_by', 'status_change_date'];

    public function receiver()
    {
        return $this->belongsTo(Customer::class, 'sent_to', 'id');
    }
    public function sender()
    {
        return $this->belongsTo(Customer::class, 'sent_from', 'id');
    }
    public function changeby()
    {
        return $this->belongsTo(Customer::class, 'status_change_by', 'id');
    }
}
