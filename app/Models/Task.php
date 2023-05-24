<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title','user_id','approve','completed','approver_id'];

    protected $appends = ['approver_name', 'approver_email','sender'];

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    

     public function getApproverNameAttribute()
    {
        $approver = User::where('approver',1)
        ->where('department_id', $this->user->department_id)
        ->first();
        return $approver->name ?? null;
    }

     public function getApproverEmailAttribute()
    {
        $approver = User::where('approver',1)
        ->where('department_id', $this->user->department_id)
        ->first();
        return $approverç->email ?? null;
    }

     public function getSenderAttribute()
    {
        return $this->user->name ?? null;
    }

}
