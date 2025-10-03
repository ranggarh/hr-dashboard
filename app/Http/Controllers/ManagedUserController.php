<?php

namespace App\Http\Controllers;

use App\Models\ManagedUser;
use App\Models\User;
use App\Models\Assessment;
use Illuminate\Http\Request;

class ManagedUserController extends Controller
{
    public function index(Assessment $assessment)
    {
        $managedUsers = ManagedUser::with('user')
            ->where('assessment_id', $assessment->id)
            ->get();

        // Ambil jobseeker yang belum terdaftar di assessment ini
        $jobseekers = \App\Models\User::where('role', 'Jobseeker')
            ->whereNotIn('id', ManagedUser::where('assessment_id', $assessment->id)->pluck('user_id'))
            ->get();

        return view('managed_users.index', compact('assessment', 'managedUsers', 'jobseekers'));
    }

    public function create(Assessment $assessment)
    {
        // Ambil user dengan role Jobseeker yang belum terdaftar di assessment ini
        $jobseekers = User::where('role', 'Jobseeker')
            ->whereNotIn('id', ManagedUser::where('assessment_id', $assessment->id)->pluck('user_id'))
            ->get();

        return view('managed_users.create', compact('assessment', 'jobseekers'));
    }

    public function store(Request $request, \App\Models\Assessment $assessment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        \App\Models\ManagedUser::create([
            'assessment_id' => $assessment->id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('managed-users.index', $assessment)->with('success', 'User berhasil ditambahkan ke assessment.');
    }

    // Metode lain seperti edit, update, destroy bisa ditambahkan sesuai kebutuhan
    public function destroy(Assessment $assessment, ManagedUser $managedUser)
    {
        $managedUser->delete();
        return redirect()->route('managed-users.index', $assessment)->with('success', 'User berhasil dihapus dari assessment.');
    }
}
