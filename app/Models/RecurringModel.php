<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable Eloquent's timestamps
    
    protected $table = 'tbl_recurring_expense'; // Make sure the table name matches

   

    protected $guarded = [];
    public function expense()
    {
        return $this->belongsTo(ExpenseModel::class, 'expense_id', 'id');
    }




}
