<div class="wrapper grid grid-cols-1 sm:grid-cols-2">
    <div class="m-auto">
        <img src="{{ asset('images/marketing/supermodel1.png') }}" 
            alt="Model posing confidently in a modern outfit" 
            class="w-[clamp(160px,20vw,308px)] h-auto">
    </div>
    <div class="space-y-2 max-w-lg my-auto">
        <p class="font-roboto font-normal text-[clamp(16px,1.7vw,22px)] text-blue-950">
            {{__('HOT DEALS THIS WEEK')}}
        </p>
        <p class="font-roboto font-bold text-[clamp(24px,3vw,48px)] text-orange-400">
            {{__('SALE UP 50% MODERN FURNITURE')}}
        </p>
        <div>
            <button class="text-sm ml-3 mt-4 btn btn-outlined btn-gray px-[clamp(8px,1.5vw,16px)] first-letter:capitalize font-roboto font-bold hover:scale-110">
                {{__('view now')}}
            </button>
        </div>
    </div>
</div>
