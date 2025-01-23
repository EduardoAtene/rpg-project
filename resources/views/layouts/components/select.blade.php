<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select 
        class="form-control {{ $class ?? '' }}" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        {{ $disabled ?? false ? 'disabled' : '' }} <!-- Adiciona o atributo desabilitado -->
    >
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
