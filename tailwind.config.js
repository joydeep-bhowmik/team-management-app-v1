import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/joydeep-bhowmik/src/resources/views/components/**/*.blade.php",
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
    ],
    darkMode: ["class", '[data-theme="dark"]'],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    background: "#1a202c",
                    text: "#ffffff",
                },
                light: {
                    background: "#ffffff",
                    text: "#1a202c",
                },
            },
            borderColor: {
                DEFAULT: "#e6e6e6", // Set your desired default border color
                dark: "#4a5568", // Optional: Add a darker border for dark mode
            },
        },
    },

    plugins: [
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],

    // daisyui: {
    //     themes: [
    //         // {
    //         //     mytheme: {
    //         //         primary: "#1d4ed8",
    //         //         secondary: "#60a5fa",
    //         //         accent: "#00ffff",
    //         //         neutral: "#bae6fd",
    //         //         "base-100": "#ffffff",
    //         //         info: "#0000ff",
    //         //         success: "#00ff00",
    //         //         warning: "#00ff00",
    //         //         error: "#ff0000",
    //         //     },
    //         // },
    //         "dark", // Add the predefined DaisyUI dark theme
    //     ],
    // },
};
