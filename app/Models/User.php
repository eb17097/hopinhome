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
        'phone',
        'phone_verified_at',
        'password',
        'role',
        'profile_photo_url',
        'two_factor_auth',
        'bio',
        'region',
        'language',
        'currency',
        'measurement_unit',
        'onboarding_step',
        'onboarding_completed',
        'setup_checklist_completed',
        'business_owner_id',
        'status',
        'listing_limit',
        'boost_limit',
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

    public function isBusinessOwner(): bool
    {
        return $this->role === 'business_owner';
    }

    public function isBusinessAgent(): bool
    {
        return $this->role === 'business_agent';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the agents for the business owner.
     */
    public function agents()
    {
        return $this->hasMany(User::class, 'business_owner_id');
    }

    /**
     * Get the business owner for the agent.
     */
    public function businessOwner()
    {
        return $this->belongsTo(User::class, 'business_owner_id');
    }

    /**
     * Get the profile photo URL, handling full URLs (S3/Google) and local paths.
     */
    public function getProfilePhotoUrl(): string
    {
        if (!$this->profile_photo_url) {
            return asset('images/user-placeholder.svg');
        }

        // If it's already a full URL (S3, Google, etc.), return it as is
        if (filter_var($this->profile_photo_url, FILTER_VALIDATE_URL)) {
            return $this->profile_photo_url;
        }

        // Fallback for relative paths: resolve through S3 disk
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($this->profile_photo_url);
    }
}
