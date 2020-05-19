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
     * Show Task Dashboard
     */
    public function list()
    {
        // If we wanna return data without sorting
        // 'tasks' => Task::all();
        //return view('dashboard', ['tasks' => DB::table('tasks')->where('user_id', auth()->user()->id)->orderBy('created_at')->get()]);
        return view('dashboard', ['categories' => DB::table('categories')->where('user_id', auth()->user()->id)->get()]);
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
        $task->name = request('name');
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
        $task->update(request()->validate([
            'name' => 'required|max:255',
        ]));
        return redirect('/home');
    }

    /**
     * Delete Task
     */
    public function delete(Task $task)
    {
        //$task = Task::findOrFail($task);
        $task->delete();
        return redirect('/home');
    }
}
