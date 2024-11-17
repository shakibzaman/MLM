<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kycs';

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
        'customer_id',
        'document_type',
        'document_number',
        'image',
        'status'
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
     * Get the customer for this model.
     *
     * @return App\Models\Customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function histories()
    {
        return $this->hasMany(KycHistory::class, 'kyc_id', 'id')->orderBy('id', 'desc');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($kyc) {
            $kyc->customer_id = Auth::guard('customer')->user()->id;
            $kyc->status = 'pending';
        });
    }
}
