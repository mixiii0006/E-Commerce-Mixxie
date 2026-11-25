<div class="container-x py-12 md:py-16">
    <div class="flex flex-col gap-4 border-b border-white/[0.06] pb-8 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="eyebrow">Account</p>
            <h1 class="heading-xl mt-3 text-6xl md:text-7xl">My orders</h1>
        </div>
        <p class="text-sm text-bone-500"><span class="font-display text-2xl text-ember-400">{{ $orders->total() }}</span> orders placed</p>
    </div>

    @if ($orders->count())
        <div class="panel mt-10 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-white/[0.06] text-left text-[11px] uppercase tracking-widest2 text-bone-500">
                            <th class="px-6 py-4 font-semibold">Order</th>
                            <th class="px-6 py-4 font-semibold">Date</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Payment</th>
                            <th class="px-6 py-4 text-right font-semibold">Amount</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.06]">
                        @foreach ($orders as $order)
                            <tr wire:key="{{ $order->id }}" class="transition hover:bg-white/[0.02]">
                                <td class="whitespace-nowrap px-6 py-5 font-display text-lg text-bone">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="whitespace-nowrap px-6 py-5 text-bone-400">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="whitespace-nowrap px-6 py-5"><x-status-pill :value="$order->status" /></td>
                                <td class="whitespace-nowrap px-6 py-5"><x-status-pill :value="$order->payment_status" /></td>
                                <td class="whitespace-nowrap px-6 py-5 text-right font-semibold text-bone">{{ Number::currency($order->grand_total, 'USD') }}</td>
                                <td class="whitespace-nowrap px-6 py-5 text-right">
                                    <a wire:navigate href="/my-orders/{{ $order->id }}" class="link-arrow">Details <span aria-hidden="true">&rarr;</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-10">
            {{ $orders->links('livewire.partials.pagination') }}
        </div>
    @else
        <div class="mt-10 flex flex-col items-center rounded-3xl border border-dashed border-white/10 px-6 py-24 text-center">
            <p class="font-gothic text-7xl text-ember-400">No orders yet</p>
            <p class="mt-4 text-sm text-bone-500">When you place an order it will appear here.</p>
            <a wire:navigate href="/products" class="btn-primary mt-8">Start shopping</a>
        </div>
    @endif
</div>
