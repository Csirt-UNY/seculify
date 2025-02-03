<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use Illuminate\Http\Request;

class AdminAttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::all();
        return view('admin.attempts.index', compact('attempts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $attempt = Attempt::findOrFail($id);
        $scores = $attempt->scores;
        return view('admin.attempts.show', compact('attempt', 'scores'));

    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $attempt = Attempt::findOrFail($id);
        if ($attempt->delete()) {
            return to_route('admin.attempts', $id)->with('success', 'Riwayat berhasil dihapus.');
        } else {
            return to_route('admin.attempts', $id)->with('error', 'Gagal menghapus Riwayat.');
        }
    }
}
