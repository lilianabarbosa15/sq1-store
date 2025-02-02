<x-guest-layout :navBackground="'bg-white'">
    <livewire:pages.product.product-page :product="$product" wire:key="product-{{ $product->id }}" />
</x-guest-layout>
