<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Add New Task
     */
    public function create()
    {
        //* Long way
        $validator = request()->validate([
            'name' => 'required|max:255',
        ]);
        $task = new Task();
        $task->name = ucfirst(request('name'));
        $task->user_id =  auth()->user()->id;
        $task->category_id =  request('category');
        $task->save();

        //* Better way
        /* Task::create(request()->validate([
            'name' => 'required|max:255',
        ])); */

        return redirect('/home');
    }

    /**
     * Edit a Task
     */
    public function edit(Task $task /* $task */)
    {
        //$task = Task::findOrFail($task);
        /* $task->name = request('name');
        $task->save();
        */
        $validator = request()->validate([
            'name' => 'required|max:255',
        ]);
        $new = ucfirst(request('name'));
        $task->update(['name' => $new]);
        return;
    }

    /**
     * Delete Task
     */
    public function delete(Task $task)
    {
        //$task = Task::findOrFail($task);
        $task->delete();
        return;
    }

    /**
     * Change Category
     */

    public function changeCat()
    {
        $task = Task::findOrFail(request('task'));
        $task->category_id = request()->input('category');
        $task->save();
        return $task;
    }
}
