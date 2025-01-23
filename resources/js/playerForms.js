import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    console.log('JavaScript carregado e DOM pronto!');

    const form = document.getElementById('playerForm');
    console.log('Formulário encontrado:', form);

    if (!form) {
        console.error('Formulário não encontrado!');
        return;
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        console.log('Evento submit capturado!');

        const formData = new FormData(form);
        console.log('Dados do formulário:', Object.fromEntries(formData));

        try {
            const response = await axios.post(form.action, formData);
            console.log('Resposta do back-end:', response);

            alert('Jogador criado com sucesso!');
            window.location.href = '/players'; // Redireciona após sucesso
        } catch (error) {
            console.log('Erro no envio:', error);

            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;

                const errorList = Object.values(errors)
                    .map(messages => messages.map(msg => `<li>${msg}</li>`).join(''))
                    .join('');

                const errorMessages = document.getElementById('errorMessages');
                if (errorMessages) {
                    errorMessages.innerHTML = `<ul>${errorList}</ul>`;
                }

                const errorModalElement = document.getElementById('errorModal');
                if (errorModalElement) {
                    const errorModal = new bootstrap.Modal(errorModalElement);
                    errorModal.show();
                }
            } else {
                alert('Erro inesperado. Tente novamente mais tarde.');
            }
        }
    });
});
