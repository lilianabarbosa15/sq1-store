@if (isset($product->sale_price))
    <div class="flex justify-between py-3 px-1 sm:p-3 lg:pr-6 rounded bg-primary-50 border border-primary-100 text-primary-400">
        <p class="flex items-center font-volkhov text-[15px] 2md:text-[18px]">
            Hurry up! Sale ends in:
        </p>
        <div class="flex items-center gap-[clamp(2px,0.8vw,12px)] 2md:text-[20px]">
            <strong>00</strong> :
            <strong>05</strong> :
            <strong>59</strong> :
            <strong>47</strong>
        </div>
    </div>
@endif
