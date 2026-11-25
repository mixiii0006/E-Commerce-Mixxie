@props(['value'])
@php
    $styles = [
        'new' => 'border-sky-400/30 bg-sky-400/10 text-sky-300',
        'processing' => 'border-amber-400/30 bg-amber-400/10 text-amber-300',
        'shipped' => 'border-violet-400/30 bg-violet-400/10 text-violet-300',
        'delivered' => 'border-emerald-400/30 bg-emerald-400/10 text-emerald-300',
        'canceled' => 'border-ember-400/30 bg-ember/10 text-ember-300',
        'cancelled' => 'border-ember-400/30 bg-ember/10 text-ember-300',
        'pending' => 'border-amber-400/30 bg-amber-400/10 text-amber-300',
        'paid' => 'border-emerald-400/30 bg-emerald-400/10 text-emerald-300',
        'failed' => 'border-ember-400/30 bg-ember/10 text-ember-300',
    ];
    $key = strtolower((string) $value);
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider ' . ($styles[$key] ?? 'border-white/10 text-bone-400')]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
    {{ ucfirst($key) }}
</span>
