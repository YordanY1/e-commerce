document.addEventListener('DOMContentLoaded', () => {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const pageContent = document.querySelector('.page-content');

    navbarToggler.addEventListener('click', () => {
        if (navbarToggler.classList.contains('collapsed')) {
            pageContent.classList.add('blur-when-active');
        } else {
            pageContent.classList.remove('blur-when-active');
        }
    });
});
