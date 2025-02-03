<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class CreatorQuestionController extends Controller
{
    public function index($test)
    {
        $quests = Question::where('test_id', $test)->get();
        $allTests = Test::all();
        $categories = Category::all();
        return view('creator.questions.index', compact('quests', 'test', 'allTests', 'categories'));
    }

    public function store(Request $request, $test)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'question_content' => 'nullable',
            'proof' => 'nullable',
            'is_phising' => 'required|in:true,false',
            'category_id' => 'required|exists:categories,id',
        ]);

        $quest = new Question();
        $quest->title = $request->title;
        $quest->description = $request->description;
        $quest->question_content = $request->question_content;
        $quest->proof = $request->proof;
        $quest->is_phising = $request->is_phising == 'true' ? 1 : 0;
        $quest->test_id = $test;
        $quest->category_id = $request->category_id;

        // if ($request->has('image')) {
        //     $img_name = 'quests' . '_' . str_replace(' ', '_', $request->name) . '_' . $request->file('image')->hashName();
        //     $request->file('image')->storeAs('public/quests/', $img_name);
        //     $quest->image = $img_name;
        // }

        if ($quest->save()) {
            return to_route('creator.quests', ['test' => $test])->with('success', 'Pertanyaan berhasil ditambahkan.');
        } else {
            return to_route('creator.quests', ['test' => $test])->with('error', 'Gagal menambahkan Pertanyaan.');
        }
    }

    public function update(Request $request, $test, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'question_content' => 'nullable',
            // 'image' => 'nullable|mimes:jpg,jpeg,png',
            'proof' => 'nullable',
            'is_phising' => 'required|in:true,false',
            'category_id' => 'required|exists:categories,id',
        ]);

        $quest = Question::findOrFail($id);
        $quest->title = $request->title;
        $quest->description = $request->description;
        $quest->question_content = $request->question_content;
        $quest->proof = $request->proof;
        $quest->is_phising = $request->is_phising === "true" ? 1 : 0;
        $quest->test_id = $test;
        $quest->category_id = $request->category_id;

        // if ($request->has('image')) {
        //     $img_name = 'quests' . '_' . str_replace(' ', '_', $request->name) . '_' . $request->file('image')->hashName();
        //     $request->file('image')->storeAs('public/quests/', $img_name);
        //     $quest->image = $img_name;
        // }

        if ($quest->save()) {
            return redirect()->route('creator.quests', ['test' => $test])->with('success', 'Pertanyaan berhasil diperbarui.');
        } else {
            return redirect()->route('creator.quests', ['test' => $test])->with('error', 'Gagal memperbarui pertanyaan.');
        }
    }

    public function destroy($test, $id)
    {
        $quest = Question::findOrFail($id);
        if ($quest->delete()) {
            return to_route('creator.quests', ['test' => $test])->with('success', 'Pertanyaan berhasil dihapus.');
        } else {
            return to_route('creator.quests', ['test' => $test])->with('error', 'Gagal menghapus Pertanyaan.');
        }
    }
}
