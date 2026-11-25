<div>
    <x-auth-shell title="Join the coven" word="Coven">
        <x-slot:subtitle>
            Already have an account?
            <a wire:navigate href="/login" class="font-semibold text-ember-300 hover:text-ember-400">Sign in here</a>
        </x-slot:subtitle>

        <form wire:submit.prevent="save" class="space-y-5">
            <div>
                <label for="name" class="field-label">Name</label>
                <input type="text" id="name" wire:model="name" class="field @error('name') !border-ember-400 @enderror" placeholder="Your name" aria-describedby="name-error">
                @error('name') <p class="field-error" id="name-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="field-label">Email address</label>
                <input type="email" id="email" wire:model="email" class="field @error('email') !border-ember-400 @enderror" placeholder="you@example.com" aria-describedby="email-error">
                @error('email') <p class="field-error" id="email-error">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="field-label">Password</label>
                <input type="password" id="password" wire:model="password" class="field @error('password') !border-ember-400 @enderror" placeholder="At least 6 characters" aria-describedby="password-error">
                @error('password') <p class="field-error" id="password-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary w-full py-4">
                <span wire:loading.remove wire:target="save">Create account</span>
                <span wire:loading wire:target="save">Creating&hellip;</span>
            </button>
        </form>
    </x-auth-shell>
</div>
