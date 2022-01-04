<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Notifications\PasswordResetNotification;

class User extends Authenticatable
{
    use Notifiable;

    //use SoftDeleteと記述することでSoftDeleteトレイトを使用すると宣言する。
    use SoftDeletes;

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

    //メンバ変数＄datesにdeleted_atをセットすることでモデル側で論理削除をできるようにする。
    //5.7まではprotected $dates = [‘deleted_at’];の記述が必要だったが、5.8からは「SoftDeletesトレイトは自動的にdeleted_at属性をDateTime/Carbonインスタンスへ変換します。」ので不要。
    //protected $dates = ['deleted_at']; //追記

    /**
     * Override to send for password reset notification.
     *
     * @param [type] $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    public function phrases(){
        return $this->hasMany("App\Phrase");
    }

    public function events(){
        return $this->hasMany("App\Event");
    }
}
