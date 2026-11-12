<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('events')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($this->validateCategory($request));
        return redirect()->route('categories.index')->with('success', 'Catégorie créée!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($this->validateCategory($request, $category));
        return redirect()->route('categories.index')->with('success', 'Catégorie modifiée!');
    }

    public function destroy(Category $category)
    {
        abort_if($category->events()->count() > 0, 422, 'Impossible de supprimer une catégorie avec des événements.');
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée!');
    }

    private function validateCategory(Request $request, ?Category $category = null): array
    {
        $uniqueRule = 'unique:CJ_categories,CJ_name';
        if ($category) {
            $uniqueRule .= ',' . $category->CJ_id . ',CJ_id';
        }

        return $request->validate([
            'CJ_name' => 'required|string|max:255|' . $uniqueRule,
            'CJ_description' => 'nullable|string',
        ]);
    }
}
