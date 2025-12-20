export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Montserrat", "sans-serif"],
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [
            {
                light: {
                    primary: "#0EA5E9",
                    "primary-focus": "#0284C7",
                    secondary: "#64748B",
                    accent: "#FACC15",
                    neutral: "#0F172A",
                    "base-100": "#F8FAFC",
                    "base-200": "#E2E8F0",
                    "base-300": "#CBD5E1",
                    info: "#0EA5E9",
                    success: "#22C55E",
                    warning: "#FACC15",
                    error: "#EF4444",
                },
                dark: {
                    primary: "#0EA5E9",
                    "primary-focus": "#0284C7",
                    secondary: "#94A3B8",
                    accent: "#FACC15",
                    neutral: "#F8FAFC",
                    "base-100": "#0F172A",
                    "base-200": "#1E293B",
                    "base-300": "#334155",
                    info: "#38BDF8",
                    success: "#4ADE80",
                    warning: "#FACC15",
                    error: "#F87171",
                },
            },
        ],
    },
};
