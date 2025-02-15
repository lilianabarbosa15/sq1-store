<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="wrapper py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden ring-1 ring-black/5 sm:rounded">
                            <table class="w-full divide-y divide-gray-300">
                                <thead class="bg-primary-200 bg-opacity-20">
                                <tr>
                                    <th scope="col" class="px-[clamp(4px,1vw,12px)] py-[clamp(10px,1.5vw,14px)] text-left text-[clamp(11px,1.1vw,14px)] font-semibold text-gray-900">
                                        {{__('Date')}}</th>
                                    <th scope="col" class="px-[clamp(4px,1vw,12px)] py-[clamp(10px,1.5vw,14px)] text-left text-[clamp(11px,1.1vw,14px)] font-semibold text-gray-900 hidden 3md:block">
                                        {{__('Address')}}</th>
                                    <th scope="col" class="px-[clamp(4px,1vw,12px)] py-[clamp(10px,1.5vw,14px)] text-left text-[clamp(11px,1.1vw,14px)] font-semibold text-gray-900">
                                        {{__('Payment Method')}}</th>
                                    <th scope="col" class="px-[clamp(4px,1vw,12px)] py-[clamp(10px,1.5vw,14px)] text-left text-[clamp(11px,1.1vw,14px)] font-semibold text-gray-900">
                                        {{__('Price')}}</th>
                                    <th scope="col" class="px-[clamp(4px,1vw,12px)] py-[clamp(10px,1.5vw,14px)] text-left text-[clamp(11px,1.1vw,14px)] font-semibold text-gray-900">
                                        {{__('Status')}}</th>
                                    <th scope="col" class="relative py-[clamp(10px,1.5vw,14px)] pr-4 pl-3 sm:pr-6">
                                        <span class="sr-only">{{__('Acciones')}}</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="px-[clamp(4px,1vw,12px)] py-[clamp(6px,1vw,12px)] text-[clamp(10px,1.1vw,14px)] whitespace-nowrap text-gray-500">
                                                <!-- For screens smaller than the "sm" breakpoint, show only the date -->
                                                <span class="block sm:hidden"> {{ $order->created_at->format('Y-m-d') }} </span>
                                                <!-- For screens "sm" and up, show the full date and time -->
                                                <span class="hidden sm:block"> {{ $order->created_at->format('Y-m-d H:i:s') }} </span>
                                            </td>
                                            <td class="px-[clamp(4px,1vw,12px)] py-[clamp(6px,1vw,12px)] text-[clamp(10px,1.1vw,14px)] whitespace-nowrap text-gray-500 hidden 3md:block">{{$order->shipping_address}} </td>
                                            <td class="px-[clamp(4px,1vw,12px)] py-[clamp(6px,1vw,12px)] text-[clamp(10px,1.1vw,14px)] whitespace-nowrap text-gray-500">{{$order->payment_method}} </td>
                                            <td class="px-[clamp(4px,1vw,12px)] py-[clamp(6px,1vw,12px)] text-[clamp(10px,1.1vw,14px)] whitespace-nowrap text-gray-500">{{$order->total_amount}} </td>
                                            <td class="px-[clamp(4px,1vw,12px)] py-[clamp(6px,1vw,12px)] text-[clamp(10px,1.1vw,14px)] whitespace-nowrap text-gray-500">{{$order->order_status}} </td>
                                            <td class="relative py-[clamp(6px,1vw,12px)] pr-4 pl-3 text-right text-[clamp(10px,1.1vw,14px)] font-medium whitespace-nowrap sm:pr-6">
                                                <!-- Use type="button" to avoid form submission -->
                                                <div x-data="{ modalOpen: false }">
                                                    <!-- Button to display the items-list -->
                                                    <button type="button" 
                                                            class="text-primary-400 hover:text-primary-600 flex items-center justify-center"
                                                            x-on:click="modalOpen = true">
                                                            {{ __('View details') }}
                                                    </button>

                                                    <!-- Order Items Modal -->
                                                    <x-modules.order.items-list :order="$order" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-10">
                            {{ $orders->links('vendor.pagination.custom-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
