<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        $quests = Question::all();
        return view('creator.index', compact('tests', 'quests'));
    }
}
