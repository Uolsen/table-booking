<div>
    <x-header></x-header>

    <div class="min-h-full">
        <div class="bg-gray-800 pb-32">
            <header class="py-10">
                <div class="flex flex-row justify-between mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">Create reservation</h1>
                </div>
            </header>
        </div>
        <main class="-mt-32">
            <div class="mx-auto max-w-5xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="rounded-lg bg-white px-5 py-6 shadow-sm sm:px-6">
                    <form wire:submit="submit">
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Seats</h2>
                                <p class="mt-1 text-sm/6 text-gray-600">Start by selecting how many seats do you
                                    want.</p>
                                <div class="mt-5">
                                    <fieldset aria-label="Choose a memory option">
                                        <div class="mt-2 grid grid-cols-3 gap-3 sm:grid-cols-6">
                                            @for($index = 0; $index < config('booking.table_count'); $index++)
                                                <label
                                                    class="group relative flex items-center justify-center rounded-md border border-gray-300 bg-white p-3 has-checked:border-primary-600 has-checked:bg-primary-600 has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-primary-600 has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25">
                                                    <input type="radio" name="seats" wire:model="seats"
                                                           value="{{ $index + 1 }}"
                                                           class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed"/>
                                                    <span
                                                        class="text-sm font-medium uppercase group-has-checked:text-white">{{ $index + 1 }} {{ Str::plural('seat', $index + 1) }}</span>
                                                </label>
                                            @endfor
                                        </div>
                                        @if($errors->has('seats'))
                                            <p class="mt-2 text-sm text-red-600">
                                                {{ $errors->first('seats') }}
                                            </p>
                                        @endif
                                    </fieldset>

                                </div>
                            </div>

                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Select Date</h2>
                                <p class="mt-1 text-sm/6 text-gray-600">Select available date from the calendar</p>

                                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-3"
                                     x-data="{
                                                fromDatePicker: null,
                                                toDatePicker: null,
                                            }"
                                     x-init="
                                            load = function() {
                                                if (window.flatpickr) {
                                                    fromDatePicker = window.flatpickr('#from', {
                                                        minDate: 'today',
                                                        enableTime: true,
                                                        dateFormat: 'Y-m-d H:i',
                                                        time_24hr: true,
                                                        locale: {
                                                            firstDayOfWeek: 1
                                                        },
                                                        onChange: function (selectedDates, dateStr, instance) {

                                                        }
                                                    });

                                                    toDatePicker = window.flatpickr('#to', {
                                                        minDate: 'today',
                                                        enableTime: true,
                                                        dateFormat: 'Y-m-d H:i',
                                                        time_24hr: true,
                                                        locale: {
                                                            firstDayOfWeek: 1
                                                        },
                                                        onChange: function (selectedDates, dateStr, instance) {
                                                        }
                                                    });

                                                } else {
                                                    setTimeout(load, 100);
                                                }
                                            };
                                            load();
                                        "
                                >
                                    <div>
                                        <x-input id="from" type="text" class="sm:col-span-3"
                                                 wire:model="fromDateTime"
                                                 :error="$errors->has('fromDateTime') ? $errors->first('fromDateTime') : null"
                                                 label="Reservation date" placeholder="Select from date" x-ref="from"
                                                 readonly />
                                    </div>
                                    <div>
                                        <x-input id="to" type="text" class="sm:col-span-3"
                                                 wire:model="toDateTime"
                                                 :error="$errors->has('toDateTime') ? $errors->first('toDateTime') : null"
                                                 label="Reservation date" placeholder="Select to date" x-ref="to"
                                                 readonly />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('dashboard') }}" type="button"
                               class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                            <x-button
                                tag="button"
                                type="submit"
                                class="rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-primary-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
                            >
                                Save
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</div>
