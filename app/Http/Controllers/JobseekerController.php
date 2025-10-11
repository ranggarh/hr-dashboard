<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobseekerController extends Controller
{
    public function index()
    {
        $jobseekers = User::where('role', 'Jobseeker')->get();
        return view('jobseeker.index', compact('jobseekers'));
    }

    public function show($id)
    {
        $jobseeker = User::findOrFail($id);
        return view('jobseeker.show', compact('jobseeker'));
    }

    public function destroy($id)
    {
        $jobseeker = User::findOrFail($id);
        $jobseeker->delete();

        return redirect()->route('jobseekers.index')->with('success', 'Jobseeker berhasil dihapus!');
    }
}
