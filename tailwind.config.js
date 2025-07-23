// tailwind.config.js untuk v4
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#f5fbff",
                secondary: "#062749";
                "custom-yellow": "F3BA00",
                "custom-blue": "#82BEE0",
                navy: {
                    50: "#f0f4f8",
                    100: "#d9e7f2",
                    200: "#b3cfe5",
                    300: "#8cb7d8",
                    400: "#669fcb",
                    500: "#4087be",
                    600: "#336fa1",
                    700: "#265784",
                    800: "#1a3f67",
                    900: "#062749",
                },
            },
            fontFamily: {
                heading: ["Plus Jakarta Sans", "sans-serif"],
                body: ["Nunito", "sans-serif"],
            },
        },
    },
};
