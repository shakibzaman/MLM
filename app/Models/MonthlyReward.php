<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyReward extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'monthly_rewards';

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
                  'month',
                  'reward_amount',
                  'year',
                  'disburse_status'
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




}
