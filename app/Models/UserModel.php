<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleModel;
use App\Models\DepartmentModel;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_user';
    // public $timestamps = false;
    protected $fillable = [
        'name',
        'gender',
        'dob',
        'email',
        'phone',
        'password',
        'department_id',
        'role_id',
    ];
    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'department_id', 'id');
    }
    public function hasPermission($permissionName)
    {
        return $this->role->permissions->contains('name', $permissionName);
    }

    public function assignedExpenses()
    {
        return $this->hasMany(ExpenseModel::class, 'assign', 'id');
    }

}
