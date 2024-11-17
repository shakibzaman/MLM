<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_settings';

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
        'min_password_length',
        'max_password_length',
        'password_for_withdraw',
        'confirm_code_account_update',
        'notify_status',
        'subscription_type',
        'password_for_edit_profile',
        'email_change_status',
        'subscription_status',
        'subscription_grace_period'
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
     * Set the password_for_withdraw.
     *
     * @param  string  $value
     * @return void
     */
}
