<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex-1 flex flex-col justify-center items-center gap-y-6 sm:gap-y-10 m-2">

    <div class="border-2 rounded-md p-3 sm:p-8 w-full max-w-md grid gap-y-4 sm:gap-y-8">
        <h1 class="text-center bg-gradient-to-r from-red-600 to-gray-200 bg-clip-text text-transparent text-4xl font-bold leading-relaxed">
            {{ __('Sign up') }}
        </h1>

        <form wire:submit="register">
            <!-- Name -->
            <div>
                <x-utilities.input-label for="name" :value="__('Name')" />
                <x-utilities.text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                <x-utilities.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-utilities.input-label for="email" :value="__('Email')" />
                <x-utilities.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                <x-utilities.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-utilities.input-label for="password" :value="__('Password')" />
                <x-utilities.text-input wire:model="password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-utilities.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-utilities.input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-utilities.text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-utilities.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-primary-600" href="{{ route('login') }}" wire:navigate>
                    {{ __('Already registered?') }}
                </a>

                <x-global.buttons.primary class="ms-4">
                    {{ __('Register') }}
                </x-global.buttons.primary>
            </div>
        </form>
    </div>
</div>
