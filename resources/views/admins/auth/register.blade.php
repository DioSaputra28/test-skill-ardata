@extends('admins.layouts.main')

@section('title', 'Register')
@section('page', 'auth')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow p-6">
        <h2 class="mb-6 text-center text-2xl font-extrabold text-gray-900">Buat Akun Admin</h2>

        @if($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/proses-register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Daftar</button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Masuk</a></p>
    </div>
</div>
@endsection
