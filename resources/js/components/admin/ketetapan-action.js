// document.addEventListener("DOMContentLoaded", function () {
//     // ===============================
//     // SET BULK ACTION ROUTE FOR KETETAPAN
//     // ===============================
//     window.bulkActionRoute = "/admin/manage-content/dokumen/ketetapan/bulk";

//     // ===============================
//     // KETETAPAN SPECIFIC ACTIONS
//     // ===============================

//     // Override quickStatusChange untuk ketetapan (lebih spesifik dari bulk-actions.js)
//     window.quickStatusChangeKetetapan = function (id, status) {
//         let title = "";
//         let message = "";

//         switch (status) {
//             case "published":
//                 title = "Publish Ketetapan?";
//                 message = "Ketetapan akan tampil di halaman publik";
//                 break;
//             case "draft":
//                 title = "Sembunyikan Ketetapan?";
//                 message = "Ketetapan akan disembunyikan dari halaman publik";
//                 break;
//             case "archived":
//                 title = "Arsipkan Ketetapan?";
//                 message = "Ketetapan akan diarsipkan";
//                 break;
//         }

//         if (confirm(`${title}\n\n${message}\n\nLanjutkan?`)) {
//             const form = document.createElement("form");
//             form.method = "POST";
//             form.action = "/admin/manage-content/dokumen/ketetapan/bulk";
//             form.innerHTML = `
//                 <input type="hidden" name="_token" value="${
//                     document.querySelector('meta[name="csrf-token"]').content
//                 }">
//                 <input type="hidden" name="action" value="${status}">
//                 <input type="hidden" name="ids[]" value="${id}">
//             `;

//             document.body.appendChild(form);
//             form.submit();
//         }
//     };

//     // ===============================
//     // KETETAPAN TOGGLE VISIBILITY
//     // ===============================
//     window.toggleKetetapanVisibility = function (button) {
//         const row = button.closest("tr");
//         const checkbox = row.querySelector(".item-checkbox");
//         const id = checkbox ? checkbox.value : button.dataset.id;

//         if (!id) {
//             alert("ID tidak ditemukan");
//             return;
//         }

//         // Cek status saat ini dari badge status
//         const statusBadge = row.querySelector(".inline-flex");
//         const currentStatus = statusBadge
//             ? statusBadge.textContent.trim().toLowerCase()
//             : "draft";

//         const isCurrentlyPublished = currentStatus === "published";
//         const newStatus = isCurrentlyPublished ? "draft" : "published";
//         const actionText = isCurrentlyPublished
//             ? "Sembunyikan dari publik"
//             : "Tampilkan di publik";

//         if (confirm(`${actionText}?\n\nStatus akan diubah ke: ${newStatus}`)) {
//             const form = document.createElement("form");
//             form.method = "POST";
//             form.action = "/admin/manage-content/dokumen/ketetapan/bulk";
//             form.innerHTML = `
//                 <input type="hidden" name="_token" value="${
//                     document.querySelector('meta[name="csrf-token"]').content
//                 }">
//                 <input type="hidden" name="action" value="${newStatus}">
//                 <input type="hidden" name="ids[]" value="${id}">
//             `;

//             document.body.appendChild(form);
//             form.submit();
//         }
//     };

//     // ===============================
//     // DELETE KETETAPAN
//     // ===============================
//     window.deleteKetetapan = function (id) {
//         if (
//             confirm(
//                 "⚠️ PERINGATAN!\n\nKetetapan akan dihapus PERMANEN beserta file yang terkait.\n\nData tidak dapat dikembalikan!\n\nApakah Anda yakin?"
//             )
//         ) {
//             const form = document.createElement("form");
//             form.method = "POST";
//             form.action = `/admin/manage-content/dokumen/ketetapan/${id}`;
//             form.innerHTML = `
//                 <input type="hidden" name="_token" value="${
//                     document.querySelector('meta[name="csrf-token"]').content
//                 }">
//                 <input type="hidden" name="_method" value="DELETE">
//             `;

//             document.body.appendChild(form);
//             form.submit();
//         }
//     };

//     // ===============================
//     // PREVIEW KETETAPAN
//     // ===============================
//     window.previewKetetapan = function (id) {
//         const previewUrl = `/admin/manage-content/dokumen/ketetapan/${id}`;
//         window.open(
//             previewUrl,
//             "_blank",
//             "width=800,height=600,scrollbars=yes,resizable=yes"
//         );
//     };

//     // ===============================
//     // FALLBACK MODAL FUNCTIONS
//     // ===============================
//     if (typeof window.openUpdateModal === "undefined") {
//         window.openUpdateModal = function (id) {
//             window.location.href = `/admin/manage-content/dokumen/ketetapan/${id}/edit`;
//         };
//     }

//     console.log("Ketetapan Actions loaded successfully");
// });
