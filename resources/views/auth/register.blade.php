<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-[#2DC5A2] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-teal-200">
                <svg class="w-8 h-8 fill-white" viewBox="0 0 24 24">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-800">TokoKu</h1>
            <p class="text-gray-400 text-sm mt-1 font-medium">Buat akun baru Anda</p>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-600 font-semibold text-sm mb-1.5" />
            <x-text-input
                id="name"
                class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-[#2DC5A2] focus:ring-[#2DC5A2] text-sm py-3 px-4 transition"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama lengkap Anda"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-600 font-semibold text-sm mb-1.5" />
            <x-text-input
                id="email"
                class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-[#2DC5A2] focus:ring-[#2DC5A2] text-sm py-3 px-4 transition"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="nama@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 font-semibold text-sm mb-1.5" />
            <x-text-input
                id="password"
                class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-[#2DC5A2] focus:ring-[#2DC5A2] text-sm py-3 px-4 transition"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-600 font-semibold text-sm mb-1.5" />
            <x-text-input
                id="password_confirmation"
                class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-[#2DC5A2] focus:ring-[#2DC5A2] text-sm py-3 px-4 transition"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full bg-[#2DC5A2] hover:bg-[#1FA88A] active:bg-[#1a9478] text-white font-bold py-3 rounded-xl transition-colors duration-200 shadow-md shadow-teal-200 text-sm">
            {{ __('Daftar Sekarang') }}
        </button>

        <!-- Login Link -->
        <p class="text-center text-sm text-gray-400 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[#2DC5A2] font-semibold hover:text-[#1FA88A] transition-colors">
                Masuk di sini
            </a>
        </p>

    </form>
</x-guest-layout>