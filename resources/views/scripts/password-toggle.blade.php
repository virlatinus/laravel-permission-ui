<script>
    document.querySelectorAll('.js-password-toggle').forEach((passwordToggle, key) => {
        passwordToggle.addEventListener('change', function(e) {
            const parent = e.currentTarget.closest('.password-field');

            if (!parent) return;

            const password = parent.querySelector('.js-password'),
                passwordLabel = parent.querySelector('.js-password-label')

            if (password.type === 'password') {
                password.type = 'text'
                passwordLabel.innerHTML = 'hide'
            } else {
                password.type = 'password'
                passwordLabel.innerHTML = 'show'
            }

            password.focus()
        })
    })
</script>
