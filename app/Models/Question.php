<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'question_content',
        'is_phising',
        'image',
        'proof',
        'test_id'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
