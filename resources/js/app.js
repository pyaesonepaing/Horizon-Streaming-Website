import './bootstrap';

// simple navbar toggle example
document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("menuToggle");
    const menu = document.getElementById("mobileMenu");

    if (toggle && menu) {
        toggle.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    }
});

// simple alert auto hide
setTimeout(() => {
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach(el => el.remove());
}, 4000);