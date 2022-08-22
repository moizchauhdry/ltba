<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','phone','status','password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'admin_permissions');
    }

    public function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    public function getAdminPermissions() {
        $perm = '';
        foreach ($this->permissions as $permission) {
            $perm .=$permission->name .", ";
        }
        return rtrim(trim($perm), ',');
    }
}
