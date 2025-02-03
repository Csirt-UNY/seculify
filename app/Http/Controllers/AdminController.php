<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $tests = Test::all();
        $quests = Question::all();
        $attempts = Attempt::all();
        return view('admin.index', compact('users', 'tests', 'quests', 'attempts'));
    }
}
