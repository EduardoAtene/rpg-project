<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        class="form-control {{ $class ?? '' }}" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value="{{ $value ?? '' }}" 
        placeholder="{{ $placeholder ?? '' }}"
        {{ $required ? 'required' : '' }}
    >
</div>
