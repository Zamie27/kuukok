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
