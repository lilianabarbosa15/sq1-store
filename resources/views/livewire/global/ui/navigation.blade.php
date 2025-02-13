<?php

use App\Livewire\Auth\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-3 md:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/sq1-logo.svg')}}" width="110" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 md:space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-global.links.nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-global.links.nav-link>
                    <x-global.links.nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-global.links.nav-link>
                    <x-global.links.nav-link :href="route('orders')" :active="request()->routeIs('orders')" wire:navigate>
                        {{ __('Orders') }}
                    </x-global.links.nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-global.navigation.dropdown align="right" width="30">
                    <x-slot name="trigger">
                        <button class="inline-flex items-end pl-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                aria-label="User menu" aria-haspopup="true">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" 
                                x-text="name" 
                                x-on:profile-updated.window="name = $event.detail.name">
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-global.links.dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-global.links.dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-global.links.dropdown-link>
                                {{ __('Log Out') }}
                            </x-global.links.dropdown-link>
                        </button>
                    </x-slot>
                </x-global.navigation.dropdown>
            </div>

            <!-- Button of the Dropdown Menu -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center hover:text-primary-500 hover:bg-gray-100 p-2 rounded-md text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Dropdown Menu) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-global.links.responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-global.links.responsive-nav-link>

                <x-global.links.responsive-nav-link :href="route('orders')" :active="request()->routeIs('orders')" wire:navigate>
                    {{ __('Orders') }}
                </x-global.links.responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-global.links.responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-global.links.responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
