<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {

        $categories = Category::with("questions")->get();


        return response()->json($categories);
    }

    public function getCategory(Category $category)
    {
        return $category;
    }

    public function addCategory(Request $request)
    {;

        $category = new Category();
        $category->title = $request->title;
        $category->game_id = $request->game_id;
        $category->save();

        return redirect()->back();
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title' => 'required|unique:categories,title'
        ]);

        $category->update($validated);

        return redirect('/set/' . $category->game_id);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }

    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }
}
