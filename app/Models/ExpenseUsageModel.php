<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseUsageModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable Eloquent's timestamps
    protected $table = 'tbl_expense_usage'; // Make sure the table name matches


    public function expenses()
    {
        return $this->hasMany(ExpenseModel::class, 'expense_id');
    }







}

