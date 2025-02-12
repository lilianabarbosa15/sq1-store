<button {{ $attributes->merge(['type'   => 'submit', 
                               'class'  => 'inline-flex items-center px-4 py-2 bg-primary-400 border border-transparent rounded-md 
                                            font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-600 focus:bg-primary-600 
                                            active:bg-gray-900 focus:outline-none focus:ring-offset-2 
                                            transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
