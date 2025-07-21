/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./storage/framework/views/*.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                heading: ['"Plus Jakarta Sans"', "sans-serif"],
                body: ["Nunito", "sans-serif"],
            },
        },
    },
    plugins: [],
};
