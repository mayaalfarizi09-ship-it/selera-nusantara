import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 700,
        easing: 'ease-out-cubic',
        once: true,
        offset: 60,
    });

    // Sticky navbar: transparent at top, solid after scroll
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        const toggleNavbar = () => {
            if (window.scrollY > 40) {
                navbar.classList.add('bg-white', 'shadow-md');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-white', 'shadow-md');
                navbar.classList.add('bg-transparent');
            }
        };
        toggleNavbar();
        window.addEventListener('scroll', toggleNavbar);
    }

    // Counter animation
    const counters = document.querySelectorAll('[data-counter]');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.counter, 10);
                let current = 0;
                const increment = Math.max(target / 60, 1);
                const step = () => {
                    current += increment;
                    if (current < target) {
                        el.textContent = Math.ceil(current).toLocaleString('id-ID');
                        requestAnimationFrame(step);
                    } else {
                        el.textContent = target.toLocaleString('id-ID');
                    }
                };
                step();
                counterObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach((c) => counterObserver.observe(c));

    // Button ripple
    document.querySelectorAll('.ripple').forEach((btn) => {
        btn.addEventListener('click', function (e) {
            const circle = document.createElement('span');
            const diameter = Math.max(this.clientWidth, this.clientHeight);
            const rect = this.getBoundingClientRect();
            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${e.clientX - rect.left - diameter / 2}px`;
            circle.style.top = `${e.clientY - rect.top - diameter / 2}px`;
            circle.classList.add('ripple-circle');
            this.appendChild(circle);
            setTimeout(() => circle.remove(), 600);
        });
    });
});
