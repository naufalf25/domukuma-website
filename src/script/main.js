document.addEventListener('DOMContentLoaded', () => {
    const password = document.querySelector('#password');
    const showPassword = document.querySelector('#showPassword');
    showPassword.addEventListener('change', () => {
        if (showPassword.checked) {
            console.log(true);
            password.type = 'text';
        } else {
            password.type = 'password';
            console.log(false);
        };
    });
})