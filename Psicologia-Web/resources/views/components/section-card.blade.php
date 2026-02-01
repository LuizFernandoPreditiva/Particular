@props([
    'title' => null,
    'subtitle' => null,
    'class' => '',
])

<section class="page-section {{ $class }}">
    <div class="card">
        @if ($title)
            <div class="card-header">
                <div>
                    <h1 class="card-title">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="card-subtitle">{{ $subtitle }}</p>
                    @endif
                </div>
                @isset($actions)
                    <div class="card-actions">
                        {{ $actions }}
                    </div>
                @endisset
            </div>
        @endif
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</section>
