<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_token', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    public function canDo($permission, $require = false)
    {
        if (is_array($permission)) {
            foreach ($permission as $permName) {

                $permName = $this->canDo($permName);
                if ($permName && !$require) {
                    return true;
                } else if (!$permName && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->permissions as $perm) {
                if (str_is($permission, $perm->name)) {
                    return true;
                }
            }
            return false;
        }
    }
}
