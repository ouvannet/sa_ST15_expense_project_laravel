<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable Eloquent's timestamps
    
    protected $table = 'tbl_recurring_expense'; // Make sure the table name matches

    // protected $fillable = [
    //     'category_id',
    //     'user_id',
    //     'amount',
    //     'frequency',
    //     'start_date',
    //     'next_run_date',
    //     'status'
    // ];

    protected $guarded = [];
    public function expense()
    {
        return $this->belongsTo(ExpenseModel::class, 'expense_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }



}
