<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CreatorCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('creator.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if ($category->save()) {
            return to_route('creator.categories')->with('success', 'Kategori berhasil ditambahkan.');
        } else {
            return to_route('creator.categories')->with('error', 'Gagal menambahkan Kategori.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;

        if ($category->save()) {
            return redirect()->route('creator.categories')->with('success', 'Kategori berhasil diperbarui.');
        } else {
            return redirect()->route('creator.categories')->with('error', 'Gagal memperbarui Kategori.');
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->delete()) {
            return to_route('creator.categories')->with('success', 'Kategori berhasil dihapus.');
        } else {
            return to_route('creator.categories')->with('error', 'Gagal menghapus Kategori.');
        }
    }
}
