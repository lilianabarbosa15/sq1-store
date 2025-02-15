<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="wrapper py-12">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden ring-1 shadow-sm ring-black/5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        {{__('Date')}}</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        {{__('Address')}}</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        {{__('Payment Method')}}</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        {{__('Price')}}</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        {{__('Status')}}</th>
                                    <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6">
                                        <span class="sr-only">{{__('Acciones')}}</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{$order->created_at}} </td>
                                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{$order->shipping_address}} </td>
                                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{$order->payment_method}} </td>
                                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{$order->total_amount}} </td>
                                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">{{$order->order_status}} </td>
                                            <td class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                                <a href="#" class="text-primary-400 hover:text-primary-600">
                                                    {{__('Ver orden')}}
                                                </a>
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
