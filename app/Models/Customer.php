<?php

namespace App\Models;

use App\Notifications\CustomerVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomerResetPassword;
use Illuminate\Auth\Notifications\ResetPassword;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;
    public $redirectToRoute = 'user.verification.notice';
    //    protected $guard_name = 'customer';
    //
    protected $guard = 'customer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'user_id',
        'email',
        'phone',
        'password',
        'status',
        'reference_user',
        'lifetime_package',
        'monthly_package',
        'remember_token',
        'balance',
        'address',
        'country_id',
        'zip',
        'city',
        'email_verified_at',
        'document_verified',
        'monthly_package_enrolled_at',
        'monthly_package_status',
        'two_factor_code',
        'auth_2fa',
        'ip_address',
        'two_factor_code_expire_at',
        'init_lifetime_package',
        'reward_point',
        'unique_id',
        'image',
        'total_income',
        'enroll_date',
        'rank',
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

    public function leader()
    {
        return $this->belongsTo(Customer::class, 'reference_user');
    }
    public function kyc()
    {
        return $this->belongsTo(Kyc::class, 'id', 'customer_id');
    }

    public function lifetimePackage()
    {
        return $this->belongsTo(LifetimePackage::class, 'lifetime_package');
    }

    public function monthlyPackage()
    {
        return $this->belongsTo(MonthlyPackage::class, 'monthly_package');
    }

    public function subscribers()
    {
        return $this->hasMany(Customer::class, 'reference_user');
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'causer')->orderBy('id', 'desc');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomerVerifyEmail);
    }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new CustomerResetPassword($token));
    // }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'customer.password.reset')); // Custom route name
    }

    public function rewards()
    {
        return $this->hasMany(RewardLog::class);
    }

    public function calculateMonthlyReward($customer_monthly_income = 0)
    {

        $rewardAmount = MonthlyReward::where('month', date('m'))->first()->reward_amount;

        $totalmonthlyearning = SalesStatement::whereMonth('created_at', Carbon::now()->month)->where('t_type', 1)->sum('amount');

        $customermonthlyearning = $customer_monthly_income;

        $reward = ($rewardAmount / $totalmonthlyearning) * $customermonthlyearning;

        return $reward;
    }

    public function incomes()
    {
        return $this->hasMany(SalesStatement::class)->where('t_type', 1);
    }

    public function inlifetimePackage()
    {
        return $this->belongsTo(LifetimePackage::class, 'init_lifetime_package');
    }

    public function ranking()
    {
        return $this->belongsTo(RankReward::class, 'rank');
    }
}
