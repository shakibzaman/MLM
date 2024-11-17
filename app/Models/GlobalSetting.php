<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'global_settings';

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
                  'site_logo',
                  'site_fevicon',
                  'admin_login_cover',
                  'site_admin_prefix',
                  'site_currency_type',
                  'site_currency',
                  'timezon',
                  'referral_type',
                  'currency_symbol',
                  'referral_code_Limit',
                  'home_redirect',
                  'site_title',
                  'site_email',
                  'support_email'
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
