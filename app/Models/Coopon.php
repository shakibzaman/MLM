<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coopon extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coopons';

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
                  'coopon',
                  'expire_date',
                  'is_active'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
      'expire_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    /**
     * Set the expire_date.
     *
     * @param  string  $value
     * @return void
     */
//    public function setExpireDateAttribute($value)
//    {
//        $this->attributes['expire_date'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y', $value) : null;
//    }

    /**
     * Get expire_date in array format
     *
     * @param  string  $value
     * @return array
     */
//    public function getExpireDateAttribute($value)
//    {
//        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y');
//    }

}
