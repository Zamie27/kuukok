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

/**
 * Article Specific Features
 * Progress Bar, Table of Contents, Syntax Highlight, Share Buttons.
 */
function initArticleFeatures() {
    // 1. Reading Progress Bar
    const progressBar = document.getElementById("progressBar");
    if (progressBar) {
        window.addEventListener("scroll", () => {
            const windowHeight = window.innerHeight;
            const documentHeight =
                document.documentElement.scrollHeight - windowHeight;
            const scrolled = window.pageYOffset;
            const progress = (scrolled / documentHeight) * 100;
            progressBar.style.width = progress + "%";
        });
    }

    // 2. Table of Contents Active State
    const tocLinks = document.querySelectorAll(".toc a");
    const sections = document.querySelectorAll("section[id]");

    if (tocLinks.length > 0 && sections.length > 0) {
        window.addEventListener("scroll", () => {
            let current = "";
            // Use middle of screen for better active state detection
            const checkPoint = window.pageYOffset + window.innerHeight / 3;

            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                // const sectionHeight = section.clientHeight;
                if (checkPoint >= sectionTop) {
                    current = section.getAttribute("id");
                }
            });

            tocLinks.forEach((link) => {
                link.classList.remove("active");
                if (link.getAttribute("href") === "#" + current) {
                    link.classList.add("active");
                }
            });
        });
    }

    // 3. Smooth Scroll for Anchor Links (TOC)
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href");
            if (targetId === "#") return;

            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // 4. Syntax Highlighting
    if (typeof hljs !== "undefined") {
        document.querySelectorAll("pre code").forEach((block) => {
            hljs.highlightElement(block);
        });
    }

    // 5. Share Buttons
    document.querySelectorAll(".share-button").forEach((button) => {
        button.addEventListener("click", function () {
            const title = document.title;
            const url = window.location.href;

            if (this.title.includes("Facebook")) {
                window.open(
                    `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                        url
                    )}`,
                    "_blank"
                );
            } else if (this.title.includes("Twitter")) {
                window.open(
                    `https://twitter.com/intent/tweet?url=${encodeURIComponent(
                        url
                    )}&text=${encodeURIComponent(title)}`,
                    "_blank"
                );
            } else if (this.title.includes("WhatsApp")) {
                window.open(
                    `https://wa.me/?text=${encodeURIComponent(
                        title + " " + url
                    )}`,
                    "_blank"
                );
            } else if (this.title.includes("Copy")) {
                navigator.clipboard.writeText(url).then(() => {
                    // Could use a toast notification here
                    // alert('Link berhasil disalin!');
                    const originalTitle = this.getAttribute("title");
                    this.setAttribute("data-tip", "Copied!");
                    // Reset after 2s if using tooltip
                });
            }
        });
    });
}

/**
 * Portfolio Filter Logic
 * Handles filtering of portfolio items based on category.
 */
function initPortfolioFilter() {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const portfolioItems = document.querySelectorAll(".portfolio-item");

    if (filterButtons.length === 0 || portfolioItems.length === 0) return;

    filterButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            // Remove active class from all buttons
            filterButtons.forEach((b) => {
                b.classList.remove("btn-primary");
                b.classList.add("btn-outline");
            });

            // Add active class to clicked button
            btn.classList.remove("btn-outline");
            btn.classList.add("btn-primary");

            const filterValue = btn.getAttribute("data-filter");

            portfolioItems.forEach((item) => {
                // Reset animation
                item.classList.remove("animate-fade-up");
                void item.offsetWidth; // Trigger reflow

                if (
                    filterValue === "all" ||
                    item.getAttribute("data-category") === filterValue
                ) {
                    item.classList.remove("hidden");
                    item.classList.add("block");
                    item.classList.add("animate-fade-up");
                } else {
                    item.classList.add("hidden");
                    item.classList.remove("block");
                }
            });
        });
    });
}

/**
 * Lightbox Logic
 * Handles image gallery lightbox functionality
 */
function initLightbox() {
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const galleryItems = document.querySelectorAll(
        ".group.relative.overflow-hidden.rounded-xl.bg-base-200.aspect-video"
    );

    if (!lightbox || !lightboxImg || galleryItems.length === 0) return;

    let currentIndex = 0;
    const images = [];

    // Collect all image sources
    galleryItems.forEach((item, index) => {
        const img = item.querySelector("img");
        if (img) {
            images.push(img.src);
            // Attach click event via JS instead of inline onclick if desired,
            // but we'll support the inline calls by exposing functions globally for now
            // or we can override the inline behavior here.

            // Let's attach event listener properly and ignore inline onclick if possible,
            // but to be safe and match the view I wrote:
            item.onclick = (e) => {
                e.preventDefault();
                openLightbox(index);
            };
        }
    });

    // Expose functions to global scope for inline onclick handlers (if any remain)
    window.openLightbox = (index) => {
        currentIndex = index;
        updateLightboxImage();
        lightbox.classList.add("active");
        document.body.style.overflow = "hidden";
    };

    window.closeLightbox = (e) => {
        if (
            e.target !== lightboxImg &&
            e.target !== document.querySelector(".lightbox-next") &&
            e.target !== document.querySelector(".lightbox-prev")
        ) {
            lightbox.classList.remove("active");
            document.body.style.overflow = "auto";
        }
    };

    window.changeImage = (direction, e) => {
        if (e) e.stopPropagation();
        currentIndex += direction;
        if (currentIndex >= images.length) currentIndex = 0;
        if (currentIndex < 0) currentIndex = images.length - 1;
        updateLightboxImage();
    };

    function updateLightboxImage() {
        lightboxImg.src = images[currentIndex];
    }

    // Close on Escape key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && lightbox.classList.contains("active")) {
            lightbox.classList.remove("active");
            document.body.style.overflow = "auto";
        }
        if (lightbox.classList.contains("active")) {
            if (e.key === "ArrowRight") window.changeImage(1);
            if (e.key === "ArrowLeft") window.changeImage(-1);
        }
    });
}
