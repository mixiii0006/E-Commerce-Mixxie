<div class="container-x py-12 md:py-16">
    <div class="flex flex-col gap-4 border-b border-white/[0.06] pb-8 md:flex-row md:items-end md:justify-between">
        <div>
            <nav class="eyebrow flex items-center gap-2">
                <a wire:navigate href="/my-orders" class="hover:text-ember-300">My orders</a><span>/</span><span class="text-bone">Details</span>
            </nav>
            <h1 class="heading-xl mt-4 text-6xl md:text-7xl">Order #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>
        </div>
        <div class="flex gap-2">
            <x-status-pill :value="$order->status" />
            <x-status-pill :value="$order->payment_status" />
        </div>
    </div>

    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['Customer', $address?->full_name ?? '—', 'M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z'],
            ['Order date', $order->created_at->format('d M Y'), 'M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z'],
            ['Payment', $order->payment_method === 'cod' ? 'Cash on delivery' : 'Card (Stripe)', 'M3 6h18v12H3zM3 10h18'],
            ['Shipping', $order->shipping_method ?: 'Standard', 'M3 7h11v8H3zM14 10h4l3 3v2h-7'],
        ] as [$label, $value, $icon])
            <div class="panel flex items-center gap-4 p-5">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-ember/10 text-ember-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                </span>
                <div class="min-w-0">
                    <p class="text-[10px] uppercase tracking-widest2 text-bone-500">{{ $label }}</p>
                    <p class="mt-1 truncate text-sm font-semibold text-bone">{{ $value }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_380px]">
        <div class="panel p-6 sm:p-8">
            <h2 class="eyebrow text-bone">Items</h2>
            <ul class="mt-6 divide-y divide-white/[0.06]">
                @foreach ($order_items as $item)
                    <li wire:key="{{ $item->id }}" class="flex items-center gap-5 py-5 first:pt-0 last:pb-0">
                        <div class="tile h-20 w-16 shrink-0">
                            <img src="{{ url('storage', $item->product->images[0]) }}" alt="{{ $item->product->name }}" class="blend absolute inset-0 h-full w-full object-contain p-2">
                        </div>
                        <div class="min-w-0 flex-1">
                            <a wire:navigate href="/products/{{ $item->product->slug }}" class="block truncate font-medium text-bone hover:text-ember-300">{{ $item->product->name }}</a>
                            <p class="mt-1 text-sm text-bone-500">{{ Number::currency($item->unit_amount, 'USD') }} &times; {{ $item->quantity }}</p>
                        </div>
                        <p class="font-display text-xl text-bone">{{ Number::currency($item->total_amount, 'USD') }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="space-y-6">
            <div class="panel p-7">
                <h2 class="eyebrow text-bone">Shipping address</h2>
                @if ($address)
                    <p class="mt-5 font-medium text-bone">{{ $address->full_name }}</p>
                    <p class="mt-2 text-sm leading-relaxed text-bone-400">{{ $address->street_address }}<br>{{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</p>
                    <p class="mt-3 text-sm text-bone-400">{{ $address->phone }}</p>
                @endif
            </div>
            <div class="panel p-7">
                <h2 class="eyebrow text-bone">Summary</h2>
                <dl class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between"><dt class="text-bone-500">Subtotal</dt><dd class="text-bone">{{ Number::currency($order->grand_total, 'USD') }}</dd></div>
                    <div class="flex justify-between"><dt class="text-bone-500">Taxes</dt><dd class="text-bone">{{ Number::currency(0, 'USD') }}</dd></div>
                    <div class="flex justify-between"><dt class="text-bone-500">Shipping</dt><dd class="text-emerald-300">Free</dd></div>
                </dl>
                <div class="mt-6 flex items-end justify-between border-t border-white/[0.06] pt-6">
                    <span class="eyebrow text-bone">Total</span>
                    <span class="font-display text-4xl text-bone">{{ Number::currency($order->grand_total, 'USD') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
