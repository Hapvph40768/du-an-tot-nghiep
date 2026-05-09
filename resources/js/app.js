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

    // 2. Handle button click scale effect
    document.querySelectorAll('button, a.btn, .clickable, a').forEach(button => {
        button.addEventListener('mousedown', () => {
            button.style.transform = 'scale(0.96)';
            button.style.transition = 'transform 0.2s cubic-bezier(0.32, 0.72, 0, 1)';
        });
        button.addEventListener('mouseup', () => {
            button.style.transform = 'scale(1)';
        });
        button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
        });

        // 3. Pre-fetch links on hover/touch for instant navigation
        button.addEventListener('mouseenter', () => {
            if (button.tagName === 'A' && button.href && button.origin === window.location.origin) {
                const link = document.createElement('link');
                link.rel = 'prefetch';
                link.href = button.href;
                document.head.appendChild(link);
            }
        }, { once: true });
    });

    // 4. iOS Style Page Transition Interceptor
    window.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (
            link && 
            link.href && 
            link.origin === window.location.origin && 
            !link.hash && 
            link.target !== '_blank' &&
            !e.metaKey && !e.ctrlKey && !e.shiftKey && !e.altKey
        ) {
            if (document.startViewTransition) {
                e.preventDefault();
                // Apple-style: Add a slight delay for the feedback (scale) before sliding
                setTimeout(() => {
                    document.startViewTransition(async () => {
                        window.location.href = link.href;
                    });
                }, 100);
            }
        }
    });
});