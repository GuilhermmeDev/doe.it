import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import flowbitePlugin from "flowbite/plugin"; // Adicionar para Flowbite

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php", // O Laravel usa isso para o JIT em desenvolvimento, pode manter
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js", // Para Vue/React/Alpine ou JS puro
        "./node_modules/flowbite/**/*.js", // Adicionar para Flowbite'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    darkMode: "class", // Usar 'class' para dark mode

    plugins: [forms, flowbitePlugin],
};
