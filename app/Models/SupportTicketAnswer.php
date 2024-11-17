<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicketAnswer extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'support_ticket_answers';

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
                  'support_ticket_id',
                  'answer',
                  'user_id'
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
     * Get the supportTicket for this model.
     *
     * @return App\Models\SupportTicket
     */
    public function supportTicket()
    {
        return $this->belongsTo('App\Models\SupportTicket','support_ticket_id');
    }

    /**
     * Get the user for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }



}
