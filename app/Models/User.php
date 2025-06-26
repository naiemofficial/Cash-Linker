<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'password',
        'user_role_id'
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
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id')->first()->name;
    }


    public function orders($props = [])
    {
        $orders = $this->role() === 'administrator' ? Order::query() : $this->hasMany(Order::class);

        if(isset($props['withTrashed']) && boolval($props['withTrashed']) === true){
            $orders = $orders->withTrashed();
        }
        if(isset($props['onlyTrashed']) && boolval($props['onlyTrashed']) === true){
            $orders = $orders->onlyTrashed();
        }

        return $orders->orderBy('created_at', 'desc');
    }

}
