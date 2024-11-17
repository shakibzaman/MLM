<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardTypeMapping extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reward_type_mappings';

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
                  'reward_site_id',
                  'reward_submit_type_id',
                  'reward_amount',
                  'is_active'
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
     * Get the rewardSite for this model.
     *
     * @return App\Models\RewardSite
     */
    public function rewardSite()
    {
        return $this->belongsTo('App\Models\RewardSite','reward_site_id');
    }

    /**
     * Get the rewardSubmitType for this model.
     *
     * @return App\Models\RewardSubmitType
     */
    public function rewardSubmitType()
    {
        return $this->belongsTo('App\Models\RewardSubmitType','reward_submit_type_id');
    }



}
