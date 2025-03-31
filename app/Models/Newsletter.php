<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Newsletter extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['email', 'verification_code', 'verified_at'];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($newsletter) {
            $newsletter->verification_code = Str::random(6);
        });
    }

    public function isVerified()
    {
        return $this->verified_at !== null;
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
