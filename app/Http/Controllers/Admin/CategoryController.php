<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller
{
    public static function middleware(): array
    {
         return [
        new Middleware('permission:view categories', ['index']),
        new Middleware('permission:create categories', ['create','store']),
        new Middleware('permission:edit categories', ['edit','update']),
        new Middleware('permission:delete categories', ['destroy']),
    ];
    }

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create([
    'name' => $request->name,
    'is_active' => $request->has('is_active'),
]);
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
{
    return view('admin.categories.edit', compact('category'));
}

public function update(Request $request, Category $category)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'is_active' => 'nullable|boolean',
    ]);

    $data['is_active'] = $request->has('is_active');

    $category->update($data);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category updated successfully');
}


    public function destroy(Category $category)
{
    // Optional safety check
    if ($category->products()->exists()) {
        return back()->with('error', 'Cannot delete category with products.');
    }

    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category archived successfully');
}
}
