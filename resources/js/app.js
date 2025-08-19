import "./bootstrap";

// Import file JS modular
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
import "./components/admin/structure";

// Import komponent public
import "./components/public/bulk-download";
import {
    initShareButtons,
    shareTo,
    copyContentLink,
} from "./components/public/share.js";

// Import Structure dari components/admin (BUKAN modules/)
import { Structure } from "./components/admin/structure.js";

import Quill from "quill";
import "quill/dist/quill.snow.css";

window.copyContentLink = copyContentLink;
window.shareTo = shareTo;
initShareButtons();

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".editor").forEach((editorElem) => {
        const quill = new Quill(editorElem, {
            theme: "snow",
            placeholder: "Tulis isi konten di sini...",
        });

        const textarea = editorElem.nextElementSibling;
        quill.on("text-change", function () {
            textarea.value = quill.root.innerHTML;
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("organizationForm")) {
        const orgManager = new Structure();
        orgManager.init();

        // Expose to global untuk onclick handlers di Blade
        window.orgManager = orgManager;
        window.addDivisionEntry = () => orgManager.addDivisionEntry();
        window.saveOrganization = () => orgManager.saveOrganization();
        window.previewCarousel = () => orgManager.previewCarousel();
        window.previewOrgChart = () => orgManager.previewOrgChart();
    }
});
