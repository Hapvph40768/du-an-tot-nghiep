import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "7bd01360a41ef9c3019c",
    cluster: "ap1",
    forceTLS: true
});

// App Store Style Animations & Smoothness
document.addEventListener('DOMContentLoaded', () => {
    // 1. Reveal on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // 2. Handle button click scale effect (extra insurance)
    document.querySelectorAll('button, a.btn, .clickable').forEach(button => {
        button.addEventListener('touchstart', () => {
            button.style.transform = 'scale(0.96)';
        });
        button.addEventListener('touchend', () => {
            button.style.transform = 'scale(1)';
        });
    });
});

// Handle Cross-Document View Transitions (for browsers that need a hint)
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        // Force refresh if needed on back/forward
    }
});