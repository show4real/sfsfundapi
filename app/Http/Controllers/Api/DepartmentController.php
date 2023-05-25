<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;;

class DepartmentController extends Controller
{
    public function index(Request $request){
        $departments= Department::get();
         return response()->json(compact('departments'));
    }
    public function create(Request $request){
        return Department::create([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
