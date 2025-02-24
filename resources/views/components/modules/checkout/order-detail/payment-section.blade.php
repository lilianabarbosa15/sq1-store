<section class="payment-section">
    <h2 class="font-volkhov font-normal text-[clamp(30px,3.8vw,46px)]">
        {{ __('Payment') }}
    </h2>
    <!-- Payment Logos Dropdown -->
    < x-modules.checkout.order-detail.input-credit-card />
          
    <!-- Payment Details Inputs -->
    <div class="grid grid-cols-2 gap-1 bg-gray-25 p-5">
        <!-- Card Number Input with a Secure Lock Icon -->
        <div class="col-start-1 col-end-3 flex items-center relative">
            <x-global.forms.input 
                class="pl-[23px] pr-[55px] py-[clamp(12px,2.5vw,23px)]"
                id="number" name="number" required autofocus placeholder="{{ __('Card Number') }}" />
            <div class="absolute right-6 flex justify-center items-center text-gray-400">
                <x-global.svg.secure-lock class="z-1" />
            </div>
        </div>
        
        <!-- Other payment details (expiration, cvv, card holder name) -->
        @php
            $paymentInputs = [
                [ 'id' => 'expiration_number', 'name' => 'expiration_number', 'placeholder' => __('Expiration Date'),
                  'class' => 'col-start-1 col-end-3 2xs:col-end-2' ],
                [ 'id' => 'cvv', 'name' => 'cvv', 'placeholder' => __('Security Code'),
                  'class' => 'col-start-1 2xs:col-start-2 col-end-3' ],
                [ 'id' => 'name-card', 'name' => 'name-card', 'placeholder' => __('Card Holder Name'),
                  'class' => 'col-start-1 col-end-3' ],
            ];
            
            $defaultClass = 'px-[23px] py-[clamp(12px,2.5vw,23px)]';
        @endphp

        @foreach ($paymentInputs as $input)
            <x-global.forms.input 
                class="{{ $input['class'] ?? '' }} {{ $defaultClass }}" id="{{ $input['id'] }}" 
                name="{{ $input['name'] }}" required autofocus placeholder="{{ $input['placeholder'] }}" />
        @endforeach


        <!-- Save Card Information Option -->
        <aside class="col-start-1 col-end-3 flex items-center justify-self-start gap-4 pt-3 w-full">
            <input type="checkbox" x-model=""
                @change=""
                class="w-6 h-6 border-[3px] border-black bg-gray-25 
                        checked:bg-gray-400 checked:border-gray-400 focus:outline-none focus:ring-0 active:bg-gray-400">
            <label class="text-gray-400"> {{ __('Save This Info For Future') }} </label>
        </aside>
    </div>
</section>
