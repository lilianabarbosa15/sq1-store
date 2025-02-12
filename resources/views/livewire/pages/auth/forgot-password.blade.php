<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="flex-1 flex flex-col justify-center items-center m-2 sm:mx-0">
    <div class="sm:bg-gray-50 sm:p-4 flex flex-col justify-center items-center w-full">
        <div class="mb-4 text-sm text-gray-600 w-full max-w-md">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-modules.auth.session-status class="mb-4" :status="session('status')" />

        <form wire:submit="sendPasswordResetLink" class="w-full max-w-md">
            <!-- Email Address -->
            <div>
                <x-utilities.input-label for="email" :value="__('Email')" />
                <x-utilities.text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                <x-utilities.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-global.buttons.primary>
                    {{ __('Email Password Reset Link') }}
                </x-global.buttons.primary>
            </div>
        </form>
    </div>
</div>
