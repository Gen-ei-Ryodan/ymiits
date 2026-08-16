@extends('layouts.login-simple')

@section('content')
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-lg border border-green-200">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-green-700">Login Admin</h1>
            <p class="text-sm text-gray-500 mt-1">Masukkan email dan password Anda</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-green-700">Email</label>
                <input id="email" type="email" name="email" required autofocus autocomplete="username"
                       class="w-full mt-1 border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-green-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full mt-1 border border-green-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <input id="remember_me" type="checkbox" name="remember"
                       class="text-green-600 border-green-300 focus:ring-green-400 rounded shadow-sm">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>

            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                Login
            </button>
        </form>
    </div>
@endsection
