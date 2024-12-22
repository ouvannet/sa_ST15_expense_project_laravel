<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRoleModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'tbl_permission_role';
    protected $primaryKey = 'role_id'; 
    protected $fillable = [
        'permission_id',
        'role_id'
    ];
}
