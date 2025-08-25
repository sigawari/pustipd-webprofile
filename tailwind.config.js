// tailwind.config.js untuk v3 (bukan v4)
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/**/*.php",
        "./node_modules/flowbite/**/*.js", // jika menggunakan flowbite
    ],
    theme: {
        extend: {
            colors: {
                primary: "#f5fbff",
                secondary: "#062749",
                "custom-yellow": "#F3BA00", // Tambahkan # yang hilang
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
            // Tambahkan konfigurasi untuk dropdown yang lebih baik
            zIndex: {
                60: "60",
                70: "70",
                80: "80",
                90: "90",
                100: "100",
            },
            transitionProperty: {
                height: "height",
                spacing: "margin, padding",
            },
        },
    },
    plugins: [
        // Uncomment jika menggunakan plugins ini
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
        // require('flowbite/plugin'),
    ],
    // Tambahkan safelist untuk class yang mungkin tidak terdeteksi
    safelist: [
        "opacity-0",
        "opacity-100",
        "pointer-events-none",
        "pointer-events-auto",
        "transform",
        "translate-y-0",
        "-translate-y-2",
        "group-hover:opacity-100",
        "group-hover:pointer-events-auto",
        "bg-gray-800",
        "bg-white",
        "text-secondary",
        "text-white",
        "hover:bg-gray-700",
        "hover:bg-gray-100",
        "rotate-180",
    ],
};
