<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Department;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'approver',
        'department_id'
    ];

    protected $appends = ['department_name','role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // A user belongs to a department

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    

     public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }


    public function getDepartmentNameAttribute()
    {
        return $this->department->name ?? null;
    }

    public function getRoleAttribute()
    {
        return $this->approver == 1 ? 'Approver' : 'Staff';
    }


}
