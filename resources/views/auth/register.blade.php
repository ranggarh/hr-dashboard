@extends('layouts.guest')
@section('title', 'Register')

@section('content')
<div class="flex bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full">
    <!-- Left: Image -->
    <div class="hidden md:flex md:w-1/2 bg-blue-100 items-center justify-center">
        <img src="https://source.unsplash.com/400x400/?office,team" alt="Register" class="object-cover h-80 w-full">
    </div>
    <!-- Right: Form -->
    <div class="w-full md:w-1/2 p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Daftar Akun</h2>
        @if($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name') }}">
            </div>
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('email') }}">
            </div>
            <div>
                <label class="block text-gray-700">Nomor HP</label>
                <input type="text" name="phone" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('phone') }}">
            </div>
            <div>
                <label class="block text-gray-700">Role</label>
                <select name="role" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Pilih Role</option>
                    <option value="Jobseeker" {{ old('role') == 'Jobseeker' ? 'selected' : '' }}>Jobseeker</option>
                    <option value="HR" {{ old('role') == 'HR' ? 'selected' : '' }}>HR</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition">Daftar</button>
            <p class="text-sm mt-2 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
        </form>
    </div>
</div>
@endsection