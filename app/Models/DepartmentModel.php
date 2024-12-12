<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_department';
    public $timestamps = false; // Disable Eloquent's timestamps
 // Make sure the table name matches
    protected $fillable = ['name','description'];
}
