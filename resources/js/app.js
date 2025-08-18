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

// Import komponem public
import "./components/public/bulk-download";
import {
    initShareButtons,
    shareTo,
    copyContentLink,
} from "./components/public/share.js";

window.copyContentLink = copyContentLink;
window.shareTo = shareTo;
initShareButtons();

// import "./components/admin/rencana_dummyJS";
// Import future public components
// import "./components/public/search";
// import "./components/public/pagination";
// import "./components/public/modal-public";
import Quill from "quill";
import "quill/dist/quill.snow.css";

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".editor").forEach((editorElem) => {
        const quill = new Quill(editorElem, {
            theme: "snow",
            placeholder: "Tulis isi konten di sini...",
        });

        // Sinkronisasi ke textarea terkait (diasumsikan textarea adalah sibling setelah editor)
        const textarea = editorElem.nextElementSibling;
        quill.on("text-change", function () {
            textarea.value = quill.root.innerHTML;
        });
    });
});
