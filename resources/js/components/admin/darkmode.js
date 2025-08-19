/**
 * Admin Dark Mode Management
 * Handles theme switching only for admin pages
 */

// Check if current page is admin
function isAdminPage() {
    return (
        window.location.pathname.includes("/admin") ||
        document.body.classList.contains("admin-page") ||
        document.querySelector("[data-admin-page]") !== null ||
        document.querySelector(".admin-layout") !== null
    );
}

// Alpine.js Dark Mode Component (Admin Only)
document.addEventListener("alpine:init", () => {
    Alpine.data("darkModeHandler", () => ({
        darkMode: false,
        isAdmin: false,

        init() {
            // Only initialize on admin pages
            this.isAdmin = isAdminPage();

            if (!this.isAdmin) {
                console.log("🚫 Dark mode disabled - not an admin page");
                return;
            }

            console.log("🎨 Initializing admin dark mode...");
            this.darkMode = this.getInitialTheme();
            this.updateTheme();
            this.bindSystemThemeListener();
        },

        getInitialTheme() {
            if (!this.isAdmin) return false;

            // Check for saved admin theme preference
            const savedTheme = localStorage.getItem("admin-theme");
            if (savedTheme) {
                return savedTheme === "dark";
            }

            // Default to light for admin (don't follow system)
            return false;
        },

        toggleDarkMode() {
            if (!this.isAdmin) {
                console.warn(
                    "🚫 Dark mode toggle disabled - not an admin page"
                );
                return;
            }

            this.darkMode = !this.darkMode;
            this.updateTheme();
            this.saveTheme();
            this.dispatchThemeChangeEvent();
        },

        updateTheme() {
            if (!this.isAdmin) return;

            // Only apply to admin containers
            const adminContainers = [
                document.querySelector(".admin-layout"),
                document.querySelector("[data-admin-page]"),
                document.querySelector(".admin-container"),
                document.body.classList.contains("admin-page")
                    ? document.body
                    : null,
            ].filter(Boolean);

            if (adminContainers.length === 0) {
                // Fallback: apply to body only if we're sure it's admin
                if (isAdminPage()) {
                    adminContainers.push(document.body);
                }
            }

            adminContainers.forEach((container) => {
                if (this.darkMode) {
                    container.classList.add("dark");
                } else {
                    container.classList.remove("dark");
                }
            });

            // Update meta theme-color only for admin
            this.updateMetaThemeColor();
        },

        updateMetaThemeColor() {
            if (!this.isAdmin) return;

            let metaThemeColor = document.querySelector(
                'meta[name="admin-theme-color"]'
            );
            if (!metaThemeColor) {
                metaThemeColor = document.createElement("meta");
                metaThemeColor.name = "admin-theme-color";
                document.head.appendChild(metaThemeColor);
            }

            metaThemeColor.content = this.darkMode ? "#0f172a" : "#f5fbff";
        },

        saveTheme() {
            if (!this.isAdmin) return;
            localStorage.setItem(
                "admin-theme",
                this.darkMode ? "dark" : "light"
            );
        },

        bindSystemThemeListener() {
            if (!this.isAdmin) return;

            // For admin, we don't follow system theme by default
            // Only listen if user hasn't set a preference
            window
                .matchMedia("(prefers-color-scheme: dark)")
                .addEventListener("change", (e) => {
                    if (!localStorage.getItem("admin-theme")) {
                        this.darkMode = false; // Keep admin light by default
                        this.updateTheme();
                    }
                });
        },

        dispatchThemeChangeEvent() {
            const event = new CustomEvent("themeChanged", {
                detail: {
                    darkMode: this.darkMode,
                    theme: this.darkMode ? "dark" : "light",
                },
            });
            window.dispatchEvent(event);
        },

        // Public methods for external access
        getCurrentTheme() {
            return this.isAdmin ? (this.darkMode ? "dark" : "light") : "light";
        },

        setTheme(theme) {
            if (!this.isAdmin) {
                console.warn("🚫 Cannot set theme - not an admin page");
                return;
            }

            this.darkMode = theme === "dark";
            this.updateTheme();
            this.saveTheme();
            this.dispatchThemeChangeEvent();
        },
    }));
});

