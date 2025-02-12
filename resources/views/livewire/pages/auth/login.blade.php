<?php

use App\Livewire\Auth\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex-1 flex flex-col justify-center items-center gap-y-6 sm:gap-y-10 m-2">
    <!-- Session Status -->
    <x-modules.auth.session-status class="mb-4" :status="session('status')" />

    <div class="border-2 rounded-md p-3 sm:p-8 w-full max-w-md grid gap-y-4 sm:gap-y-8">
        <h1 class="text-center bg-gradient-to-r from-red-600 to-gray-200 bg-clip-text text-transparent text-4xl font-bold leading-relaxed">
            {{ __('Sign in') }}
        </h1>

        <form wire:submit="login" class="w-full max-w-md">
            <!-- Email Address -->
            <div>
                <x-utilities.input-label for="email" :value="__('Email')" />
                <x-utilities.text-input wire:model="form.email" id="email" class="block mt-1 w-full" 
                                type="email" 
                                name="email" 
                                required autofocus autocomplete="username" />
                <x-utilities.input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-utilities.input-label for="password" :value="__('Password')" />
                <x-utilities.text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-utilities.input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-600" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-primary-600" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-global.buttons.primary class="ms-3">
                    {{ __('Log in') }}
                </x-global.buttons.primary>
            </div>
        </form>
    </div>

    <!-- Register -->
    <p>
        {{ __("Don't have an account?") }}
        <a class="text-primary-400 hover:text-primary-600 hover:underline" href="{{ route('register') }}" wire:navigate>
            {{ __('SignUp') }}
        </a>
    </p>

</div>
