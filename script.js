function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var passwordToggle = document.getElementById('password-toggle');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('glyphicon-eye-open');
        passwordToggle.classList.add('glyphicon-eye-close');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('glyphicon-eye-close');
        passwordToggle.classList.add('glyphicon-eye-open');
    }
}