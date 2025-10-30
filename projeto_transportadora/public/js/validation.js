document.addEventListener('DOMContentLoaded', function () {
    function maskCpf(value) {
        return value.replace(/\D/g, '');
    }

    function basicValidateForm(form) {
        const inputs = form.querySelectorAll('input[required]');
        for (const input of inputs) {
            if (!input.value.trim()) {
                alert('Por favor preencha o campo: ' + (input.name || input.id));
                input.focus();
                return false;
            }
        }
        return true;
    }

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            // aplica validação básica
            if (!basicValidateForm(form)) {
                e.preventDefault();
            }
        });
    });
});