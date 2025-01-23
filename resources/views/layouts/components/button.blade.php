@if(isset($href))
    <a 
        href="{{ $href }}" 
        class="btn {{ $type ?? 'btn-primary' }} {{ $size ?? 'btn-lg' }} {{ $class ?? '' }}" 
    >
        {{ $slot }}
    </a>
@else
    <button 
        class="btn {{ $type ?? 'btn-primary' }} {{ $size ?? 'btn-lg' }} {{ $class ?? '' }}" 
        onclick="{{ $onclick ?? '' }}"
    >
        {{ $slot }}
    </button>
@endif
