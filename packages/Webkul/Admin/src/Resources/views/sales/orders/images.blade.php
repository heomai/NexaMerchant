<<<<<<< HEAD
<div class="flex gap-[6px]">
    @php
        $maxVisibleItems = 3;
        $items = $order->items->take($maxVisibleItems);
        $restCount = max($order->items->count() - $maxVisibleItems, 0);
    @endphp

    @foreach ($items as $item)
        @php
            $imageCount = $item->product?->images->count();
        @endphp

        <div class="relative">
            <div class="w-full h-[60px] max-w-[60px] max-h-[60px] relativerounded-[4px]">
                @if ($imageCount > 0)
                    <img 
                        class="w-full h-full rounded-[4px]" 
                        src="{{ $item->product->base_image_url }}"
                    >
                    <span class="absolute bottom-[1px] ltr:left-[1px] rtl:right-[1px] text-[12px] font-bold text-white bg-darkPink rounded-full px-[6px]">{{ $imageCount }}</span>
                @else
                    <div class="w-full h-[60px] max-w-[60px] max-h-[60px] relative border border-dashed border-gray-300 dark:border-gray-800 rounded-[4px] dark:invert dark:mix-blend-exclusion">
                        <img src="{{ bagisto_asset('images/product-placeholders/front.svg') }}">
                        
                        <p class="absolute w-full bottom-[5px] text-[6px] text-gray-400 text-center font-semibold"> 
=======
<div class="flex flex-wrap gap-1.5">
    @php
        $restCount = max($order->items->count() - 3, 0);
    @endphp

    @foreach ($order->items->take(3) as $item)
        <div class="relative">
            <div class="w-full h-[60px] max-w-[60px] max-h-[60px] relative rounded">
                @if ($item->product?->images->count() > 0)
                    <img 
                        class="w-full h-full rounded" 
                        src="{{ $item->product->base_image_url }}"
                    >

                    <span class="absolute bottom-px ltr:left-px rtl:right-px text-xs font-bold text-white leading-normal bg-darkPink rounded-full px-1.5">
                        {{ $item->qty_ordered }}
                    </span>
                @else
                    <div class="w-full h-[60px] max-w-[60px] max-h-[60px] relative border border-dashed border-gray-300 dark:border-gray-800 rounded dark:invert dark:mix-blend-exclusion">
                        <img src="{{ bagisto_asset('images/product-placeholders/front.svg') }}">
                        
                        <p class="absolute w-full bottom-1.5 text-[6px] text-gray-400 text-center font-semibold"> 
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
                            @lang('admin::app.sales.invoices.view.product-image') 
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

<<<<<<< HEAD
        @if ($restCount >= 1)
            <a href="{{ route('admin.sales.orders.view', $order->id) }}">
                <div class="flex items-center w-[65px] h-[65px] bg-gray-50 dark:bg-gray-800 rounded-[4px]">
                    <p class="text-[12px] text-gray-600 dark:text-gray-300 text-center font-bold px-[6px] py-[6px]">
                        @lang('admin::app.sales.orders.index.datagrid.product-count', ['count' => $restCount])
                    </p>
                </div>
            </a>
        @endif
    </div>
=======
    @if ($restCount >= 1)
        <a href="{{ route('admin.sales.orders.view', $order->id) }}">
            <div class="flex items-center w-[65px] h-[65px] bg-gray-50 dark:bg-gray-800 rounded">
                <p class="text-xs text-gray-600 dark:text-gray-300 text-center font-bold px-1.5 py-1.5">
                    @lang('admin::app.sales.orders.index.datagrid.product-count', ['count' => $restCount])
                </p>
            </div>
        </a>
    @endif
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61
</div>