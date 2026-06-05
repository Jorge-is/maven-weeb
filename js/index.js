(function () {
    const toggle  = document.querySelector('.nav-toggle');
    const close   = document.querySelector('.nav-close');
    const lateral = document.querySelector('.nav-lateral');
    const overlay = document.querySelector('.nav-overlay');

    if (!toggle || !lateral) return;

    function openNav() {
        lateral.classList.add('nav-lateral--open');
        lateral.setAttribute('aria-hidden', 'false');
        if (overlay) overlay.classList.add('nav-overlay--visible');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        if (close) close.focus();
    }

    function closeNav() {
        lateral.classList.remove('nav-lateral--open');
        lateral.setAttribute('aria-hidden', 'true');
        if (overlay) overlay.classList.remove('nav-overlay--visible');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        toggle.focus();
    }

    toggle.addEventListener('click', openNav);
    if (close)   close.addEventListener('click', closeNav);
    if (overlay) overlay.addEventListener('click', closeNav);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lateral.classList.contains('nav-lateral--open')) {
            closeNav();
        }
    });
})();
