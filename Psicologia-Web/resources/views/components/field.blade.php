@props([
    'label' => null,
    'for' => null,
    'hint' => null,
])

<div class="field">
    @if ($label)
        <label @if($for) for="{{ $for }}" @endif>{{ $label }}</label>
    @endif
    {{ $slot }}
    @if ($hint)
        <span class="field-hint">{{ $hint }}</span>
    @endif
</div>
