<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-[#2DC5A2] rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-teal-200">
                <svg class="w-8 h-8 fill-white" viewBox="0 0 24 24">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-800">NigaStore</h1>
            <p class="text-gray-400 text-sm mt-1 font-medium">Masuk ke akun Anda</p>
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
                autofocus
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
                autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me + Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-[#2DC5A2] focus:ring-[#2DC5A2]"
                    name="remember"
                />
                <span class="text-sm text-gray-500 font-medium">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-[#2DC5A2] font-semibold hover:text-[#1FA88A] transition-colors">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full bg-[#2DC5A2] hover:bg-[#1FA88A] active:bg-[#1a9478] text-white font-bold py-3 rounded-xl transition-colors duration-200 shadow-md shadow-teal-200 text-sm">
            {{ __('Masuk') }}
        </button>

        <!-- Register Link -->
        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-400 mt-5">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[#2DC5A2] font-semibold hover:text-[#1FA88A] transition-colors">
                    Daftar sekarang
                </a>
            </p>
        @endif

    </form>
</x-guest-layout>