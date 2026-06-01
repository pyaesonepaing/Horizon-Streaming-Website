<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function subscriptions()
{
    return $this->hasMany(\App\Models\Subscription::class);
}

public function activeSubscription()
{
    return $this->hasOne(\App\Models\Subscription::class)
        ->where('status', 'active')
        ->where('ends_at', '>', now())
        ->latestOfMany();
}

public function hasActiveSubscription(): bool
{
    return $this->activeSubscription()->exists();
}
public function currentSubscription()
{
    return $this->activeSubscription()->with('plan')->first();
}
public function downloads()
{
    return $this->hasMany(Download::class);
}
public function payments()
{
    return $this->hasMany(\App\Models\Payment::class);
}

public function pendingSubscription()
{
    return $this->hasOne(\App\Models\Subscription::class)
        ->where('status', 'pending')
        ->latestOfMany();
}
public function expiredSubscription()
{
    return $this->hasOne(\App\Models\Subscription::class)
        ->where('status', 'expired')
        ->orWhere('ends_at', '<=', now());
}


public function adminLogs()
{
    return $this->hasMany(AdminActivityLog::class, 'admin_user_id');
}
}
