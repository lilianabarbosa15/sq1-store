<footer class="border-t">
    <div class="wrapper flex flex-col-reverse md:flex-row md:justify-between items-center gap-4 py-6 box-border">
        <img src="{{asset('images/sq1-logo.svg')}}" alt="{{config('app.name')}}" width="90" height="28" />
        <div class="flex justify-center md:justify-end items-center gap-y-2 gap-x-4 md:gap-4 flex-wrap">
            @foreach(['support center', 'invoicing', 'contract', 'careers', 'blog', 'faq'] as $item)
                <a href="" class="capitalize text-gray-700 font-normal hover:text-primary-600 opacity-70 hover:opacity-100">{{__($item)}}</a>
            @endforeach
        </div>
    </div>
</footer>
