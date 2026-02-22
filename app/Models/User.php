<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'role',
        'profile_photo_url',
        'two_factor_auth',
        'bio',
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
            'two_factor_auth' => 'boolean',
        ];
    }

    /**
     * Get the listings for the user.
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * Get the notification settings for the user.
     */
    public function notificationSettings()
    {
        return $this->hasOne(UserNotificationSetting::class)->withDefault([
            'push_enabled' => false,
            'email_enabled' => false,
            'marketing_enabled' => false,
            'announcements_enabled' => false,
            'newsletter_enabled' => false,
        ]);
    }

    public function isRenter(): bool
    {
        return $this->role === 'renter';
    }

    public function isPropertyManager(): bool
    {
        return $this->role === 'property_manager';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
