@props([
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => null,
    'value' => null,
])

@php
    $inputId = $attributes->get('id') ?? $name;
    $hasError = $errors->has($name);
    $inputClass = trim('form-control'.($hasError ? ' is-invalid' : ''));

    $resolvedValue = old($name, $value);
@endphp

<div {{ $attributes->except(['class', 'id', 'type', 'name', 'value', 'placeholder'])->merge(['class' => '']) }}>
    @if ($label)
        <label for="{{ $inputId }}" class="form-label fw-semibold">{{ $label }}</label>
    @endif

    <input
        id="{{ $inputId }}"
        name="{{ $name }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ $resolvedValue }}"
        {{ $attributes->merge(['class' => $inputClass]) }}
    />

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
