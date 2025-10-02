<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the assessments.
     */
    public function index()
    {
        // Untuk sementara kosong, nanti bisa diisi dengan data dari database
        $assessments = [];
        
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
        // Logic untuk menyimpan assessment
        return redirect()->route('assessments.index')->with('success', 'Assessment berhasil ditambahkan!');
    }
}