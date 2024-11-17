<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\AdminResetPassword;
use Illuminate\Auth\Notifications\ResetPassword;
use Locale;
use Spatie\Activitylog\Models\Activity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'status',
        'type',
        'locale',
        'avatar',
        'email_verified_at',
        'password_reset_code',
        'temp_new_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'admin.password.reset')); // Custom route name
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'country_id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'causer_id')->orderBy('id', 'desc');
    }
}
