// js for nav (change color when scroll)
document.addEventListener('scroll', () => {
    const nav = document = document.querySelector('nav');

    if (window.scrollY > 150) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
}); 

