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

    // 4. Modal Logic
    const modal = document.getElementById('orderModal');
    const closeBtn = document.querySelector('.close-modal');

    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });

    if (closeBtn && modal) {
        closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
        modal.addEventListener('click', function (e) {
            if (e.target === modal) modal.classList.add('hidden');
        });
    }

    // 5. AJAX Form Submission
    const forms = document.querySelectorAll('.lead-form, .order-form-modern, #globalOrderForm');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const msgBox = form.querySelector('.form-message') || document.createElement('div');

            if (!form.querySelector('.form-message')) {
                msgBox.className = 'form-message mt-2 p-2 border-radius';
                form.appendChild(msgBox);
            }

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Відправка...';
            }

            const formData = new FormData(form);
            formData.append('action', 'nikabeton_send_mail');

            fetch(nikabetonAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(response => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Відправити заявку';
                    }

                    msgBox.style.display = 'block';
                    if (response.success) {
                        msgBox.style.backgroundColor = '#d4edda';
                        msgBox.style.color = '#155724';
                        msgBox.innerHTML = response.data.message;
                        form.reset();
                        setTimeout(() => {
                            if (modal) modal.classList.add('hidden');
                            msgBox.style.display = 'none';
                        }, 4000);
                    } else {
                        msgBox.style.backgroundColor = '#f8d7da';
                        msgBox.style.color = '#721c24';
                        msgBox.innerHTML = response.data.message || 'Помилка';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Відправити заявку';
                    }
                    msgBox.style.display = 'block';
                    msgBox.style.backgroundColor = '#f8d7da';
                    msgBox.style.color = '#721c24';
                    msgBox.innerHTML = 'Виникла помилка з\'єднання.';
                });
        });
    });

});
