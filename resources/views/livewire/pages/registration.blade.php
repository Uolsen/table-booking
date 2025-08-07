<div class="flex h-screen min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"
             class="mx-auto h-10 w-auto"/>
        <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">
            Create a new account
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit="submit">
            <!-- Name Input -->
            <x-input
                id="name"
                label="Name"
                name="name"
                type="text"
                autocomplete="name"
                placeholder="Your Name"
                required
                wire:model="name"
                :error="$errors->has('name') ? $errors->first('name') : null"
            />

            <!-- Email Input -->
            <x-input
                id="email"
                label="Email address"
                name="email"
                type="email"
                autocomplete="email"
                placeholder="test@example.com"
                required
                wire:model="email"
                :error="$errors->has('email') ? $errors->first('email') : null"
            />

            <!-- Password Input -->
            <x-input
                id="password"
                type="password"
                label="Password"
                name="password"
                placeholder="••••••••"
                description="Enter your password"
                required
                autocomplete="new-password"
                wire:model="password"
                :error="$errors->has('password') ? $errors->first('password') : null"
            />

            <!-- Password Confirmation Input -->
            <x-input
                id="password_confirmation"
                type="password"
                label="Confirm Password"
                name="password_confirmation"
                placeholder="••••••••"
                description="Re-enter your password"
                required
                autocomplete="new-password"
                wire:model="password_confirmation"
                :error="$errors->has('password_confirmation') ? $errors->first('password_confirmation') : null"
            />

            <div>
                <x-button
                    tag="button"
                    type="submit"
                    class="w-full"
                >
                    Register
                </x-button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500">
                Sign in
            </a>
        </p>
    </div>
</div>
