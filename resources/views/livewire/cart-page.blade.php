<div class="container-x py-12 md:py-16">
    <div class="flex items-end justify-between border-b border-white/[0.06] pb-8">
        <div>
            <p class="eyebrow">Your selection</p>
            <h1 class="heading-xl mt-3 text-6xl md:text-7xl">Cart</h1>
        </div>
        <p class="text-sm text-bone-500"><span class="font-display text-2xl text-ember-400">{{ count($cart_items) }}</span> {{ count($cart_items) === 1 ? 'item' : 'items' }}</p>
    </div>

    @if (count($cart_items))
        <div class="mt-10 grid gap-10 lg:grid-cols-[1fr_380px]">
            <ul class="divide-y divide-white/[0.06]">
                @foreach ($cart_items as $item)
                    <li wire:key="{{ $item['product_id'] }}" class="flex gap-5 py-6 first:pt-0">
                        <div class="tile h-28 w-24 shrink-0 sm:h-32 sm:w-28">
                            <img src="{{ url('storage', $item['images']) }}" alt="{{ $item['name'] }}" class="blend absolute inset-0 h-full w-full object-contain p-3">
                        </div>
                        <div class="flex min-w-0 flex-1 flex-col justify-between gap-4 sm:flex-row sm:items-center">
                            <div class="min-w-0">
                                <p class="truncate text-base font-medium text-bone">{{ $item['name'] }}</p>
                                <p class="mt-1 text-sm text-bone-500">{{ Number::currency($item['unit_amount']) }} each</p>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="flex items-center rounded-full border border-white/10 p-1">
                                    <button wire:click="decreaseQty({{ $item['product_id'] }})" class="flex h-8 w-8 items-center justify-center rounded-full text-bone-300 hover:bg-white/5 hover:text-white" aria-label="Decrease">&minus;</button>
                                    <span class="w-8 text-center font-display text-bone">{{ $item['quantity'] }}</span>
                                    <button wire:click="increaseQty({{ $item['product_id'] }})" class="flex h-8 w-8 items-center justify-center rounded-full text-bone-300 hover:bg-white/5 hover:text-white" aria-label="Increase">+</button>
                                </div>
                                <p class="w-24 text-right font-display text-xl text-bone">{{ Number::currency($item['total_amount']) }}</p>
                                <button wire:click="removeItem({{ $item['product_id'] }})" class="flex h-9 w-9 items-center justify-center rounded-full text-bone-500 transition hover:bg-ember/10 hover:text-ember-300" aria-label="Remove">
                                    <svg wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                    <svg wire:loading wire:target="removeItem({{ $item['product_id'] }})" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity=".25" stroke-width="3"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3"/></svg>
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <aside class="panel h-fit p-7 lg:sticky lg:top-24">
                <h2 class="eyebrow text-bone">Summary</h2>
                <dl class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between"><dt class="text-bone-500">Subtotal</dt><dd class="text-bone">{{ Number::currency($grand_total) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-bone-500">Taxes</dt><dd class="text-bone">{{ Number::currency(0) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-bone-500">Shipping</dt><dd class="text-emerald-300">Free</dd></div>
                </dl>
                <div class="mt-6 flex items-end justify-between border-t border-white/[0.06] pt-6">
                    <span class="eyebrow text-bone">Total</span>
                    <span class="font-display text-4xl text-bone">{{ Number::currency($grand_total) }}</span>
                </div>
                <a wire:navigate href="/checkout" class="btn-primary mt-8 w-full py-4">
                    Checkout
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
                <a wire:navigate href="/products" class="link-arrow mt-5 w-full justify-center">Continue shopping</a>
            </aside>
        </div>
    @else
        <div class="mt-10 flex flex-col items-center rounded-3xl border border-dashed border-white/10 px-6 py-24 text-center">
            <p class="font-gothic text-7xl text-ember-400">Empty</p>
            <p class="mt-4 max-w-sm text-sm text-bone-500">Your cart is as hollow as a crypt. Let&rsquo;s fix that.</p>
            <a wire:navigate href="/products" class="btn-primary mt-8">Browse the collection</a>
        </div>
    @endif
</div>
