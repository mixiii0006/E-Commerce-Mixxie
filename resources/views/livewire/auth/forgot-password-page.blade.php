<div>
    <x-auth-shell title="Forgot password?" word="Lost">
        <x-slot:subtitle>
            Remember it after all?
            <a wire:navigate href="/login" class="font-semibold text-ember-300 hover:text-ember-400">Sign in here</a>
        </x-slot:subtitle>

        <form wire:submit.prevent="save" class="space-y-5">
            @if (session('success'))
                <div class="rounded-xl border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-sm font-medium text-emerald-300" role="alert">{{ session('success') }}</div>
            @endif

            <div>
                <label for="email" class="field-label">Email address</label>
                <input type="email" id="email" wire:model="email" class="field @error('email') !border-ember-400 @enderror" placeholder="you@example.com" aria-describedby="email-error">
                @error('email') <p class="field-error" id="email-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary w-full py-4">
                <span wire:loading.remove wire:target="save">Send reset link</span>
                <span wire:loading wire:target="save">Sending&hellip;</span>
            </button>
        </form>
    </x-auth-shell>
</div>
