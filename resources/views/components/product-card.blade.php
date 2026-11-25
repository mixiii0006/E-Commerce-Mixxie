@props(['product', 'cart' => true])
@php
    $images = $product->images ?? [];
    $a = $images[0] ?? null;
    $b = $images[1] ?? $a;
@endphp
<article {{ $attributes->merge(['class' => 'group relative flex flex-col']) }}>
    <a wire:navigate href="/products/{{ $product->slug }}" class="tile swap block aspect-[4/5]">
        @if ($a)
            <img src="{{ url('storage', $a) }}" alt="{{ $product->name }}" loading="lazy"
                 class="swap-a blend absolute inset-0 h-full w-full object-contain p-6">
            <img src="{{ url('storage', $b) }}" alt="" aria-hidden="true" loading="lazy"
                 class="swap-b blend absolute inset-0 h-full w-full object-contain p-6">
        @endif

        <div class="absolute left-3 top-3 flex flex-col items-start gap-1.5">
            @if ($product->on_sale)
                <span class="badge bg-ember text-white">Sale</span>
            @endif
            @if ($product->is_featured)
                <span class="badge bg-ink-950 text-bone">Featured</span>
            @endif
            @unless ($product->in_stock)
                <span class="badge bg-bone-300 text-ink-800">Sold out</span>
            @endunless
        </div>
    </a>

    @if ($cart && $product->in_stock)
        <button type="button" wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" wire:target="addToCart({{ $product->id }})"
                class="absolute right-3 top-3 flex h-10 w-10 translate-y-1 items-center justify-center rounded-full bg-ink-950 text-bone opacity-0 shadow-lg transition duration-300 hover:bg-ember hover:text-white focus:opacity-100 group-hover:translate-y-0 group-hover:opacity-100 max-md:translate-y-0 max-md:opacity-100"
                aria-label="Add {{ $product->name }} to cart">
            <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            <svg wire:loading wire:target="addToCart({{ $product->id }})" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity=".25" stroke-width="3"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
        </button>
    @endif

    <div class="flex items-start justify-between gap-3 px-1 pt-4">
        <div class="min-w-0">
            <p class="truncate text-[10px] font-semibold uppercase tracking-widest2 text-bone-500">{{ $product->brand?->name }}</p>
            <h3 class="mt-1 text-[15px] font-medium leading-snug text-bone transition group-hover:text-ember-300">
                <a wire:navigate href="/products/{{ $product->slug }}">{{ $product->name }}</a>
            </h3>
        </div>
        <p class="shrink-0 font-display text-lg tracking-wide text-bone">{{ Number::currency($product->price) }}</p>
    </div>
</article>
