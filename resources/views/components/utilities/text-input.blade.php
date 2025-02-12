@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' =>  'block w-full rounded-md bg-white p-[12px] text-base 
                                                                text-gray-900 focus:outline-none focus:ring-0 no-clear 
                                                                form-background focus:border-primary-400 block mt-1']) }}> 
