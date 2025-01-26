<div class="wrapper space-y-10">
    <div class="space-y-8">
        <h2 class="text-gray-900 font-roboto font-bold text-[clamp(40px,12.5vw,46px)] text-center">
            {{__('New Arrivals')}}
        </h2>

        <p class="text-neutral-600 font-normal text-center sm:max-w-[520px] mx-auto">
            {{__('Discover our exciting new arrivals, featuring the latest trends and styles to refresh your wardrobe this season.')}}
        </p>
    </div>

    <!-- Categories -->
    <div class="no-visibility-scrollbar min-[768px]:flex justify-center items-center gap-[clamp(16px,0.1vw,24px)] lg:gap-10 transition-all
     w-full whitespace-nowrap flex max-[768px]:overflow-x-auto flex-nowrap max-[768px]:justify-between">
        <!--
        {{ $categories }} comes from the HomeController, but $selectedCategory comes from the RecommendedProductsSection.  
        Therefore, the categories are determined by the RecommendedProductsSection.
        -->
        @foreach($categories as $category)
            <button type="button"
                    wire:click="selectCategory('{{$category->slug}}')"
                    wire:key="category-{{$category->slug}}"
                @class([
                    'btn btn-filled capitalize text-[clamp(14px,1.7vw,16px)]',
                    'btn-gray hover:border-primary-600 hover:!bg-primary-600/5 hover:!text-primary-600' => $selectedCategory->id !== $category->id,
                    'btn-primary shadow-xl shadow-black/15' => $selectedCategory->id === $category->id,
                ])
            >
                {{ $category->name }}
            </button>
        @endforeach
    </div>
    
    <!-- Products -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-[clamp(16px,1vw,32px)] justify-items-center">
        @foreach($selectedCategory->products->take($productsToShow) as $product)
            <x-global.ui.product-card :product="$product"/>
        @endforeach
    </div>

    <!-- Load More -->
    <div class="flex justify-center font-normal">
        @if ($selectedCategory->products->count() > $productsToShow)
            <button type="button"
                    wire:click="loadMore"
            @class([
                'btn btn-filled capitalize text-4 py-4 px-[100px] lg:px-[70px]',
                'btn-primary shadow-xl shadow-black/15',
            ])
            >
                {{__('view more')}}
            </button>
        @endif
    </div>

</div>
