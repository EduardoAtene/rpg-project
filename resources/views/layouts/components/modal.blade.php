<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-toast {{ $size ?? '' }}">
        <div class="modal-content shadow-sm">
            <div class="modal-header bg-{{ $headerClass ?? 'primary' }} text-white">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if(isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .modal.modal-toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: auto;
        max-width: 400px;
        z-index: 1055; /* Valor alto para garantir sobreposição */
    }

    .modal.modal-toast .modal-dialog {
        margin: 0;
    }

    .modal.modal-toast .modal-content {
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal.modal-toast .modal-header {
        border-bottom: none;
    }

    .modal.modal-toast .modal-body {
        font-size: 0.9rem;
    }
</style>
