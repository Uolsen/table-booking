<div class="flex h-screen min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"
             class="mx-auto h-10 w-auto"/>
        <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">
            Sign in to your account
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit="submit">

            <!-- Email Input using the input component with error support -->
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
                autocomplete="current-password"
                class="w-full"
                wire:model="password"
                :error="$errors->has('password') ? $errors->first('password') : null"
            />

            <div>
                <x-button
                    tag="button"
                    type="submit"
                    class="w-full"
                >
                    Sign in
                </x-button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Don't have an account?
            <a href="#" class="font-semibold text-primary-600 hover:text-primary-500">
                Create a reservation and start using the app!
            </a>
        </p>
    </div>
</div>
