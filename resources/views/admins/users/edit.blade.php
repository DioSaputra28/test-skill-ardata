@extends('admins.layouts.main')

@section('title', 'Edit Pengguna - Admin Dashboard')
@section('page', 'users')

@section('content')
<div class="p-4 mx-auto max-w-screen-2xl md:p-6">

    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
            Edit Pengguna
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('admin.dashboard') }}">Dashboard /</a>
                </li>
                <li>
                    <a class="font-medium text-gray-500 dark:text-gray-400" href="{{ route('user.index') }}">Pengguna /</a>
                </li>
                <li class="font-medium text-primary">Edit</li>
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

    <form action="{{ route('user.update', $user->user_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Informasi Pengguna
                </h3>

                <div class="flex items-center gap-2">
                    <a href="{{ route('user.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 8H2M2 8L6 4M2 8L6 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 7L10 14L6 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Update Pengguna
                    </button>
                </div>
            </div>

            <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                <!-- User Avatar Preview -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center overflow-hidden shadow-lg">
                            @if(isset($user->avatar) && $user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-white font-semibold text-2xl" id="avatar-initials">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User ID Info -->
                <div class="text-center">
                    <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                        <i class="fa-solid fa-id-badge"></i>
                        ID Pengguna: #{{ $user->user_id }}
                    </span>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Terdaftar sejak {{ $user->created_at->format('d F Y') }}
                    </p>
                </div>

                <!-- Form Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div>
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
                                value="{{ old('name', $user->name) }}"
                                placeholder="Masukkan nama lengkap pengguna"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('name') border-error-500 @enderror"
                                required />
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                        @enderror
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
                                value="{{ old('email', $user->email) }}"
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
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-medium text-gray-800 dark:text-white">Ubah Password</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            <i class="fa-solid fa-info-circle"></i>
                            Kosongkan jika tidak ingin mengubah password
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- New Password Field -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Password Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-gray-400"></i>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="Minimal 6 karakter (opsional)"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('password') border-error-500 @enderror" />
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
                                    <span id="password-strength-text" class="text-xs text-gray-500 dark:text-gray-400 hidden">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock-open text-gray-400"></i>
                                </div>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Ulangi password baru"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent pl-10 pr-10 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
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


                <!-- Warning Message -->
                @if($user->user_id === auth()->id())
                <div class="rounded-lg bg-warning-50 dark:bg-warning-500/10 p-4 border border-warning-200 dark:border-warning-500/30">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-warning-500 mt-0.5"></i>
                        <div>
                            <h4 class="text-sm font-medium text-warning-800 dark:text-warning-400">Perhatian!</h4>
                            <p class="mt-1 text-xs text-warning-700 dark:text-warning-300">
                                Anda sedang mengedit akun Anda sendiri. Perubahan email atau password akan memerlukan login ulang.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <a href="{{ route('user.show', $user->user_id) }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 transition rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white transition rounded-lg bg-brand-500 hover:bg-brand-600">
                        <i class="fa-solid fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>

@push('scripts')
<script>
    // Toggle password visibility
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

    // Update avatar initials based on name input
    document.getElementById('name').addEventListener('input', function(e) {
        const initials = e.target.value.split(' ').map(word => word[0]).join('').toUpperCase().slice(0, 2) || '{{ strtoupper(substr($user->name, 0, 2)) }}';
        const avatarElement = document.getElementById('avatar-initials');
        if (avatarElement) {
            avatarElement.textContent = initials;
        }
    });

    // Password strength checker
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.getElementById('password-strength');
        const strengthText = document.getElementById('password-strength-text');
        
        if (password.length === 0) {
            strengthBar.style.width = '0%';
            strengthText.classList.add('hidden');
            checkPasswordMatch();
            return;
        }
        
        strengthText.classList.remove('hidden');
        
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

    // Check password match
    document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
    
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const matchIndicator = document.getElementById('password-match');
        
        if (!password || !confirmation) {
            matchIndicator.classList.add('hidden');
            return;
        }
        
        if (password === confirmation) {
            matchIndicator.classList.remove('hidden');
            matchIndicator.querySelector('i').className = 'fa-solid fa-check-circle text-success-500';
            matchIndicator.querySelector('span').textContent = 'Password cocok';
            matchIndicator.querySelector('p').className = 'text-xs flex items-center gap-1 text-success-500';
        } else {
            matchIndicator.classList.remove('hidden');
            matchIndicator.querySelector('i').className = 'fa-solid fa-times-circle text-error-500';
            matchIndicator.querySelector('span').textContent = 'Password tidak cocok';
            matchIndicator.querySelector('p').className = 'text-xs flex items-center gap-1 text-error-500';
        }
    }
</script>
@endpush

@endsection
