import "./bootstrap";

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

// Import Structure management - pilih salah satu pendekatan
// Opsi 1: Import class Structure untuk instantiate manual
import { Structure } from "./components/admin/structure.js";

// Opsi 2: Import singleton instance (jika tersedia)
// import structureManager from "./components/admin/structure.js";

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

// Expose public functions to global scope
window.copyContentLink = copyContentLink;
window.shareTo = shareTo;
initShareButtons();

// Initialize Quill editors
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".editor").forEach((editorElem) => {
        const quill = new Quill(editorElem, {
            theme: "snow",
            placeholder: "Tulis isi konten di sini...",
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
        });

        const textarea = editorElem.nextElementSibling;
        if (textarea) {
            quill.on("text-change", function () {
                textarea.value = quill.root.innerHTML;
            });

            // Set initial content dari textarea
            if (textarea.value) {
                quill.root.innerHTML = textarea.value;
            }
        }
    });
});

// Initialize Structure Organisasi management
document.addEventListener("DOMContentLoaded", () => {
    const organizationForm = document.getElementById("organizationForm");

    if (organizationForm) {
        try {
            // Create new instance of Structure class
            const orgManager = new Structure();
            orgManager.init();

            // Expose to global scope untuk onclick handlers di Blade templates
            window.orgManager = orgManager;

            // Global functions untuk compatibility dengan blade onclick
            window.addDivisionEntry = () => orgManager.addDivisionEntry();
            window.saveOrganization = () => orgManager.saveOrganization();
            window.previewCarousel = () => orgManager.previewCarousel();
            window.previewOrgChart = () => orgManager.previewOrgChart();
            window.closeCarouselPreview = () =>
                orgManager.closeCarouselPreview();
            window.closeOrgChartPreview = () =>
                orgManager.closeOrgChartPreview();

            console.log("Structure manager initialized successfully");
        } catch (error) {
            console.error("Error initializing structure manager:", error);
        }
    }
});

// Global error handler untuk debugging
window.addEventListener("error", (e) => {
    console.error("Global error:", e.error);
});

// Handle unhandled promise rejections
window.addEventListener("unhandledrejection", (e) => {
    console.error("Unhandled promise rejection:", e.reason);
});
