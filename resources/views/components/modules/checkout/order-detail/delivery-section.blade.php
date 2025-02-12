<section>
    <h2 class="font-volkhov font-normal text-[clamp(30px,3.8vw,46px)]">
        {{ __('Delivery') }}
    </h2>
    <!-- Grid of Delivery Inputs -->
    <div class="grid grid-cols-2 gap-3">
        <!-- Country / Region Input with Dropdown Icon -->
        <div class="col-start-1 col-end-3 flex items-center relative">
            <x-global.forms.input 
                class="no-clear form-background pl-[23px] pr-[55px] py-[clamp(12px,2.5vw,23px)] block rounded-none w-full text-[16px] border-gray-400 focus:border-primary-400 text-gray-400 bg-neutral-100"
                id="country"
                name="country"
                required
                autofocus
                placeholder="{{ __('Country / Region') }}"
            />
            <!-- Dropdown caret icon -->
            <div class="absolute right-6 inset-y-0 min-w-6 flex justify-center items-center hover:text-primary-600 hover:cursor-pointer">
                <x-global.svg.caret-down-mark class="z-1" />
            </div>
        </div>
            
        <!-- Other inputs required -->
        @php
            $inputs = [
                [ 'id' => 'name', 'name' => 'name', 'placeholder' => __('First Name'), ],
                [ 'id' => 'surname', 'name' => 'surname', 'placeholder' => __('Last Name'), ],
                [ 'id' => 'address', 'name'        => 'address', 'placeholder' => __('Address'),
                  'class' => 'col-start-1 col-end-3' ],
                [ 'id' => 'city', 'name' => 'city', 'placeholder' => __('City'), ],
                [ 'id' => 'postal', 'name' => 'postal', 'placeholder' => __('Postal Code'), ],
            ];
            
            $defaultClass = 'no-clear form-background px-[23px] py-[clamp(12px,2.5vw,23px)] block rounded-none w-full text-[16px] border-gray-400 focus:border-primary-400 text-gray-400 bg-neutral-100';
        @endphp

        @foreach ($inputs as $input)
            <x-global.forms.input 
                class="{{ $input['class'] ?? '' }} {{ $defaultClass }}"
                id="{{ $input['id'] }}"
                name="{{ $input['name'] }}"
                required
                autofocus
                placeholder="{{ $input['placeholder'] }}"
            />
        @endforeach

    </div>
        
    <!-- Delivery Additional Options -->
    <aside class="flex items-center justify-self-start gap-4 pt-5 w-full">
        <input type="checkbox"
            x-model="" 
            @change="$wire.call('wrapCart', )"
            class="w-6 h-6 border-[3px] border-black bg-white 
                    checked:bg-gray-400 checked:border-gray-400 focus:outline-none focus:ring-0 active:bg-gray-400">
        <label class="text-gray-400">
            {{ __('Save This Info For Future') }}
        </label>
    </aside>
</section>
