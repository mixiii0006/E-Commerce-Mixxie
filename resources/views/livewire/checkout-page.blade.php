@php
    $fields = [
        ['first_name', 'First name', 'text', 'sm:col-span-1'],
        ['last_name', 'Last name', 'text', 'sm:col-span-1'],
        ['phone', 'Phone', 'text', 'sm:col-span-2'],
        ['street_address', 'Street address', 'text', 'sm:col-span-2'],
        ['city', 'City', 'text', 'sm:col-span-2'],
        ['state', 'State / Province', 'text', 'sm:col-span-1'],
        ['zip_code', 'ZIP code', 'text', 'sm:col-span-1'],
    ];
@endphp
<div class="container-x py-12 md:py-16">
    <div class="border-b border-white/[0.06] pb-8">
        <nav class="eyebrow flex items-center gap-2">
            <a wire:navigate href="/cart" class="hover:text-ember-300">Cart</a><span>/</span><span class="text-bone">Checkout</span>
        </nav>
        <h1 class="heading-xl mt-4 text-6xl md:text-7xl">Checkout</h1>
    </div>

    <form wire:submit.prevent="placeOrder" class="mt-10 grid gap-10 lg:grid-cols-[1fr_400px]">
        <div class="space-y-6">
            <div class="panel p-6 sm:p-8">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ember font-display text-sm text-white">1</span>
                    <h2 class="font-display text-2xl uppercase tracking-wide text-bone">Shipping address</h2>
                </div>
                <div class="mt-8 grid gap-5 sm:grid-cols-2">
                    @foreach ($fields as [$name, $label, $type, $span])
                        <div class="{{ $span }}">
                            <label class="field-label" for="{{ $name }}">{{ $label }}</label>
                            <input wire:model="{{ $name }}" id="{{ $name }}" type="{{ $type }}" class="field @error($name) !border-ember-400 @enderror">
                            @error($name) <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel p-6 sm:p-8">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ember font-display text-sm text-white">2</span>
                    <h2 class="font-display text-2xl uppercase tracking-wide text-bone">Payment method</h2>
                </div>
                <ul class="mt-8 grid gap-4 md:grid-cols-2">
                    @foreach ([
                        ['cod', 'hosting-small', 'Cash on delivery', 'Pay when your order arrives', 'M3 7h18v10H3zM7 12h.01M17 12h.01M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z'],
                        ['stripe', 'hosting-big', 'Card (Stripe)', 'Visa, Mastercard, Amex', 'M3 6h18v12H3zM3 10h18M7 15h3'],
                    ] as [$value, $id, $title, $sub, $icon])
                        <li>
                            <input wire:model="payment_method" class="peer hidden" id="{{ $id }}" type="radio" value="{{ $value }}">
                            <label for="{{ $id }}" class="flex cursor-pointer items-center gap-4 rounded-2xl border border-white/10 bg-ink-900 p-5 transition hover:border-white/25 peer-checked:border-ember peer-checked:bg-ember/10 peer-checked:[&_.dot]:border-ember peer-checked:[&_.dot]:bg-ember">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/5 text-bone">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                                </span>
                                <span class="flex-1">
                                    <span class="block text-sm font-semibold text-bone">{{ $title }}</span>
                                    <span class="block text-xs text-bone-500">{{ $sub }}</span>
                                </span>
                                <span class="dot h-4 w-4 rounded-full border-2 border-white/25 transition"></span>
                            </label>
                        </li>
                    @endforeach
                </ul>
                @error('payment_method') <p class="field-error mt-3">{{ $message }}</p> @enderror
            </div>
        </div>

        <aside class="space-y-4 lg:sticky lg:top-24 lg:self-start">
            <div class="panel p-7">
                <h2 class="eyebrow text-bone">Your order</h2>
                <ul class="mt-6 max-h-72 space-y-4 overflow-y-auto pe-1" role="list">
                    @foreach ($cart_items as $ci)
                        <li class="flex items-center gap-4" wire:key="{{ $ci['product_id'] }}">
                            <div class="tile relative h-16 w-14 shrink-0">
                                <img alt="{{ $ci['name'] }}" class="blend absolute inset-0 h-full w-full object-contain p-1.5" src="{{ url('storage', $ci['images']) }}">
                                <span class="absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-ember px-1 text-[10px] font-bold text-white">{{ $ci['quantity'] }}</span>
                            </div>
                            <p class="min-w-0 flex-1 truncate text-sm text-bone">{{ $ci['name'] }}</p>
                            <p class="text-sm font-semibold text-bone">{{ Number::currency($ci['total_amount']) }}</p>
                        </li>
                    @endforeach
                </ul>
                <dl class="mt-6 space-y-3 border-t border-white/[0.06] pt-6 text-sm">
                    <div class="flex justify-between"><dt class="text-bone-500">Subtotal</dt><dd class="text-bone">{{ Number::currency($grand_total) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-bone-500">Taxes</dt><dd class="text-bone">{{ Number::currency(0) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-bone-500">Shipping</dt><dd class="text-emerald-300">Free</dd></div>
                </dl>
                <div class="mt-6 flex items-end justify-between border-t border-white/[0.06] pt-6">
                    <span class="eyebrow text-bone">Grand total</span>
                    <span class="font-display text-4xl text-bone">{{ Number::currency($grand_total) }}</span>
                </div>
            </div>
            <button type="submit" class="btn-primary w-full py-4 text-base">
                <span wire:loading.remove>Place order</span><span wire:loading>Processing&hellip;</span>
            </button>
            <p class="text-center text-xs text-bone-500">By placing your order you agree to our terms.</p>
        </aside>
    </form>
</div>
