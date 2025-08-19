import "./bootstrap";

// Import dark mode terlebih dahulu
import "./components/admin/darkmode";

// Import file JS modular admin
import "./components/admin/ajaxSearch";
import "./components/admin/modals";
import "./components/admin/addListItem";
import "./components/admin/editListItem";
import "./components/admin/removeListItem";
import "./components/admin/saveListItem";
import "./components/admin/autoSaveTimeOut";
import "./components/admin/previewImage";
import "./components/admin/toggleVisibility";
import "./components/admin/bulk-actions";
import "./components/admin/ketetapan-action";
import "./components/admin/slug";
import "./components/admin/tutorialblock";
import "./components/admin/tutorialfeatured";

// Import Structure management
import { Structure } from "./components/admin/structure.js";

// Import komponen public
import "./components/public/bulk-download";
import {
    initShareButtons,
    shareTo,
    copyContentLink,
} from "./components/public/share.js";

// Import Quill WYSIWYG editor
import Quill from "quill";
import "quill/dist/quill.snow.css";

// Application state management
class AppManager {
    constructor() {
        this.isInitialized = false;
        this.components = new Map();
        this.quillInstances = new Map();
        this.init();
    }

    async init() {
        try {
            console.log("🚀 Initializing application...");

            // Setup global error handling
            this.setupErrorHandling();

            // Setup theme management
            this.setupThemeManagement();

            // Wait for DOM to be ready
            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", () =>
                    this.initializeComponents()
                );
            } else {
                this.initializeComponents();
            }
        } catch (error) {
            console.error("❌ Failed to initialize application:", error);
        }
    }

    initializeComponents() {
        try {
            // Initialize core components
            this.initializeGlobalFunctions();
            this.initializeQuillEditors();
            this.initializeStructureManager();

            this.isInitialized = true;
            console.log("✅ Application initialized successfully");

            // Dispatch ready event
            document.dispatchEvent(
                new CustomEvent("app:ready", {
                    detail: { appManager: this },
                })
            );
        } catch (error) {
            console.error("❌ Failed to initialize components:", error);
        }
    }

    setupErrorHandling() {
        // Global error handler
        window.addEventListener("error", (e) => {
            console.error("🚨 Global error:", {
                message: e.message,
                filename: e.filename,
                lineno: e.lineno,
                colno: e.colno,
                error: e.error,
            });
        });

        // Handle unhandled promise rejections
        window.addEventListener("unhandledrejection", (e) => {
            console.error("🚨 Unhandled promise rejection:", e.reason);
            // Prevent default browser behavior
            e.preventDefault();
        });
    }

    setupThemeManagement() {
        // Only setup theme management for admin pages
        if (!this.isAdminPage()) {
            console.log("🚫 Skipping theme management - not an admin page");
            return;
        }

        // Listen for admin theme changes to update components
        window.addEventListener("adminThemeChanged", (event) => {
            const { darkMode, theme, scope } = event.detail;
            console.log(`🎨 Admin theme changed to: ${theme}`);

            // Update Quill editors theme
            this.updateQuillTheme(darkMode);

            // Update other admin components
            this.updateComponentThemes(darkMode);
        });

        // Also listen for legacy themeChanged events in admin context
        window.addEventListener("themeChanged", (event) => {
            if (this.isAdminPage()) {
                const { darkMode, theme } = event.detail;
                console.log(`🎨 Theme changed to: ${theme} (legacy event)`);
                this.updateQuillTheme(darkMode);
                this.updateComponentThemes(darkMode);
            }
        });
    }

    isAdminPage() {
        return (
            window.location.pathname.includes("/admin") ||
            document.body.classList.contains("admin-page") ||
            document.querySelector("[data-admin-page]") !== null ||
            document.querySelector(".admin-layout") !== null
        );
    }

    initializeGlobalFunctions() {
        // Expose public functions to global scope
        window.copyContentLink = copyContentLink;
        window.shareTo = shareTo;

        // Initialize share buttons
        initShareButtons();

        // Global utilities (admin-aware)
        window.AppManager = this;
        window.AppUtils = {
            getCurrentTheme: () => {
                // For admin pages, use admin-specific theme
                if (this.isAdminPage()) {
                    if (window.AdminDarkModeUtils) {
                        return window.AdminDarkModeUtils.getCurrentTheme();
                    }
                    const savedAdminTheme = localStorage.getItem("admin-theme");
                    return savedAdminTheme || "light";
                }

                // For public pages, always return light
                return "light";
            },
            isDarkMode: () => {
                return (
                    this.isAdminPage() &&
                    window.AppUtils.getCurrentTheme() === "dark"
                );
            },
            setTheme: (theme) => {
                if (this.isAdminPage() && window.AdminDarkModeUtils) {
                    window.AdminDarkModeUtils.setTheme(theme);
                } else if (!this.isAdminPage()) {
                    console.warn("🚫 Theme setting disabled on public pages");
                }
            },
            toggleTheme: () => {
                if (this.isAdminPage() && window.AdminDarkModeUtils) {
                    window.AdminDarkModeUtils.toggleTheme();
                } else if (!this.isAdminPage()) {
                    console.warn("🚫 Theme toggle disabled on public pages");
                }
            },
            isAdminPage: () => this.isAdminPage(),
        };
    }

    initializeQuillEditors() {
        const editorElements = document.querySelectorAll(".editor");

        if (editorElements.length === 0) {
            console.log("📝 No Quill editors found");
            return;
        }

        console.log(
            `📝 Initializing ${editorElements.length} Quill editor(s)...`
        );

        editorElements.forEach((editorElem, index) => {
            try {
                const quillOptions = this.getQuillOptions(editorElem);
                const quill = new Quill(editorElem, quillOptions);

                // Store instance for later reference
                const editorId = editorElem.id || `editor-${index}`;
                this.quillInstances.set(editorId, quill);

                // Setup textarea synchronization
                this.setupQuillTextareaSync(quill, editorElem);

                console.log(`✅ Quill editor initialized: ${editorId}`);
            } catch (error) {
                console.error(`❌ Failed to initialize Quill editor:`, error);
            }
        });
    }

    getQuillOptions(editorElem) {
        // Only check dark mode for admin pages
        const isDarkMode =
            this.isAdminPage() && window.AppUtils
                ? window.AppUtils.isDarkMode()
                : false;

        return {
            theme: "snow",
            placeholder:
                editorElem.dataset.placeholder || "Tulis isi konten di sini...",
            modules: {
                toolbar: [
                    ["bold", "italic", "underline", "strike"],
                    ["blockquote", "code-block"],
                    [{ header: 1 }, { header: 2 }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ script: "sub" }, { script: "super" }],
                    [{ indent: "-1" }, { indent: "+1" }],
                    ["link", "image"],
                    ["clean"],
                ],
            },
            // Apply theme-specific options only for admin
            ...(isDarkMode &&
                {
                    // Dark mode specific configurations if needed
                }),
        };
    }

    setupQuillTextareaSync(quill, editorElem) {
        const textarea = editorElem.nextElementSibling;

        if (textarea && textarea.tagName === "TEXTAREA") {
            // Sync Quill content to textarea
            quill.on("text-change", () => {
                textarea.value = quill.root.innerHTML;

                // Dispatch change event for other listeners
                textarea.dispatchEvent(new Event("change", { bubbles: true }));
            });

            // Set initial content from textarea
            if (textarea.value.trim()) {
                quill.root.innerHTML = textarea.value;
            }

            console.log("🔄 Quill-textarea synchronization setup complete");
        }
    }

    updateQuillTheme(darkMode) {
        this.quillInstances.forEach((quill, editorId) => {
            try {
                const toolbar = quill.getModule("toolbar");
                const container = quill.container;

                if (darkMode) {
                    container.classList.add("dark");
                } else {
                    container.classList.remove("dark");
                }

                console.log(`🎨 Updated theme for Quill editor: ${editorId}`);
            } catch (error) {
                console.error(
                    `❌ Failed to update Quill theme for ${editorId}:`,
                    error
                );
            }
        });
    }

    initializeStructureManager() {
        const organizationForm = document.getElementById("organizationForm");

        if (!organizationForm) {
            console.log(
                "🏗️ No organization form found, skipping Structure manager"
            );
            return;
        }

        try {
            console.log("🏗️ Initializing Structure manager...");

            const orgManager = new Structure();
            orgManager.init();

            // Store reference
            this.components.set("structureManager", orgManager);

            // Expose to global scope for onclick handlers in Blade templates
            window.orgManager = orgManager;

            // Global functions for compatibility with blade onclick
            window.addDivisionEntry = () => orgManager.addDivisionEntry();
            window.saveOrganization = () => orgManager.saveOrganization();
            window.previewCarousel = () => orgManager.previewCarousel();
            window.previewOrgChart = () => orgManager.previewOrgChart();
            window.closeCarouselPreview = () =>
                orgManager.closeCarouselPreview();
            window.closeOrgChartPreview = () =>
                orgManager.closeOrgChartPreview();

            console.log("✅ Structure manager initialized successfully");
        } catch (error) {
            console.error("❌ Error initializing structure manager:", error);
        }
    }

    updateComponentThemes(darkMode) {
        // Update Structure manager if exists
        const structureManager = this.components.get("structureManager");
        if (
            structureManager &&
            typeof structureManager.updateTheme === "function"
        ) {
            structureManager.updateTheme(darkMode);
        }

        // Update other components that need theme updates
        this.components.forEach((component, name) => {
            if (component && typeof component.updateTheme === "function") {
                try {
                    component.updateTheme(darkMode);
                    console.log(`🎨 Updated theme for component: ${name}`);
                } catch (error) {
                    console.error(
                        `❌ Failed to update theme for ${name}:`,
                        error
                    );
                }
            }
        });
    }

    // Public API methods
    getComponent(name) {
        return this.components.get(name);
    }

    getQuillInstance(editorId) {
        return this.quillInstances.get(editorId);
    }

    getAllQuillInstances() {
        return Array.from(this.quillInstances.values());
    }

    isReady() {
        return this.isInitialized;
    }

    // Utility method to reinitialize components if needed
    reinitialize() {
        console.log("🔄 Reinitializing application...");
        this.isInitialized = false;
        this.initializeComponents();
    }
}

// Initialize application
const appManager = new AppManager();

// Export for module usage
export default appManager;
export { Structure };
