<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the assessments.
     */
    public function index()
    {
        $assessments = Assessment::with('questions')->orderBy('created_at', 'desc')->get();
        
        return view('assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new assessment.
     */
    public function create()
    {
        return view('assessments.create');
    }

    /**
     * Store a newly created assessment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|in:technical,personality,cognitive',
            'duration' => 'nullable|integer|min:1',
            'questions_count' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Assessment::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'duration' => $request->duration,
            'questions_count' => $request->questions_count ?? 0,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('assessments.index')->with('success', 'Assessment berhasil ditambahkan!');
    }

    /**
     * Display the specified assessment.
     */
    public function show(Assessment $assessment)
    {
        $assessment->load('questions.answers');
        return view('assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified assessment.
     */
    public function edit(Assessment $assessment)
    {
        return view('assessments.edit', compact('assessment'));
    }

    /**
     * Update the specified assessment in storage.
     */
    public function update(Request $request, Assessment $assessment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|in:technical,personality,cognitive',
            'duration' => 'nullable|integer|min:1',
            'questions_count' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $assessment->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'duration' => $request->duration,
            'questions_count' => $request->questions_count,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('assessments.show', $assessment)->with('success', 'Assessment berhasil diupdate!');
    }

    /**
     * Remove the specified assessment from storage.
     */
    public function destroy(Assessment $assessment)
    {
        $assessment->delete();
        return redirect()->route('assessments.index')->with('success', 'Assessment berhasil dihapus!');
    }
}