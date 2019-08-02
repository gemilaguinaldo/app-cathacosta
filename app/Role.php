<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
       'name',
       'display_name',
       'description',
       'status'
   	];

    protected $appends = [
      'role_status',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
      return $this->belongsToMany(Permission::class);
    }

    // Attributes
    public function getRoleStatusAttribute()
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
    
}
