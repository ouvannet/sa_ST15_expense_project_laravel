<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable Eloquent's timestamps
    
    protected $table = 'tbl_categories'; // Make sure the table name matches
    protected $fillable = ['name', 'description'];
}
