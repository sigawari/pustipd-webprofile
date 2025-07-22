/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: ["font-heading", "font-body"],
    theme: {
        extend: {
            fontFamily: {
                heading: ['"Plus Jakarta Sans"', "sans-serif"],
                body: ["Nunito", "sans-serif"],
            },
            backgroundColor: {
                darkBlue: "#001f3f",
            },
        },
    },
    plugins: [],
};
