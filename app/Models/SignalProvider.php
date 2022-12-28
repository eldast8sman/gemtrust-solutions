<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SignalProvider extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'verify_token',
        'verify_token_expiry',
        'token',
        'token_expiry',
        'status'
    ];

    protected $hidden = [
        'password',
        'verify_token',
        'verify-token-expiry',
        'token',
        'token-expiry'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function update_dependencies(){
        if(!empty($signals = Signal::where('signal_provider_id', $this->id))){
            foreach($signals as $signal){
                $signal->name = $this->name;
                $signal->save();
            }
        }
    }
}
