<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_settings';

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
        'contact_person',
        'referral_link_identifier',
        'seo_title',
        'legal_name',
        'google_secret_key',
        'captcha_at_register',
        'address',
        'zip_code',
        'company_start_on',
        'country',
        'city',
        'phone',
        'email',
        'website',
        'meta_description',
        'google_analytic_key',
        'captcha_at_client_registration',
        'tagline',
        'google_site_key',
        'google_webmaster_tool_code',
        'captcha_at_admin_login',
        'we_accept_logo'
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
     * Set the captcha_at_register.
     *
     * @param  string  $value
     * @return void
     */
}
