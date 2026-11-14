<x-guest-layout>
    <div style="padding: 2.5rem; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); border: 1px solid #f3f4f6;">
        
        <!-- Ikon Avatar Profil di Atas Form -->
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center border border-gray-300">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700 mb-1" />
                <x-text-input id="email" class="block w-full rounded-lg border-gray-300 p-3 border shadow-xs" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="owner@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700 mb-1" />
                <x-text-input id="password" class="block w-full rounded-lg border-gray-300 p-3 border shadow-xs" type="password" name="password" required autocomplete="current-password" placeholder="••••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-sm pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-xs focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-gray-600 hover:text-gray-900 font-medium" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <div class="pt-3">
                <button type="submit" style="background-color: #1e293b; color: #ffffff; padding: 12px; border-radius: 10px; font-weight: bold; width: 100%; border: none; cursor: pointer;">
                    LOG IN
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>