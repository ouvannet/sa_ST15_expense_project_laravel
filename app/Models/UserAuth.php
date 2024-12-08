<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\RoleModel;

class UserAuth extends Authenticatable
{
    use Notifiable;

    // Specify the custom table name
    protected $table = 'tbl_user';

    // Specify the primary key if it is not "id"
    protected $primaryKey = 'id'; // Update this if your primary key is different

    // Disable auto-incrementing if the primary key is non-integer
    public $incrementing = true;

    // Specify the key type if the primary key is not an integer
    protected $keyType = 'int';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password', // Ensure the field names match your database columns
    ];

    // Hide attributes from being exposed in arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }
    public function hasPermission()
    {
        return $this->role->permissions->pluck('name')->toArray();
    }
}
