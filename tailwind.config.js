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
                    primary: "#38BDF8",
                    "primary-focus": "#0EA5E9",
                    secondary: "#64748B",
                    "secondary-content": "#FFFFFF",
                    accent: "#FACC15",
                    neutral: "#0F172A",
                    "base-100": "#F1F5F9",
                    "base-200": "#CBD5E1",
                    "base-300": "#94A3B8",
                    "base-content": "#0F172A",
                    info: "#3abff8",
                    success: "#36d399",
                    warning: "#fbbd23",
                    error: "#f87272",
                },
                dark: {
                    primary: "#38BDF8",
                    "primary-focus": "#0EA5E9",
                    secondary: "#64748B",
                    "secondary-content": "#FFFFFF",
                    accent: "#2dd4bf",
                    neutral: "#0F172A",
                    "base-100": "#0F172A",
                    "base-200": "#1E293B",
                    "base-300": "#334155",
                    "base-content": "#FFFFFF",
                  info: "#3abff8",
                    success: "#36d399",
                    warning: "#fbbd23",
                    error: "#f87272",
                },
            },
        ],
    },
};
