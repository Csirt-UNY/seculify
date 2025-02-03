<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Question;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserTestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('user.tests.index', compact('tests'));
    }

    public function start($id)
    {
        $test_id = Crypt::decrypt($id);
        $attempt = new Attempt();
        $attempt->user_id = Auth::user()->id;
        $attempt->test_id = $test_id;
        $attempt->status = 'on_going';
        if ($attempt->save()) {
            $questions = Question::where('test_id', $test_id)->get();
            foreach ($questions as $question) {
                $score = new Score();
                $score->attempt_id = $attempt->id;
                $score->question_id = $question->id;
                $score->user_id = Auth::user()->id;
                $score->save();
            }
            return to_route('user.doTest', Crypt::encrypt($attempt->id));
        } else {
            return redirect()->back()->with('error', 'Gagal memulai tes');
        }
    }

    public function doTest($id)
    {
        $attempt_id = Crypt::decrypt($id);
        $attempt = Attempt::find($attempt_id);
        if(isset($attempt) && $attempt->status == 'on_going') {
            $test = $attempt->test;
            $scores = $attempt->scores;
            $done = $scores->where('is_done', 1)->count();
            $is_finish = $scores->where('is_done', 1)->count() == $scores->count();
            return view('user.questions.index', compact('test', 'scores', 'done', 'is_finish'));
        } else {
            return redirect()->back()->with('error', 'Tes tidak ditemukan atau Anda sudah menyelsaikan tes ini');
        }
    }

    public function answer($score_id, $answer)
    {
        $score = Score::find($score_id);
        $score->answer = $answer;
        $score->is_correct = $answer == $score->question->is_phising ? 1 : 0;
        $score->is_done = true;

        if  ($score->save()) {
            return redirect()->back()->with('success', 'Jawaban berhasil disimpan');
        } else {
            return redirect()->back()->with('success', 'Jawaban berhasil disimpan');
        }
    }

    public function finish($attempt_id) {
        $attempt = Attempt::findOrFail($attempt_id);
        $attempt->status = 'completed';
        if ($attempt->save()) {
            return to_route('user.attempts')->with('success', 'Tes selesai');
        } else {
            return redirect()->back()->with('error', 'Gagal menyelesaikan tes');
        }
    }

    public function attempts()
    {
        $attempts = auth()->user()->attempts->sortByDesc('created_at');
        return view('user.attempts.index', compact('attempts'));
    }

    public function showAttempts($attempt_id)
    {
        $id = Crypt::decrypt($attempt_id);
        if (auth()->user()->attempts->contains($id)) {
            $attempt = Attempt::findOrFail($id);

            if ($attempt->status == 'completed') {
                $corrects = $attempt->scores->where('attempt_id', $attempt->id)->where('is_correct', 1)->count();
                $totals = $attempt->scores->where('attempt_id', $attempt->id)->count();
                $grade = ($corrects/$totals)*100;

                return view('user.attempts.show', compact('attempt', 'corrects', 'totals', 'grade'));
            } else {
                return to_route('user.tests')->with('error', 'Anda belum menyelesaikan tes ini');
            }
        } else {
            return to_route('user.attempts')->with('error', 'Anda tidak memiliki akses ke tes ini');
        }
    }
}
