<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'name',
        'user_role',
        'user_status',
        'is_admin'
    ];

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    // Attributes
    public function getUserRoleAttribute()
    {
        return $this->role->display_name;
    }

    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getUserStatusAttribute()
    {
        switch ($this->status) {
            case 0:
              $status = 'Inactive';
                break;
            case 1:
              $status = 'Active';
                break;
            default:
               $status = 'Active';
                break;
        }
        return $status;
    }

    public function getIsAdminAttribute()
    {
        ($this->role->name == 'Administrator') ? $isAdmin = true : $isAdmin = false;
        return $isAdmin;
    }
}
