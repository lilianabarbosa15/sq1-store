<div class="mt-10">
    <!-- Forms of interaction -->
    <div class="flex py-4 text-sm xs:text-base gap-2 xs:gap-4 2md:gap-8 border-b border-b-[#EEEEEE]">
        @php
            $buttons = [
                ['icon' => 'compare', 'text' => __('Compare')],
                ['icon' => 'question-mark', 'text' => __('Ask a question')],
                ['icon' => 'share', 'text' => __('Share')],
            ];
        @endphp

        @foreach ($buttons as $button)
            <div class="flex justify-center items-center gap-1 xs:gap-2 border-b border-b-transparent hover:border-b-primary-600 hover:text-primary-600 hover:cursor-pointer">
                <x-dynamic-component :component="'global.svg.' . $button['icon']" />
                <p>{{ $button['text'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Delivery Dates and Free Shipping Policy -->
    <div class="grid py-6 gap-2 text-sm 2md:text-base">
        <div class="flex items-center gap-2">
            <x-global.svg.delivery />
            <p class="font-volkhov font-bold">{{__('Estimated Delivery:')}}</p>
            <span>Jul 30 - Aug 03</span>
        </div>
        <div class="flex items-center gap-2">
            <x-global.svg.shipping2 />
            <p class="font-volkhov font-bold">{{__('Free Shipping & Returns:')}}</p>
            <span class="font-volkhov">{{__('On all orders over $75')}}</span>
        </div>
    </div>
                
    <!-- Payments -->
    <div class="grid place-items-center gap-2 p-5 bg-primary-50 rounded-[5px]">
        <img src="{{ asset('images/payments.png') }}" width="320px" height="25.23px"
            alt="The image shows various payment logos including Visa, Mastercard, Amex, JCB, Discover, Diners Club, and UnionPay.">
        <p class="font-volkhov text-center">{{__('Guarantee safe & secure checkout')}}</p>
    </div>
</div>
