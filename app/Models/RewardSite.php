<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardSite extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reward_sites';

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
        'name',
        'url',
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

    public function reward_type()
    {
        return $this->hasMany(RewardSubmitType::class);
    }
}
