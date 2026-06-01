<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        $category = Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(4),
        ]);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Category',
            'entity_id' => $category->id,
            'action' => 'create',
            'before' => null,
            'after' => $category->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Category created.');
    }

    public function update(Request $request, Category $category)
    {
        $before = $category->toArray();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
        ]);

        $category->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(4),
        ]);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Category',
            'entity_id' => $category->id,
            'action' => 'update',
            'before' => $before,
            'after' => $category->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Category updated.');
    }

    public function destroy(Request $request, Category $category)
    {
        $before = $category->toArray();
        $id = $category->id;

        $category->delete();

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Category',
            'entity_id' => $id,
            'action' => 'delete',
            'before' => $before,
            'after' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Category deleted.');
    }
}