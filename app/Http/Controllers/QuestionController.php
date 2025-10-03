<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Store a newly created question in storage.
     */
    public function index(Assessment $assessment)
    {
        $assessment->load('questions.answers');
        return view('questions.index', compact('assessment'));
    }
    public function store(Request $request, Assessment $assessment)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,essay,true_false,short_answer',
            'image' => 'nullable|image|max:2048',
            'answers' => 'required|array|min:1',
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'nullable|boolean'
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('questions', 'public');
        }

        $question = $assessment->questions()->create([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'is_required' => false,
            'order' => $assessment->questions()->count() + 1,
            'image' => $imagePath
        ]);

        // Simpan jawaban
        foreach ($request->answers as $index => $answerData) {
            $question->answers()->create([
                'answer_text' => $answerData['answer_text'],
                'is_correct' => isset($answerData['is_correct']) ? true : false,
                'order' => $index + 1
            ]);
        }

        // Update questions count
        $assessment->update([
            'questions_count' => $assessment->questions()->count()
        ]);

        return redirect()->route('questions.index', $assessment->id)->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,essay,true_false,short_answer',
            'is_required' => 'boolean',
            'answers' => 'array',
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'boolean'
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'is_required' => $request->has('is_required')
        ]);

        // Update answers
        if ($request->has('answers')) {
            // Delete existing answers
            $question->answers()->delete();

            // Create new answers
            foreach ($request->answers as $index => $answerData) {
                $question->answers()->create([
                    'answer_text' => $answerData['answer_text'],
                    'is_correct' => isset($answerData['is_correct']) ? true : false,
                    'order' => $index + 1
                ]);
            }
        }

        return redirect()->route('assessments.show', $question->assessment)->with('success', 'Pertanyaan berhasil diupdate!');
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy(Question $question)
    {
        $assessment = $question->assessment;
        $question->delete();

        // Update questions count
        $assessment->update([
            'questions_count' => $assessment->questions()->count()
        ]);

        return redirect()->route('assessments.show', $assessment)->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
