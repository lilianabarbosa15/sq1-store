<div class="flex items-center relative"> 
    <x-global.forms.input 
        class="pl-[23px] pr-[95px] py-[clamp(12px,2.5vw,23px)]"
        id="brand" name="brand" required autofocus placeholder="{{ __('Credit Card') }}"
    />

    <div x-data="{
        open: false,                       // Controls the dropdown visibility
        selectedPayment: 'default',        // The selected payment option (default value)

        // Define the object-position values for each payment option
        positions: {
            default: '-43px',               // Default object-position (Mastercard)
            visa: '0px',
            mastercard: '-43px',
            amex: '-93px',
            jcb: '-140px',
            discover: '-185px',
            diners: '-230px',
            union: '-270px'
        }
    }">

        <div class="absolute right-6 inset-y-0 min-w-6 flex items-center gap-3 hover:text-primary-600 hover:cursor-pointer"
            @click="open = !open">
            <img src="{{ asset('images/payments.png') }}" 
                width="320px" height="25.23px"
                style="width: 43px; height:25px; object-fit: cover;"
                :style="{ objectPosition: positions[selectedPayment] }"
                alt="The image shows various payment logos including Visa, Mastercard, Amex, JCB, Discover, Diners Club, and UnionPay.">
            <x-global.svg.caret-down-mark />
        </div>

        <div x-show="open" @click.away="open = false" class="z-10 absolute right-0 mt-10 bg-white border rounded shadow p-2">
            @php
                $paymentOptions = [ 'visa' => 'Visa', 'mastercard' => 'Mastercard', 'amex' => 'Amex', 'jcb' => 'JCB', 
                                    'discover' => 'Discover', 'diners' => 'Diners Club', 'union' => 'Union Pay',];
            @endphp

            <ul>
                @foreach ($paymentOptions as $key => $label)
                    <li class="cursor-pointer p-1 hover:text-primary-600" @click="selectedPayment = '{{ $key }}'; open = false;"> {{ $label }} </li>
                @endforeach
            </ul>
        </div>
            
    </div>
</div>
