<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceModel extends Model
{
    use HasFactory;
    public $timestamps = false; 

    protected $table = 'tbl_reference'; 
    protected $fillable = [
        'id','type','value',
    ];

}
