<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchase_requests';

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
                  'request_type',
                  'user_id',
                  'status',
                  'purchasable_type',
                  'purchasable_id'
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
     * Get the user for this model.
     *
     *
     */
    public function user()
    {
        return $this->belongsTo(Customer::class,'user_id');
    }

    public function purchasable()
    {
      return $this->morphTo();
    }

    public function transactions()
    {
      return $this->morphMany(Transaction::class, 'transactionable');
    }



}
