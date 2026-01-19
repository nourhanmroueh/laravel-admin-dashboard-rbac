<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\RedirectResponse;
use App\Models\SoftDeletes;

class ProductController extends Controller
{
    /**
     * Laravel 12 middleware definition
     */
   public static function middleware(): array
{
    return [
        new Middleware('permission:view products', ['index','show']),
        new Middleware('permission:create products', ['create','store']),
        new Middleware('permission:edit products', ['edit','update']),
        new Middleware('permission:delete products', [
            'destroy',
            'trashed',
            'restore',
            'forceDelete',
        ]),
    ];
}


    public function index(Request $request)
{
    $query = Product::with('category');

    // 🔍 Search by name
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 🔹 Filter by category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 🔹 Filter by status
    if ($request->filled('status')) {
        if ($request->status === 'active') {
            $query->where('is_active', true);
        } elseif ($request->status === 'inactive') {
            $query->where('is_active', false);
        }
    }

    $products = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $categories = \App\Models\Category::where('is_active', true)->get();

    return view('admin.products.index', compact('products', 'categories'));
}


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
      $categories = Category::where('is_active', true)->get();

    return view('admin.products.create', compact( 'categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'category_id' => $request->category_id, // ✅ REQUIRED
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product created successfully');
}


    public function edit(Product $product)
    {
         $categories = Category::all();


    return view('admin.products.edit', compact('product', 'categories'));
    }

   public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'category_id' => $request->category_id, // ✅ REQUIRED
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully');
}

    public function destroy(Product $product)
{
    $product->delete();

    return redirect()->route('admin.products.index')
        ->with('success','Product archived');
}
public function trashed()
{
    $products = Product::onlyTrashed()
        ->with('category')
        ->latest()
        ->paginate(10);

    return view('admin.products.trashed', compact('products'));
}

public function restore(int $id): RedirectResponse
{
    $product = Product::onlyTrashed()->findOrFail($id);
    $product->restore();

    return redirect()->route('admin.products.trashed')
        ->with('success', 'Product restored successfully');
}

public function forceDelete(int $id): RedirectResponse
{
    $product = Product::onlyTrashed()->findOrFail($id);
    $product->forceDelete();

    return redirect()->route('admin.products.trashed')
        ->with('success', 'Product permanently deleted');
}




}
