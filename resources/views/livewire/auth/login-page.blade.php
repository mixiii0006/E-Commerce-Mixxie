<div>
    <x-auth-shell title="Sign in" word="Return">
        <x-slot:subtitle>
            Don&rsquo;t have an account yet?
            <a wire:navigate href="/register" class="font-semibold text-ember-300 hover:text-ember-400">Sign up here</a>
        </x-slot:subtitle>

        <form wire:submit.prevent="save" class="space-y-5">
            @if (session('error'))
                <div class="rounded-xl border border-ember/40 bg-ember/10 px-4 py-3 text-sm font-medium text-ember-300" role="alert">{{ session('error') }}</div>
            @endif

            <div>
                <label for="email" class="field-label">Email address</label>
                <input type="email" id="email" wire:model="email" class="field @error('email') !border-ember-400 @enderror" placeholder="you@example.com" aria-describedby="email-error">
                @error('email') <p class="field-error" id="email-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="field-label">Password</label>
                    <a wire:navigate href="/forgot" class="mb-2 text-xs font-semibold text-bone-400 hover:text-ember-300">Forgot password?</a>
                </div>
                <input type="password" id="password" wire:model="password" class="field @error('password') !border-ember-400 @enderror" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" aria-describedby="password-error">
                @error('password') <p class="field-error" id="password-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary w-full py-4">
                <span wire:loading.remove wire:target="save">Sign in</span>
                <span wire:loading wire:target="save">Signing in&hellip;</span>
            </button>
        </form>
    </x-auth-shell>
</div>
