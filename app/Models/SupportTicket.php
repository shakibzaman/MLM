<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'support_tickets';

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
                  'title',
                  'description',
                  'status',
                  'is_active',
                  'user_id',
        'department'
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

    public function answers(){

        return $this->hasMany(SupportTicketAnswer::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }


}