// Vanilla JavaScript Admin Dark Mode Manager
class AdminDarkModeManager {
    constructor() {
        this.isAdmin = isAdminPage();

        if (!this.isAdmin) {
            console.log(
                "🚫 Admin Dark Mode Manager disabled - not an admin page"
            );
            return;
        }

        console.log("🎨 Initializing Admin Dark Mode Manager...");
        this.darkMode = this.getInitialTheme();
        this.callbacks = [];
        this.init();
    }

    getInitialTheme() {
        if (!this.isAdmin) return false;

        const savedTheme = localStorage.getItem("admin-theme");
        if (savedTheme) {
            return savedTheme === "dark";
        }

        // Default to light for admin
        return false;
    }

    init() {
        if (!this.isAdmin) return;

        this.updateTheme();
        this.bindEvents();
        this.bindSystemThemeListener();
    }

    bindEvents() {
        if (!this.isAdmin) return;

        // Bind to admin dark mode toggle buttons
        const toggleButtons = document.querySelectorAll(
            "[data-admin-dark-mode-toggle]"
        );
        toggleButtons.forEach((button) => {
            button.addEventListener("click", () => this.toggle());
        });

        // Admin-specific keyboard shortcut (Ctrl/Cmd + Shift + A + D)
        document.addEventListener("keydown", (e) => {
            if (
                (e.ctrlKey || e.metaKey) &&
                e.shiftKey &&
                e.key === "D" &&
                e.altKey
            ) {
                e.preventDefault();
                this.toggle();
            }
        });
    }

    bindSystemThemeListener() {
        if (!this.isAdmin) return;

        // Admin doesn't follow system theme by default
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (e) => {
                // Only react if no admin preference is set
                if (!localStorage.getItem("admin-theme")) {
                    this.darkMode = false; // Keep admin light
                    this.updateTheme();
                    this.notifyCallbacks();
                }
            });
    }

    toggle() {
        if (!this.isAdmin) {
            console.warn("🚫 Cannot toggle theme - not an admin page");
            return;
        }

        this.darkMode = !this.darkMode;
        this.updateTheme();
        this.saveTheme();
        this.dispatchThemeChangeEvent();
        this.notifyCallbacks();
    }

    updateTheme() {
        if (!this.isAdmin) return;

        // Target only admin containers
        const adminSelectors = [
            ".admin-layout",
            "[data-admin-page]",
            ".admin-container",
            ".admin-dashboard",
            "body.admin-page",
        ];

        let adminContainers = [];
        adminSelectors.forEach((selector) => {
            const elements = document.querySelectorAll(selector);
            adminContainers.push(...elements);
        });

        // Fallback to body if no specific admin containers found
        if (adminContainers.length === 0 && isAdminPage()) {
            adminContainers.push(document.body);
        }

        adminContainers.forEach((container) => {
            if (this.darkMode) {
                container.classList.add("dark");
            } else {
                container.classList.remove("dark");
            }
        });

        this.updateMetaThemeColor();
    }

    updateMetaThemeColor() {
        if (!this.isAdmin) return;

        let metaThemeColor = document.querySelector(
            'meta[name="admin-theme-color"]'
        );
        if (!metaThemeColor) {
            metaThemeColor = document.createElement("meta");
            metaThemeColor.name = "admin-theme-color";
            document.head.appendChild(metaThemeColor);
        }

        metaThemeColor.content = this.darkMode ? "#0f172a" : "#f5fbff";
    }

    saveTheme() {
        if (!this.isAdmin) return;
        localStorage.setItem("admin-theme", this.darkMode ? "dark" : "light");
    }

    dispatchThemeChangeEvent() {
        if (!this.isAdmin) return;

        const event = new CustomEvent("adminThemeChanged", {
            detail: {
                darkMode: this.darkMode,
                theme: this.darkMode ? "dark" : "light",
                scope: "admin",
            },
        });
        window.dispatchEvent(event);
    }

    // Public API
    getCurrentTheme() {
        return this.isAdmin ? (this.darkMode ? "dark" : "light") : "light";
    }

    setTheme(theme) {
        if (!this.isAdmin) {
            console.warn("🚫 Cannot set theme - not an admin page");
            return;
        }

        this.darkMode = theme === "dark";
        this.updateTheme();
        this.saveTheme();
        this.dispatchThemeChangeEvent();
        this.notifyCallbacks();
    }

    isDarkMode() {
        return this.isAdmin ? this.darkMode : false;
    }

    // Callback system for admin components
    onThemeChange(callback) {
        if (this.isAdmin) {
            this.callbacks.push(callback);
        }
    }

    notifyCallbacks() {
        if (!this.isAdmin) return;

        this.callbacks.forEach((callback) => {
            callback(this.darkMode, this.getCurrentTheme());
        });
    }
}

