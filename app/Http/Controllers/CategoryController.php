<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{

    /**
     * Show Task Dashboard
     */
    public function list()
    {
        // If we wanna return data without sorting
        // 'tasks' => Task::all();
        //return view('dashboard', ['tasks' => DB::table('tasks')->where('user_id', auth()->user()->id)->orderBy('created_at')->get()]);
        return view('dashboard', [
            'categories' => DB::table('categories')->where('user_id', auth()->user()->id)->get(),
            'tasks' => DB::table('tasks')->get()
        ]);
    }

    /**
     * Add New Category
     */
    public function create()
    {
        //* Long way
        $validator = request()->validate([
            'name' => 'required|max:60',
        ]);
        $category = new Category();
        $category->name = ucwords(request('name'));
        $category->color = request('color');
        $category->user_id =  auth()->user()->id;
        $category->save();

        //* Better way
        /* Category::create(request()->validate([
            'name' => 'required|max:255',
        ])); */

        return redirect('/home');
    }

    /**
     * Delete Category
     */
    public function delete(Category $category)
    {
        //$Category = Category::findOrFail($Category);
        $category->delete();
        return redirect('/home');
    }
}
