<div class="container-x py-16 md:py-24">
    <div class="relative mx-auto max-w-2xl overflow-hidden rounded-[2rem] border border-ember/30 bg-ink-900 px-6 py-16 text-center sm:px-12">
        <div class="pointer-events-none absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-ember/30 blur-[100px]"></div>
        <span class="relative mx-auto flex h-16 w-16 items-center justify-center rounded-full border border-ember/50 text-ember-300">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </span>
        <h1 class="relative mt-8 font-gothic text-6xl text-bone">Payment failed</h1>
        <p class="relative mx-auto mt-4 max-w-sm text-sm text-bone-400">Your payment didn&rsquo;t go through, so the order was cancelled. Nothing has been charged.</p>
        <div class="relative mt-10 flex flex-col justify-center gap-3 sm:flex-row">
            <a wire:navigate href="/cart" class="btn-primary">Back to cart</a>
            <a wire:navigate href="/products" class="btn-ghost">Keep browsing</a>
        </div>
    </div>
</div>
