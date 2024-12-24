<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RoleModel;

class PermissionModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_permissions';
    protected $fillable = [
        'name',
    ];
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'tbl_permission_role', 'permission_id', 'role_id');
    }
}
