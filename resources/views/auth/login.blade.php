@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<div class="flex bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl w-full">
    <!-- Left: Image -->
    <div class="hidden md:flex md:w-1/2 bg-blue-100 items-center justify-center">
        <img src="https://source.unsplash.com/400x400/?work,people" alt="Login" class="object-cover h-80 w-full">
    </div>
    <!-- Right: Form -->
    <div class="w-full md:w-1/2 p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Masuk Akun</h2>
        @if($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required autofocus class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('email') }}">
            </div>
            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition">Login</button>
            <p class="text-sm mt-2 text-center">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a></p>
        </form>
    </div>
</div>
@endsection