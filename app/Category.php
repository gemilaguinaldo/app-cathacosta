<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name',
    	'description',
    	'status'
    ];

    protected $appends = [
      'category_status'
    ];


    // Relation
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    // Attributes
    public function getCategoryStatusAttribute()
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
