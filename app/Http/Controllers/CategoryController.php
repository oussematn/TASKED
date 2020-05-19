<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
