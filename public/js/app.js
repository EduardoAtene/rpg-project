document.addEventListener('DOMContentLoaded', function () {
    function showToast(message, type = 'success') {
        const toastContainer = document.querySelector('.toast-container');
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white ${type === 'error' ? 'toast-error' : 'toast-success'}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        toastContainer.appendChild(toast);
        const bootstrapToast = new bootstrap.Toast(toast);
        bootstrapToast.show();

        setTimeout(() => {
            bootstrapToast.hide();
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }, 5000);
    }

    function handleFormSubmit(formId, redirectUrl) {
        const form = document.getElementById(formId);

        if (!form) {
            return;
        }

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            const formData = new FormData(form);

            try {
                const response = await axios({
                    method: form.method,
                    url: form.action,
                    data: formData
                });

                if (response.status >= 200 && response.status < 300 && response.data.message) {
                    showToast(response.data.message, 'success');
                    setTimeout(() => {
                        if (redirectUrl) {
                            window.location.href = redirectUrl;
                        }
                    }, 3000);
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                    const errorList = Object.values(errors).map(messages => messages.join('')).join('<br>');
                    showToast(errorList, 'error');
                } else {
                    showToast('Erro inesperado. Tente novamente mais tarde.', 'error');
                }
            }
        });
    }

    handleFormSubmit('playerForm', '/players');
    handleFormSubmit('editPlayerForm', '/players');
    handleFormSubmit('sessionForm', '/sessions');
    handleFormSubmit('editSessionForm', '/sessions');
});
