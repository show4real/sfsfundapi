<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Jobs\TaskJob;


class ApproverController extends Controller
{
    public function tasks(Request $request){

       $tasks = Task::where('approver_id', auth()->user()->id) 
       ->paginate($request->rows, ['*'], 'page', $request->page);
        
        return response()->json(compact('tasks'));
    }

    public function users(Request $request){

       $users = User::paginate($request->rows, ['*'], 'page', $request->page);
        
        return response()->json(compact('users'));
    }

    public function approve(Request $request, Task $task){
        $approve = $request->approve;

        $task->update(['approve' => $approve]);

        if ($approve == 1) {
            TaskJob::dispatch($task);
        }

        return response()->json(compact('task'));
    }

}
