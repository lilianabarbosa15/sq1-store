<div class="wrapper grid grid-cols-2">
    <div class="m-auto">
        @php
            $image = collect(File::allFiles('images/marketing'))->first(function ($file) {
                return $file->getFilename() === 'supermodel1.png';
            });
        @endphp

        @if($image)
            <img src="{{ $image }}" alt="Selected Image" class="w-[308px] h-auto">
        @else
            <p>{{ __('Image not found') }}</p>
        @endif
        
    </div>
    <div class="space-y-2 max-w-[510px] m-auto">
        <p class="font-roboto font-normal text-[clamp(16px,1.7vw,22px)] text-blue-950">
            {{__('HOT DEALS THIS WEEK')}}
        </p>
        <p class="font-roboto font-bold text-[48px] text-orange-400">
            {{__('SALE UP 50% MODERN FURNITURE')}}
        </p>
        <div>
            <button class="ml-3 mt-4 btn btn-outlined first-letter:capitalize font-roboto font-bold">
                {{__('view now')}}
            </button>
        </div>
    </div>
</div>
