<button {{ $attributes->merge(['type' => 'submit', 'class' => 'login-button']) }}>
    {{ $slot }}
</button>
