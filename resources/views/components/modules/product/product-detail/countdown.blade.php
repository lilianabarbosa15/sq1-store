@props(['selectedVariant'])

@if (isset($selectedVariant->sale_price))
    <div class="flex justify-between py-3 px-1 sm:p-3 lg:pr-6 rounded bg-primary-100 border border-primary-200 text-primary-400">
        <p class="flex items-center font-volkhov text-[15px] 2md:text-[18px]">
            {{ __('Hurry up! Sale ends in:') }}
        </p>
        <div class="flex items-center gap-[clamp(2px,0.8vw,12px)] 2md:text-[20px]"
             x-data="{ endDate: null, days: 0, hours: 0, minutes: 0, seconds: 0 }"
             x-init="
                endDate = new Date('{{ $selectedVariant->sale_end_time }}'.replace('T', ' ').replace('Z', ''));
                () => {
                    const diff = endDate.getTime() - new Date().getTime();
                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60)) - (days * 24);
                    minutes = Math.floor(diff / (1000 * 60)) - (days * 24 * 60) - (hours * 60);
                    seconds = Math.floor(diff / 1000) - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);
                };
                setInterval(() => {
                    const diff = endDate.getTime() - new Date().getTime();
                    days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    hours = Math.floor(diff / (1000 * 60 * 60)) - (days * 24);
                    minutes = Math.floor(diff / (1000 * 60)) - (days * 24 * 60) - (hours * 60);
                    seconds = Math.floor(diff / 1000) - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);
                }, 1000)"
             class="flex flex-row justify-end items-center gap-2 text-red-400" >
            <span class="font-semibold tabular-nums" x-text="days.toString().padStart(2, '0')">00</span>        <!--days-->
            <span>:</span>
            <span class="font-semibold tabular-nums" x-text="hours.toString().padStart(2, '0')">00</span>       <!--hours-->
            <span>:</span>
            <span class="font-semibold tabular-nums" x-text="minutes.toString().padStart(2, '0')">00</span>     <!--minutes-->
            <span>:</span>
            <span class="font-semibold tabular-nums" x-text="seconds.toString().padStart(2, '0')">00</span>     <!--seconds-->
        </div>
    </div>
@endif