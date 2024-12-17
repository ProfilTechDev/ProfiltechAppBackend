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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    protected $appends = ['first_name', 'last_name'];

    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name)[0];
    }

    public function getLastNameAttribute(): string
    {
        $exploded = explode(' ', $this->name);
        return array_pop($exploded);
    }

    public function emailNotificationSettings()
    {
        return $this->hasMany(EmailNotificationSettings::class);
    }

    public function wantsNotification($type)
    {
        $setting = $this->emailNotificationSettings()
            ->where('type', $type)
            ->first();

        if ($setting) {
            return $setting->value;
        }

        // Hvis der ikke er nogen indstilling, antag at brugeren ønsker notifikationen
        return true;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
