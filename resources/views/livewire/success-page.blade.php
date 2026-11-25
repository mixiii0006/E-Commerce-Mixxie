<div class="container-x py-16 md:py-24">
    <div class="relative mx-auto max-w-4xl overflow-hidden rounded-[2rem] border border-white/[0.07] bg-ink-900">
        <div class="pointer-events-none absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-ember/40 blur-[100px]"></div>

        <div class="relative px-6 py-14 text-center sm:px-12">
            <span class="mx-auto flex h-16 w-16 animate-rise items-center justify-center rounded-full bg-ember text-white shadow-[0_0_40px_rgba(212,69,43,.6)]">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
            </span>
            <h1 class="mt-8 animate-rise font-gothic text-6xl text-bone [animation-delay:.1s] md:text-7xl">Thank you</h1>
            <p class="mx-auto mt-4 max-w-md animate-rise text-sm text-bone-400 [animation-delay:.2s]">
                Your order has been received{{ $order?->address ? ', ' . $order->address->first_name : '' }}. We&rsquo;ll send it out within 48 hours.
            </p>
        </div>

        @if ($order)
            <div class="relative grid grid-cols-2 border-y border-white/[0.07] md:grid-cols-4">
                @foreach ([
                    ['Order', '#' . str_pad($order->id, 4, '0', STR_PAD_LEFT)],
                    ['Date', $order->created_at->format('d M Y')],
                    ['Total', Number::currency($order->grand_total, 'USD')],
                    ['Payment', $order->payment_method == 'cod' ? 'Cash on delivery' : 'Card'],
                ] as $i => [$k, $v])
                    <div class="border-white/[0.07] px-6 py-6 text-center {{ $i % 2 === 0 ? 'border-r' : '' }} {{ $i === 1 ? 'md:border-r' : '' }} {{ $i < 2 ? 'max-md:border-b' : '' }}">
                        <p class="text-[10px] uppercase tracking-widest2 text-bone-500">{{ $k }}</p>
                        <p class="mt-2 font-display text-xl text-bone">{{ $v }}</p>
                    </div>
                @endforeach
            </div>

            @if ($order->address)
                <div class="relative grid gap-8 px-6 py-10 sm:px-12 md:grid-cols-2">
                    <div>
                        <h2 class="eyebrow text-bone">Ship to</h2>
                        <p class="mt-4 font-medium text-bone">{{ $order->address->full_name }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-bone-400">{{ $order->address->street_address }}<br>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}</p>
                        <p class="mt-2 text-sm text-bone-400">{{ $order->address->phone }}</p>
                    </div>
                    <div>
                        <h2 class="eyebrow text-bone">Summary</h2>
                        <dl class="mt-4 space-y-2 text-sm">
                            <div class="flex justify-between"><dt class="text-bone-500">Subtotal</dt><dd class="text-bone">{{ Number::currency($order->grand_total, 'USD') }}</dd></div>
                            <div class="flex justify-between"><dt class="text-bone-500">Shipping</dt><dd class="text-emerald-300">Free</dd></div>
                            <div class="flex justify-between border-t border-white/[0.07] pt-3"><dt class="font-semibold text-bone">Total</dt><dd class="font-display text-xl text-bone">{{ Number::currency($order->grand_total, 'USD') }}</dd></div>
                        </dl>
                    </div>
                </div>
            @endif
        @endif

        <div class="relative flex flex-col justify-center gap-3 border-t border-white/[0.07] px-6 py-8 sm:flex-row">
            <a wire:navigate href="/products" class="btn-ghost">Continue shopping</a>
            <a wire:navigate href="/my-orders" class="btn-primary">View my orders</a>
        </div>
    </div>
</div>
