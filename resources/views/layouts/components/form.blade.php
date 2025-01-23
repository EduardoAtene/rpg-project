<div class="container">
    <h1 class="mb-4">{{ $title }}</h1>
    <form id="{{ $id }}" class="shadow p-4 rounded bg-white {{ $class ?? '' }}" action="{{ $action }}" method="{{ $method }}">
        @csrf
        @if($method !== 'POST' && $method !== 'GET')
            @method($method)
        @endif

        @foreach ($fields as $field)
            @if ($field['type'] === 'select')
                @component('layouts.components.select', [
                    'label' => $field['label'],
                    'id' => $field['id'],
                    'name' => $field['name'],
                    'required' => $field['required'] ?? false,
                    'options' => $field['options'] ?? [],
                    'selected' => $field['selected'] ?? null
                ])
                @endcomponent
            @else
                @component('layouts.components.input', [
                    'type' => $field['type'] ?? 'text',
                    'label' => $field['label'],
                    'id' => $field['id'],
                    'name' => $field['name'],
                    'required' => $field['required'] ?? false,
                    'value' => $field['value'] ?? null,
                    'placeholder' => $field['placeholder'] ?? ''
                ])
                @endcomponent
            @endif
        @endforeach

        <div class="mt-4">
            @foreach ($buttons as $button)
                <button 
                    type="{{ $button['type'] }}" 
                    class="btn {{ $button['class'] ?? 'btn-primary' }}"
                    onclick="{{ $button['onclick'] ?? '' }}"
                >
                    {{ $button['label'] }}
                </button>
            @endforeach
        </div>
    </form>
</div>
