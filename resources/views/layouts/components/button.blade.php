<button 
    class="btn {{ $type ?? 'btn-primary' }} {{ $class ?? '' }}" 
    onclick="{{ $onclick ?? '' }}"
>
    @isset($slot)
    {{ $slot }}
    @endisset
</button>
