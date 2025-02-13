<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashBoardModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable Eloquent's timestamps
    
    protected $table = 'tbl_expense'; 

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'categories_id', 'id');
    }
   
  
   



}
