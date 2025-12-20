// Theme toggle using localStorage key 'kuukok-theme'
// Applies DaisyUI theme by setting `data-theme` on <html>
document.addEventListener("DOMContentLoaded", () => {
    const KEY = "kuukok-theme";
    const root = document.documentElement; // <html>
    const btn = document.getElementById("themeToggleBtn");

    // Initialize theme from storage or prefers-color-scheme
    const stored = localStorage.getItem(KEY);

    const prefersDark =
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches;
    const initial = stored || (prefersDark ? "dark" : "light");
    root.setAttribute("data-theme", initial);
    if (initial === "dark") root.classList.add("dark");
    else root.classList.remove("dark");

    if (btn) {
        btn.addEventListener("click", () => {
            const current = root.getAttribute("data-theme") || "light";
            const next = current === "light" ? "dark" : "light";
            root.setAttribute("data-theme", next);
            if (next === "dark") root.classList.add("dark");
            else root.classList.remove("dark");
            localStorage.setItem(KEY, next);
        });
    }

    // Auto-scrolling horizontal carousel for testimonials (seamless)
    const track = document.getElementById("testimoniCarousel");
    if (track) {
        /**
         * Duplicate original cards to create a seamless marquee.
         * Loop scrollLeft across the width of the original set.
         * Pause on hover/touch for manual interaction.
         */
        const prefersReduced = window.matchMedia(
            "(prefers-reduced-motion: reduce)"
        ).matches;
        const originals = Array.from(track.children);
        const clones = originals.map((node) => node.cloneNode(true));
        clones.forEach((node) => track.appendChild(node));

        const measureOriginalWidth = () => {
            let total = 0;
            originals.forEach((el) => {
                const styles = getComputedStyle(el);
                const ml = parseFloat(styles.marginLeft) || 0;
                const mr = parseFloat(styles.marginRight) || 0;
                total += el.offsetWidth + ml + mr;
            });
            return total;
        };

        let baseWidth = measureOriginalWidth();
        let rafId = null;
        let speed = 0.6; // px/frame (~36px/s) untuk mobile yang lebih halus
        let direction = 1; // 1: kiri →, -1: kanan ←
        let lastFlip = performance.now();
        const flipInterval = 8000; // ganti arah setiap 8 detik

        const step = (ts) => {
            // Flip arah secara berkala
            if (ts - lastFlip >= flipInterval) {
                direction *= -1;
                lastFlip = ts;
            }
            // Update scroll
            track.scrollLeft += speed * direction;
            // Wrap seamless untuk kedua arah
            if (track.scrollLeft >= baseWidth) track.scrollLeft -= baseWidth;
            if (track.scrollLeft < 0) track.scrollLeft += baseWidth;
            rafId = requestAnimationFrame(step);
        };
        const start = () => {
            if (!rafId && !prefersReduced) {
                baseWidth = measureOriginalWidth();
                rafId = requestAnimationFrame(step);
            }
        };
        const stop = () => {
            if (rafId) {
                cancelAnimationFrame(rafId);
                rafId = null;
            }
        };
        // Dots indicator
        const dots = Array.from(document.querySelectorAll(".testimoni__dot"));
        const updateDots = () => {
            // Estimasi index berdasarkan posisi dalam set asli
            const approxWidth =
                originals[0]?.offsetWidth +
                    (parseFloat(getComputedStyle(originals[0]).marginLeft) ||
                        0) +
                    (parseFloat(getComputedStyle(originals[0]).marginRight) ||
                        0) || 1;
            const pos = track.scrollLeft % baseWidth;
            const index = Math.round(pos / approxWidth) % originals.length;
            dots.forEach((d, i) => {
                if (i === index) d.classList.add("testimoni__dot--active");
                else d.classList.remove("testimoni__dot--active");
            });
        };
        track.addEventListener(
            "scroll",
            () => {
                requestAnimationFrame(updateDots);
            },
            { passive: true }
        );
        // Start animation
        updateDots();
        // Pause on hover
        track.addEventListener("mouseenter", stop);
        track.addEventListener("touchstart", stop, { passive: true });
        track.addEventListener("touchend", start, { passive: true });
        window.addEventListener("resize", () => {
            baseWidth = measureOriginalWidth();
            requestAnimationFrame(updateDots);
        });

        // Klik dots untuk navigasi manual
        dots.forEach((dot, i) => {
            dot.addEventListener("click", () => {
                const approxWidth =
                    originals[0]?.offsetWidth +
                        (parseFloat(
                            getComputedStyle(originals[0]).marginLeft
                        ) || 0) +
                        (parseFloat(
                            getComputedStyle(originals[0]).marginRight
                        ) || 0) || 1;
                track.scrollTo({ left: i * approxWidth, behavior: "smooth" });
            });
        });
        track.addEventListener("touchend", start);
    }
});
