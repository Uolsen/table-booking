@props([
    'id',
    'label' => '',
    'type' => 'text',
    'autocomplete' => 'off',
    'placeholder' => '',
    'description' => '',
    'required' => false,
    'error' => null,
])

<div>
    <div class="flex items-center justify-between">
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-900">
            {{ $label ?: 'Email address' }}
        </label>
        @isset($hint)
            <div class="text-sm">
                {{ $hint }}
            </div>
        @endisset
    </div>
    <div class="mt-2 grid grid-cols-1 relative">
        <input
            id="{{ $id }}"
            name="{{ $id }}"
            type="{{ $type }}"
            autocomplete="{{ $autocomplete }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            @if($error)
                aria-invalid="true"
            aria-describedby="{{ $id }}-error"
            @endif
            {{ $attributes->class([
                'col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pr-10 pl-3',
                'outline-1 -outline-offset-1 focus:outline-2 focus:-outline-offset-2 sm:pr-9 sm:text-sm/6',
                'text-red-900 outline-red-300 placeholder:text-red-300 focus:outline-red-600' => $error,
                'text-gray-900 outline-gray-300 placeholder:text-gray-400 focus:outline-primary-600' => !$error,
                ]) }}
        />

{{--        @if($error)--}}
{{--            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"--}}
{{--                 class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-red-500 sm:size-4">--}}
{{--                <path--}}
{{--                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"--}}
{{--                    clip-rule="evenodd" fill-rule="evenodd"/>--}}
{{--            </svg>--}}
{{--        @endif--}}
    </div>

    @if($error)
        <p id="{{ $id }}-error" class="mt-2 text-sm text-red-600">
            {{ $error }}
        </p>
    @elseif($description)
        <p id="{{ $id }}-description" class="mt-2 text-sm text-gray-500">
            {{ $description }}
        </p>
    @endif
</div>
