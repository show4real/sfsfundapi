<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function create(Request $request){
        return Department::create([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
