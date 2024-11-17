<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deposits';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash_id',
        'customer_id',
        'amount',
        'transaction_id',
        'gateway',
        'currency',
        'status',
        'status_change_by',
        'status_change_date',
        'payment_gateway_invoice_id',
        'payment_gateway_status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the hash for this model.
     *
     * @return App\Models\Hash
     */

    /**
     * Get the customer for this model.
     *
     * @return App\Models\Customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function changedby()
    {
        return $this->belongsTo(User::class, 'status_change_by', 'id');
    }

    /**
     * Get the transaction for this model.
     *
     * @return App\Models\Transaction
     */
}
