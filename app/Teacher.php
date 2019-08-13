<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\TeacherResetPasswordNotification;
use App\Notifications\TeacherVerifyEmail;



use Spatie\Permission\Traits\HasRoles;


class Teacher extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    use HasRoles;

    protected $guard = 'teacher';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Relations 

    public function cv () {
        return $this->hasOne(Cv::class);
    }

    public function address () {
        return $this->hasOne(Address::class);
    }

    public function diplomas (){
        return $this->hasMany(Diploma::class);
    }



    //Password Reset
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TeacherResetPasswordNotification($token));
    }



    //Email Verification
    public function sendEmailVerificationNotification()
    {
        $this->notify(new TeacherVerifyEmail);
    }


    public function hasVerifiedEmail()
    {
        return ! is_null($this->email_verified_at);
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

}
