<div>
    <x-auth-shell title="Reset password" word="Anew" subtitle="Choose a new password for your account.">
        <form wire:submit.prevent="save" class="space-y-5">
            @if (session('error'))
                <div class="rounded-xl border border-ember/40 bg-ember/10 px-4 py-3 text-sm font-medium text-ember-300" role="alert">{{ session('error') }}</div>
            @endif

            <div>
                <label for="password" class="field-label">New password</label>
                <input type="password" id="password" wire:model="password" class="field @error('password') !border-ember-400 @enderror" aria-describedby="password-error">
                @error('password') <p class="field-error" id="password-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="field-label">Confirm password</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation" class="field @error('password_confirmation') !border-ember-400 @enderror" aria-describedby="password-confirmation-error">
                @error('password_confirmation') <p class="field-error" id="password-confirmation-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary w-full py-4">
                <span wire:loading.remove wire:target="save">Reset password</span>
                <span wire:loading wire:target="save">Saving&hellip;</span>
            </button>
        </form>
    </x-auth-shell>
</div>
