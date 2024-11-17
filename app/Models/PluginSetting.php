<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PluginSetting extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plugin_settings';

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
        'status',
        'tawk_property_id',
        'tawk_widget_id',
        'google_recaptcha_key',
        'google_recaptcha_secret',
        'google_analytics_id',
        'fb_page_id',
        'pusher_app_id',
        'pusher_app_key',
        'pusher_secret',
        'pusher_cluster'
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
     * Get the tawkProperty for this model.
     *
     * @return App\Models\TawkProperty
     */
}
