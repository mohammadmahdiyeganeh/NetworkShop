<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        $slug = Str::slug($request->name, '-');
        $originalSlug = $slug;
        $counter = 1;

        // اگر اسلاگ تکراری بود → switch-2, switch-3
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'دسته‌بندی با موفقیت اضافه شد.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $slug = Str::slug($request->name, '-');
        $originalSlug = $slug;
        $counter = 1;

        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'این دسته‌بندی شامل محصول است و قابل حذف نیست.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}