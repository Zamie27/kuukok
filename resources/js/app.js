import "./admin/profile-form";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// Core logic
document.addEventListener("DOMContentLoaded", () => {
    initTheme();
    initScrollAnimations();
    initScrollToTop();
    initArticleFeatures();
    initPortfolioFilter();
    initLightbox();
    initTestimonialMarquee();
});

/**
 * Theme Toggle System
 * Uses localStorage key 'kuukok-theme' and sets 'data-theme' on html element.
 * Optimized for <100ms transition.
 */
function initTheme() {
    const KEY = "kuukok-theme";
    const root = document.documentElement;
    const btn = document.getElementById("themeToggleBtn");

    // Helper to set theme
    const setTheme = (theme) => {
        root.setAttribute("data-theme", theme);
        if (theme === "dark") {
            root.classList.add("dark");
        } else {
            root.classList.remove("dark");
        }
        localStorage.setItem(KEY, theme);
    };

    // Initialize
    const stored = localStorage.getItem(KEY);
    const prefersDark =
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches;
    const initial = stored || (prefersDark ? "dark" : "light");

    // Set initial theme immediately
    setTheme(initial);

    // Event Listener
    if (btn) {
        btn.addEventListener("click", () => {
            // Get current theme from attribute to ensure accuracy
            const current = root.getAttribute("data-theme") || "light";
            const next = current === "light" ? "dark" : "light";
            setTheme(next);
        });
    }
}

/**
 * Scroll Reveal Animations
 * Uses Intersection Observer for performance.
 */
function initScrollAnimations() {
    const revealElements = document.querySelectorAll(".reveal-on-scroll");

    if (revealElements.length === 0) return;

    const revealObserver = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            root: null,
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        }
    );

    revealElements.forEach((el) => revealObserver.observe(el));
}

function initTestimonialMarquee() {
    const marquees = document.querySelectorAll('.animate-marquee');
    if (marquees.length === 0) return;
    const SPEED_PX_PER_SEC = 120;
    const compute = () => {
        marquees.forEach((el) => {
            const width = el.scrollWidth || el.offsetWidth;
            const distance = width * 0.5;
            const MIN_DURATION = 45;
            const MAX_DURATION = 180;
            const raw = Math.round(distance / SPEED_PX_PER_SEC);
            const duration = Math.min(MAX_DURATION, Math.max(MIN_DURATION, raw));
            el.style.setProperty('--marquee-duration', duration + 's');
        });
    };
    compute();
    window.addEventListener('resize', compute, { passive: true });
    window.addEventListener('load', compute, { once: true });
}

/**
 * Scroll to Top Button
 * Shared across pages.
 */
function initScrollToTop() {
    const scrollBtn = document.getElementById("scrollToTop");

    if (!scrollBtn) return;

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            scrollBtn.classList.remove("hidden");
        } else {
            scrollBtn.classList.add("hidden");
        }
    });

    scrollBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
}

// Placeholder for other initializations
function initArticleFeatures() {}
function initPortfolioFilter() {}
function initLightbox() {}
