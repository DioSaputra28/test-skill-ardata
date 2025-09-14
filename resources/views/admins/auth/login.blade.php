<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <style>
        /* Small helper to ensure card doesn't stretch full height in some themes */
        .card-max {
            max-width: 420px;
        }
    </style>
</head>

<body>
    <div class="bg-gray-50 dark:bg-gray-900">

        <div class="min-h-screen flex items-center justify-center px-4">
            <div class="card-max w-full">
                <div class="bg-white dark:bg-gray-800 shadow rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
                    <div class="mb-4 text-center">
                        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Masuk</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan email dan password Anda</p>
                    </div>

                    <form method="POST" action="{{ route('prosesLogin') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 focus:ring-3 focus:ring-brand-500/10 focus:outline-none" />
                            @error('email')
                            <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                            <input id="password" name="password" type="password" required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-transparent px-4 py-2.5 text-sm text-gray-800 dark:text-white/90 placeholder:text-gray-400 focus:ring-3 focus:ring-brand-500/10 focus:outline-none" />
                            @error('password')
                            <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700" />
                                <span>Ingat saya</span>
                            </label>
                            <a href="#" class="text-brand-500 hover:underline">Lupa password?</a>
                        </div>

                        <div>
                            <button type="submit" class="w-full inline-flex items-center justify-center rounded-lg bg-brand-600 hover:bg-brand-700 text-white px-4 py-2.5 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20">Masuk</button>
                        </div>
                    </form>

                    <div class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                        Belum punya akun? <a href="#" class="text-brand-500 hover:underline">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>