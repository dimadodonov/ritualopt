export default () => {
    function login() {
        const loginForm = document.getElementById('login');
        const registerForm = document.getElementById('register');

        if (loginForm) {
            const wcNoticesWrap = document.querySelector(
                '.woocommerce-notices-wrapper'
            );
            if (localStorage.getItem('register') !== null) {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
            } else {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
            }
            document
                .querySelector('.login-link-reg')
                .addEventListener('click', () => {
                    loginForm.classList.remove('active');
                    registerForm.classList.add('active');
                    localStorage.setItem('register', 'yes');
                });

            document
                .querySelector('.login-link-login')
                .addEventListener('click', () => {
                    loginForm.classList.add('active');
                    registerForm.classList.remove('active');
                    localStorage.removeItem('register');
                    wcNoticesWrap.innerHTML = '';
                });
        }
    }
    login();
};
