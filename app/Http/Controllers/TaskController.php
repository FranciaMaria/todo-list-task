<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{

    public function __construct() {

        $this->middleware('auth');

    }

        public function index()
    {
        $tasks = Task::where(['user_id' => Auth::user()->id])->get();
        return response()->json([
            'tasks'    => $tasks,
        ], 200);
    }

        public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'required',
        ]);

        $task = Task::create([
            'name'        => request('name'),
            'description' => request('description'),
            'user_id'     => Auth::user()->id
        ]);

        return response()->json([
            'task'    => $task,
            'message' => 'Success'
        ], 200);
    }

    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'name'        => 'required|max:255',
            'description' => 'required',
        ]);

        $task->name = request('name');
        $task->description = request('description');
        $task->save();

        return response()->json([
            'message' => 'Task updated successfully!'
        ], 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        //return 204;
        return $task;
    }

}
