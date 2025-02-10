<x-guest-layout :navBackground="'bg-white'">
    <livewire:products.product-page :product="$product" wire:key="product-{{ $product->id }}" />
</x-guest-layout>
