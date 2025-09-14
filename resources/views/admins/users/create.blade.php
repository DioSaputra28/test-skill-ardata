@extends('admins.layouts.main')

@section('title', 'Tambah Pengguna - Admin Dashboard')
@section('page', 'users')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Tambah Pengguna Baru
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('user.index') }}">Pengguna /</a>
                </li>
                <li class="font-medium text-primary">Tambah</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- Alert for Errors -->
    @if ($errors->any())
    <div class="mb-6 rounded-lg border-l-4 border-error-500 bg-error-50 p-4 dark:bg-error-500/10">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <i class="fa-solid fa-circle-exclamation text-xl text-error-500"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-medium text-error-800 dark:text-error-400">Ada kesalahan dalam formulir:</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-error-600 dark:text-error-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Informasi Pengguna
                </h3>

                <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Simpan Pengguna
                </button>
            </div>

            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <!-- User Avatar Preview -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center overflow-hidden shadow-lg">
                            <span class="text-white font-semibold text-2xl" id="avatar-initials">PN</span>
                        </div>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div class="lg:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nama Lengkap <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-user text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap pengguna"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('name') border-error-500 @enderror"
                                required />
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Nama akan ditampilkan di profil pengguna
                        </p>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Alamat Email <span class="text-error-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400"></i>
                            </div>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="contoh@email.com"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('email') border-error-500 @enderror"
                                required />
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password Section -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h4 class="text-sm font-medium text-gray-800 dark:text-white mb-4">Keamanan Akun</h4>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Password Field -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Password <span class="text-error-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-gray-400"></i>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="Minimal 6 karakter"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('password') border-error-500 @enderror"
                                    required />
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="password-icon" class="fa-solid fa-eye-slash text-gray-400 hover:text-gray-600 transition"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                            @enderror
                            <div class="mt-2">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div id="password-strength" class="h-full transition-all duration-300" style="width: 0%"></div>
                                    </div>
                                    <span id="password-strength-text" class="text-xs text-gray-500 dark:text-gray-400">Lemah</span>
                                </div>
                            </div>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Konfirmasi Password <span class="text-error-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock-open text-gray-400"></i>
                                </div>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Ulangi password"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    required />
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="password_confirmation-icon" class="fa-solid fa-eye-slash text-gray-400 hover:text-gray-600 transition"></i>
                                </button>
                            </div>
                            <div id="password-match" class="mt-1 hidden">
                                <p class="text-xs flex items-center gap-1">
                                    <i class="fa-solid fa-check-circle"></i>
                                    <span>Password cocok</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="rounded-lg bg-info-50 dark:bg-info-500/10 p-4 border border-info-200 dark:border-info-500/30">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-info-500 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-medium text-info-800 dark:text-info-400">Tips Keamanan Password:</h4>
                            <ul class="mt-2 space-y-1 text-xs text-info-700 dark:text-info-300">
                                <li>• Gunakan minimal 6 karakter</li>
                                <li>• Kombinasikan huruf besar, huruf kecil, dan angka</li>
                                <li>• Tambahkan karakter khusus untuk keamanan ekstra</li>
                                <li>• Hindari menggunakan informasi pribadi yang mudah ditebak</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <a href="{{ route('user.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                        <i class="fa-solid fa-save mr-2"></i>
                        Simpan Pengguna
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>

@push('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    document.getElementById('name').addEventListener('input', function(e) {
        const initials = e.target.value.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2) || 'PN';
        document.getElementById('avatar-initials').textContent = initials;
    });

    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('password-strength');
        const strengthText = document.getElementById('password-strength-text');
        
        let strength = 0;
        if (password.length >= 6) strength++;
        if (password.length >= 10) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        
        const percentage = (strength / 5) * 100;
        strengthBar.style.width = percentage + '%';
        
        if (strength <= 2) {
            strengthBar.className = 'h-full bg-error-500 transition-all duration-300';
            strengthText.textContent = 'Lemah';
            strengthText.className = 'text-xs text-error-500';
        } else if (strength <= 3) {
            strengthBar.className = 'h-full bg-warning-500 transition-all duration-300';
            strengthText.textContent = 'Sedang';
            strengthText.className = 'text-xs text-warning-500';
        } else {
            strengthBar.className = 'h-full bg-success-500 transition-all duration-300';
            strengthText.textContent = 'Kuat';
            strengthText.className = 'text-xs text-success-500';
        }
        
        checkPasswordMatch();
    });

    document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
    
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const matchIndicator = document.getElementById('password-match');
        
        if (confirmation && password === confirmation) {
            matchIndicator.classList.remove('hidden');
            matchIndicator.querySelector('i').className = 'fa-solid fa-check-circle text-success-500';
            matchIndicator.querySelector('span').textContent = 'Password cocok';
            matchIndicator.querySelector('p').className = 'text-xs flex items-center gap-1 text-success-500';
        } else if (confirmation) {
            matchIndicator.classList.remove('hidden');
            matchIndicator.querySelector('i').className = 'fa-solid fa-times-circle text-error-500';
            matchIndicator.querySelector('span').textContent = 'Password tidak cocok';
            matchIndicator.querySelector('p').className = 'text-xs flex items-center gap-1 text-error-500';
        } else {
            matchIndicator.classList.add('hidden');
        }
    }
</script>
@endpush

@endsection
