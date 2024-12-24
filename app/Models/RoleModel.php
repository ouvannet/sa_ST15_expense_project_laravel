<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UserModel;
use App\Models\PermissionModel;


class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_role';
    // public $timestamps = false;
    protected $fillable = [
        'name',
    ];
    
    public function users()
    {
        return $this->hasMany(UserModel::class, 'role_id', 'id');
    }
    public function permissions()
    {
        // return $this->belongsToMany(PermissionModel::class,'role_id','id');
        return $this->belongsToMany(PermissionModel::class, 'tbl_permission_role', 'role_id', 'permission_id');
    }
}
