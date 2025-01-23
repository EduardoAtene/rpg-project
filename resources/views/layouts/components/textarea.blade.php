<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea 
        class="form-control {{ $class ?? '' }}" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder ?? '' }}" 
        rows="{{ $rows ?? 3 }}" 
        {{ $required ? 'required' : '' }}
    >{{ $value ?? '' }}</textarea>
</div>
