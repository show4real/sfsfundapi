<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Jobs\TaskJob;


class TaskController extends Controller
{
    public function myTasks(Request $request){

       $tasks = Task::where('user_id', auth()->user()->id) 
       ->paginate($request->rows, ['*'], 'page', $request->page);
        
        return response()->json(compact('tasks'));
    }

    public function create(Request $request){
        $approver = User::where('approver', 1)
            ->where('department_id', auth()->user()->department_id)
            ->first();

        $data = $request->only('title');
        $data['user_id'] = auth()->user()->id;
        $data['completed'] = $request->completed;
        $data['approver_id'] = $approver->id;

        $task = Task::create($data);

        if ($task->completed == 1) {
            TaskJob::dispatch($task);
        }
    }


    public function update(Request $request, Task $task)
    {
        $data = $request->only('title', 'completed');

        $task->update($data);

        if ($task->completed == 1) {
            TaskJob::dispatch($task);
        }

        return response()->json(compact('task'));
    }

    public function delete($id, Request $request){
        $task = Task::where('id', $id)->where('approve','!=',1)->first();
        if($task){
            $task->delete();
            return response()->json(true);
        }
        $error='not found';
        return response()->json(compact('error'),404);
       
    }

    
}

