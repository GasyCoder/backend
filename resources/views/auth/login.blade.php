@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="px-8 pt-6 pb-8 mb-4 bg-white rounded-lg shadow-md">
    <h2 class="mb-6 text-2xl font-bold text-center">Administration</h2>

    @if (session('error'))
        <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                Email
            </label>
            <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                   id="email"
                   type="email"
                   name="email"
                   required>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                Mot de passe
            </label>
            <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                   id="password"
                   type="password"
                   name="password"
                   required>
        </div>

        <div class="flex items-center justify-between">
            <button class="px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:shadow-outline"
                    type="submit">
                Se connecter
            </button>
        </div>
    </form>
</div>
@endsection
