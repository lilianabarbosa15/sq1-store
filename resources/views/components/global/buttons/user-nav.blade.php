@if(Auth::user())
    <div class="bg-primary/10 border-[3.5px] border-gray-600 hover:border-primary-200 hover:text-primary-600 
                size-5 rounded-full flex justify-center items-center p-1 box-content">
        <p class="font-black uppercase">{{Auth::user()->name[0]}}</p>
    </div>
@else
    <x-global.svg.user class="hover:text-primary-600"/>
@endif
