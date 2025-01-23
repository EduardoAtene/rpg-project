<div class="container">
    <h1 class="mb-4">{{ $title }}</h1>
    <form id="{{ $id }}" class="shadow p-4 rounded bg-white {{ $class ?? '' }}" action="{{ $action }}" method="POST">
        @csrf
        @if (strtoupper($method) !== 'POST' && strtoupper($method) !== 'GET')
            @method($method)
        @endif

        @foreach ($fields as $field)
            @switch($field['type'])
                @case('select')
                    @component('layouts.components.select', [
                        'label' => $field['label'],
                        'id' => $field['id'],
                        'name' => $field['name'],
                        'required' => $field['required'] ?? false,
                        'options' => $field['options'] ?? [],
                        'selected' => $field['selected'] ?? null,
                        'class' => $field['class'] ?? ''
                    ])
                    @endcomponent
                    @break

                @case('textarea')
                    @component('layouts.components.textarea', [
                        'label' => $field['label'],
                        'id' => $field['id'],
                        'name' => $field['name'],
                        'required' => $field['required'] ?? false,
                        'value' => $field['value'] ?? null,
                        'placeholder' => $field['placeholder'] ?? '',
                        'rows' => $field['rows'] ?? 3,
                        'class' => $field['class'] ?? ''
                    ])
                    @endcomponent
                    @break

                @default
                    @component('layouts.components.input', [
                        'type' => $field['type'] ?? 'text',
                        'label' => $field['label'],
                        'id' => $field['id'],
                        'name' => $field['name'],
                        'required' => $field['required'] ?? false,
                        'value' => $field['value'] ?? null,
                        'placeholder' => $field['placeholder'] ?? '',
                        'class' => $field['class'] ?? ''
                    ])
                    @endcomponent
                    @break
            @endswitch
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