// Auto-initialize only for admin pages
if (isAdminPage()) {
    if (typeof Alpine === "undefined") {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", () => {
                window.adminDarkModeManager = new AdminDarkModeManager();
            });
        } else {
            window.adminDarkModeManager = new AdminDarkModeManager();
        }
    }
} else {
    console.log("🚫 Skipping dark mode initialization - not an admin page");
}

// Admin-specific utility functions
const AdminDarkModeUtils = {
    // Check if we're on an admin page
    isAdminPage() {
        return isAdminPage();
    },

    // Get current admin theme
    getCurrentTheme() {
        if (!isAdminPage()) return "light";

        if (typeof Alpine !== "undefined" && window.Alpine) {
            const alpineComponent = document.querySelector(
                '[x-data*="darkModeHandler"]'
            );
            if (alpineComponent && alpineComponent._x_dataStack) {
                return alpineComponent._x_dataStack[0].getCurrentTheme();
            }
        }

        if (window.adminDarkModeManager) {
            return window.adminDarkModeManager.getCurrentTheme();
        }

        const savedTheme = localStorage.getItem("admin-theme");
        return savedTheme || "light";
    },

    // Set admin theme programmatically
    setTheme(theme) {
        if (!isAdminPage()) {
            console.warn("🚫 Cannot set theme - not an admin page");
            return;
        }

        if (typeof Alpine !== "undefined" && window.Alpine) {
            const alpineComponent = document.querySelector(
                '[x-data*="darkModeHandler"]'
            );
            if (alpineComponent && alpineComponent._x_dataStack) {
                alpineComponent._x_dataStack[0].setTheme(theme);
                return;
            }
        }

        if (window.adminDarkModeManager) {
            window.adminDarkModeManager.setTheme(theme);
            return;
        }

        // Manual fallback for admin only
        const isDark = theme === "dark";
        const adminContainers = document.querySelectorAll(
            ".admin-layout, [data-admin-page], .admin-container, body.admin-page"
        );

        adminContainers.forEach((container) => {
            container.classList.toggle("dark", isDark);
        });

        if (adminContainers.length === 0 && isAdminPage()) {
            document.body.classList.toggle("dark", isDark);
        }

        localStorage.setItem("admin-theme", theme);
    },

    // Toggle admin theme
    toggleTheme() {
        if (!isAdminPage()) {
            console.warn("🚫 Cannot toggle theme - not an admin page");
            return;
        }

        const currentTheme = this.getCurrentTheme();
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        this.setTheme(newTheme);
    },

    // Check if admin dark mode is active
    isDarkMode() {
        return isAdminPage() && this.getCurrentTheme() === "dark";
    },
};

// Export for module usage
if (typeof module !== "undefined" && module.exports) {
    module.exports = { AdminDarkModeManager, AdminDarkModeUtils, isAdminPage };
}

// Make available globally for admin pages only
if (isAdminPage()) {
    window.AdminDarkModeUtils = AdminDarkModeUtils;
}
