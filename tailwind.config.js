import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    // enable class-based dark mode so templates can toggle .dark on <html>
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // theme-aware colors backed by CSS variables
                "theme-bg": "var(--bg)",
                "theme-card": "var(--card-bg)",
                "theme-card-2": "var(--card-bg-2)",
                "theme-fg": "var(--fg)",
                "theme-muted": "var(--muted)",
                "theme-border": "var(--border)",
                "theme-icon": "var(--icon)",
            },
        },
    },

    plugins: [forms],
};
