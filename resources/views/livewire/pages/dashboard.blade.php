<div>
    <x-header></x-header>

    <div class="min-h-full">
        <div class="bg-gray-800 pb-32">
            <header class="py-10">
                <div class="flex flex-row justify-between mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
                    <x-button class="" href="{{ route('reservate') }}">
                        Create Reservation
                    </x-button>
                </div>
            </header>
        </div>
        <main class="-mt-32">
            <div class="mx-auto max-w-5xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="rounded-lg bg-white px-5 shadow-sm sm:px-6">
                    <ul role="list" class="divide-y divide-gray-100">
                        @empty($reservations->toArray())
                            <li class="py-10">
                                <p class="text-center text-sm text-gray-500">
                                    You have no reservations yet.
                                    <a href="{{ route('reservate') }}" class="font-semibold text-primary-600 hover:text-primary-500">
                                        Create a new reservation!
                                    </a>
                                </p>
                            </li>
                        @endempty
                        @foreach($reservations as $reservation)
                            <li class="flex justify-between gap-x-6 py-5">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="size-12 flex-none rounded-full bg-gray-50 flex items-center justify-center">
                                        <span class="text-lg font-semibold text-gray-700">{{ $reservation->people_count }}</span>
                                    </div>
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm/6 font-semibold text-gray-900">{{ $reservation->user->name }}</p>
                                        <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $reservation->user->email }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm/6 text-gray-900">Reservation from: {{ $reservation->start_time->format('Y-m-d H:i') }}</p>
                                    <p class="text-sm/6 text-gray-900">Reservation to: {{ $reservation->end_time->format('Y-m-d H:i') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </main>
    </div>
</div>
