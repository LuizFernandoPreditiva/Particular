@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'alert alert-error']) }}>
        <div>
            {{ __('Ops! Algo deu errado.') }}
        </div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
