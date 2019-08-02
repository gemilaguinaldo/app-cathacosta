<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
    	'amount',
    	'entry_date',
    	'note',
    	'status'
    ];

    protected $appends = [
    	'category_name',
    	'expense_status'
    ];

    // Relationship
    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    // Attributes
    public function getCategoryNameAttribute()
    {
    	  return $this->categories->name;
    }

    public function getExpenseStatusAttribute()
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
