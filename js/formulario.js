document.getElementById('form-contato').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const btn = document.getElementById('btn-submit');
    const spanText = btn.querySelector('.btn-text');

    btn.classList.remove('success', 'error');
    spanText.classList.remove('success', 'error');

    btn.classList.add('loading');

    const formData = new FormData(form);

    fetch('send_email.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        spanText.textContent = data.message;
        btn.classList.remove('loading');

        if(data.status === 'success') {
            btn.classList.add('success');
            spanText.classList.add('success');
            setTimeout(() => {
                form.reset();
                spanText.textContent = 'ENVIAR';
                btn.classList.remove('success');
                spanText.classList.remove('success');
            }, 2000);
        } else {
            btn.classList.add('error');
            spanText.classList.add('error');
            setTimeout(() => {
                spanText.textContent = 'ENVIAR';
                btn.classList.remove('error');
                spanText.classList.remove('error');
            }, 3000);
        }
    })
    .catch(err => {
        spanText.textContent = 'ERRO AO ENVIAR';
        btn.classList.remove('loading');
        btn.classList.add('error');
        spanText.classList.add('error');
        setTimeout(() => {
            spanText.textContent = 'ENVIAR';
            btn.classList.remove('error');
            spanText.classList.remove('error');
        }, 3000);
    });
});