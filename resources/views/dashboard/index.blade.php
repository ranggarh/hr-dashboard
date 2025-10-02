@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-bold">Jobseeker</h3>
        <p>{{ $jobseekerCount }} terdaftar</p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-bold">Assessment</h3>
        <p>{{ $assessmentCount }} test</p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-bold">Proses Recruitment</h3>
        <p>{{ $progressCount }} berjalan</p>
    </div>
</div>
@endsection
