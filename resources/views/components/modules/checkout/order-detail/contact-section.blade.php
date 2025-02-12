<section>
    <!-- Header for Contact -->
    <div class="flex justify-between items-center">
        <h2 class="font-volkhov font-normal text-[clamp(30px,3.8vw,46px)]">
            {{ __('Contact') }}
        </h2>
        <p class="text-xs 2xs:text-base">
            {{ __('Have an account? ') }} 
            <a class="text-blue-500 hover:text-primary-600" href="">
                {{ __('Create Account') }}
            </a>
        </p>
    </div>
    <!-- Email Input -->
    <x-global.forms.input 
        class="px-[23px] py-[clamp(12px,2.5vw,23px)]"
        id="email"
        name="email"
        required
        autofocus
        placeholder="{{ __('Email Address') }}"
    />
</section>
