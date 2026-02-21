/**
 * Main Javascript for NIKABETON Theme
 */

document.addEventListener('DOMContentLoaded', function () {

    // 1. Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');

    if (menuToggle && mainNavigation) {
        menuToggle.addEventListener('click', function () {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            mainNavigation.classList.toggle('toggled');
        });
    }

    // 2. Smooth Scrolling for anchor links (e.g., #order, #services)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const element = document.querySelector(targetId);
            if (element) {
                e.preventDefault();
                element.scrollIntoView({
                    behavior: 'smooth'
                });
                // Close mobile menu if open
                if (mainNavigation && mainNavigation.classList.contains('toggled')) {
                    mainNavigation.classList.remove('toggled');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });

    // 3. Concrete Volume Calculator Logic
    const calcBtn = document.getElementById('calc-btn');
    if (calcBtn) {
        calcBtn.addEventListener('click', function () {
            const length = parseFloat(document.getElementById('calc-length').value);
            const width = parseFloat(document.getElementById('calc-width').value);
            const depth = parseFloat(document.getElementById('calc-depth').value);

            if (isNaN(length) || isNaN(width) || isNaN(depth)) {
                alert('Будь ласка, введіть всі розміри (в метрах).');
                return;
            }

            // Calculate Volume (V = L * W * D)
            const volume = length * width * depth;

            // Format to 2 decimal places
            document.getElementById('calc-volume').textContent = volume.toFixed(2);

            // Show result
            document.getElementById('calc-result').classList.remove('hidden');
        });
    }

});
