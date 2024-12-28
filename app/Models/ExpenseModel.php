<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpenseUsage; 

class ExpenseModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable Eloquent's timestamps

    public function usages()
    {
        return $this->hasMany(ExpenseUsage::class, 'expense_id');
    }


    protected $table = 'tbl_expense'; // Make sure the table name matches
    protected $fillable = [
        'categories_id',
        'user_id',
        'budget',
        'budget_balance',
        'description',
        'attachment',
        'status',
        'assign',
        'date',
        'reference_number',
    ];


}
