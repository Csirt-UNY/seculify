<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class AdminTestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('admin.tests.index', compact('tests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'proof' => 'required',
            'level' => 'required|in:mudah,sedang,sulit'
        ]);

        $test = new Test();
        $test->title = $request->title;
        $test->description = $request->description;
        $test->level = $request->level;

        if ($request->has('image')) {
            $img_name = 'tests' . '_' . str_replace(' ', '_', $request->name) . '_' . $request->file('image')->hashName();
            $request->file('image')->storeAs('public/tests/', $img_name);
            $test->image = $img_name;
        }

        if ($test->save()) {
            return to_route('admin.tests')->with('success', 'Tes berhasil ditambahkan.');
        } else {
            return to_route('admin.tests')->with('error', 'Gagal menambahkan Tes.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'level' => 'required|in:mudah,sedang,sulit'
        ]);
        
        $test = Test::findOrFail($id);
        $test->title = $request->title;
        $test->description = $request->description;
        $test->level = $request->level;

        if ($request->has('image')) {
            $img_name = 'tests' . '_' . str_replace(' ', '_', $request->name) . '_' . $request->file('image')->hashName();
            $request->file('image')->storeAs('public/tests/', $img_name);
            $test->image = $img_name;
        }

        if ($test->save()) {
            return redirect()->route('admin.tests')->with('success', 'Tes berhasil diperbarui.');
        } else {
            return redirect()->route('admin.tests')->with('error', 'Gagal memperbarui Tes.');
        }
    }

    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        if ($test->delete()) {
            return to_route('admin.tests')->with('success', 'Tes berhasil dihapus.');
        } else {
            return to_route('admin.tests')->with('error', 'Gagal menghapus Tes.');
        }
    }
}
