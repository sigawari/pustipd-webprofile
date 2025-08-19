// structure.js
export class Structure {
    constructor() {
        this.divisionCounter = 0;
        this.organizationData = {
            name: "",
            description: "",
            head: {},
            divisions: [],
        };
    }

    init() {
        this.loadExistingData();
        this.bindEvents();
        this.updateUI();
    }

    async loadExistingData() {
        try {
            const response = await fetch(
                window.routes["admin.tentang-kami.struktur-organisasi.get-data"]
            );
            const result = await response.json();

            if (result.success && result.data) {
                this.populateForm(result.data);
            } else {
                // Load default dummy data if no existing data
                this.loadDummyData();
            }
        } catch (error) {
            console.error("Error loading data:", error);
            this.loadDummyData();
        }
    }

    populateForm(data) {
        // Fill organization info
        document.getElementById("orgName").value = data.name || "";
        document.getElementById("orgDescription").value =
            data.description || "";

        // Fill head info
        if (data.head) {
            document.getElementById("headName").value = data.head.nama || "";
            document.getElementById("headPosition").value =
                data.head.jabatan || "Kepala PUSTIPD";
            document.getElementById("headEmail").value = data.head.email || "";

            if (data.head.image) {
                this.displayHeadPhoto(data.head.image);
            }
        }

        // Fill divisions
        if (data.divisions && data.divisions.length > 0) {
            document.getElementById("divisionsEmptyState").style.display =
                "none";
            data.divisions.forEach((division) => {
                this.addDivisionEntry(division);
            });
        }
    }

    populateFormWithDummy() {
        document.getElementById("orgName").value = this.organizationData.name;
        document.getElementById("orgDescription").value =
            this.organizationData.description;
        document.getElementById("headName").value =
            this.organizationData.head.name;
        document.getElementById("headPosition").value =
            this.organizationData.head.position;
        document.getElementById("headEmail").value =
            this.organizationData.head.email;

        if (this.organizationData.head.photo) {
            this.displayHeadPhoto(this.organizationData.head.photo);
        }

        this.organizationData.divisions.forEach((division) => {
            this.addDivisionEntry({
                name: division.name,
                members: division.staff.map((staff) => ({
                    nama: staff.name,
                    jabatan: staff.position,
                    email: staff.email,
                })),
            });
        });
    }

    bindEvents() {
        const headPhotoInput = document.getElementById("headPhoto");
        if (headPhotoInput) {
            headPhotoInput.addEventListener("change", (e) => {
                this.handlePhotoUpload(e, "head");
            });
        }

        // Auto-save every 30 seconds
        setInterval(() => {
            this.autoSave();
        }, 30000);
    }

    displayHeadPhoto(src) {
        const previewDiv = document.getElementById("headPhotoPreview");
        const img = document.getElementById("headPhotoImg");
        const svg = previewDiv?.querySelector("svg");

        if (img && svg) {
            img.src = src;
            img.classList.remove("hidden");
            svg.style.display = "none";
        }
    }

    handlePhotoUpload(event, type, divisionId = null, staffIndex = null) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (type === "head") {
                    this.displayHeadPhoto(e.target.result);
                } else if (type === "staff") {
                    this.displayStaffPhoto(
                        e.target.result,
                        divisionId,
                        staffIndex
                    );
                }
            };
            reader.readAsDataURL(file);
        }
    }

    displayStaffPhoto(src, divisionId, staffIndex) {
        const img = document.getElementById(
            `staffPhoto_${divisionId}_${staffIndex}`
        );
        const svg = document.querySelector(
            `#staffPhotoPreview_${divisionId}_${staffIndex} svg`
        );

        if (img && svg) {
            img.src = src;
            img.classList.remove("hidden");
            svg.style.display = "none";
        }
    }

    addDivisionEntry(data = null) {
        this.divisionCounter++;
        const id = this.divisionCounter;
        const container = document.getElementById("divisionsContainer");
        const emptyState = document.getElementById("divisionsEmptyState");

        if (!container) return;

        if (emptyState) emptyState.style.display = "none";

        const divisionDiv = document.createElement("div");
        divisionDiv.className =
            "division-entry bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl p-6 mb-6";
        divisionDiv.dataset.divisionId = id;

        divisionDiv.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold mr-3">${id}</div>
                    <h4 class="text-base font-semibold text-gray-900">Divisi ${id}</h4>
                </div>
                <button type="button" onclick="structureManager.deleteDivision(${id})" class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Divisi">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            
            <div class="mb-4">
                <label for="division_name_${id}" class="block text-sm font-medium text-gray-700 mb-2">Nama Divisi</label>
                <input type="text" name="divisions[${id}][name]" id="division_name_${id}" required
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Nama Divisi" value="${data?.name || ""}">
            </div>
            
            <div class="mb-4">
                <div class="flex items-center justify-between mb-3">
                    <h5 class="text-sm font-medium text-gray-700">Anggota Divisi</h5>
                    <button type="button" onclick="structureManager.addStaffEntry(${id})" 
                            class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Anggota
                    </button>
                </div>
                <div id="staffContainer_${id}" class="space-y-4"></div>
            </div>
        `;

        container.appendChild(divisionDiv);

        // Add existing members if any
        if (data?.members && data.members.length > 0) {
            data.members.forEach((member, index) => {
                this.addStaffEntry(
                    id,
                    member.nama,
                    member.jabatan,
                    member.email,
                    member.photo,
                    index + 1
                );
            });
        }

        this.updateUI();
    }

    addStaffEntry(
        divisionId,
        name = "",
        position = "",
        email = "",
        photo = "",
        memberIndex = null
    ) {
        const staffContainer = document.getElementById(
            `staffContainer_${divisionId}`
        );
        if (!staffContainer) return;

        const currentMemberCount = staffContainer.children.length + 1;
        const memberNumber = memberIndex || currentMemberCount;

        const staffDiv = document.createElement("div");
        staffDiv.className =
            "staff-entry bg-white border border-gray-200 rounded-lg p-4";
        staffDiv.dataset.staffIndex = memberNumber;

        staffDiv.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <h6 class="text-sm font-medium text-gray-800">Anggota ${memberNumber}</h6>
                <button type="button" onclick="structureManager.removeStaffEntry(this)" 
                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Anggota">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="divisions[${divisionId}][members][${memberNumber}][nama]" required
                           value="${name}" placeholder="Nama Lengkap"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="divisions[${divisionId}][members][${memberNumber}][jabatan]" required
                           value="${position}" placeholder="Jabatan"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="divisions[${divisionId}][members][${memberNumber}][email]"
                           value="${email}" placeholder="Email"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
            </div>
            
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                <input type="file" name="divisions[${divisionId}][members][${memberNumber}][photo]" accept="image/*" class="text-sm">
            </div>
        `;

        staffContainer.appendChild(staffDiv);

        if (photo) {
            this.displayStaffPhoto(photo, divisionId, memberNumber);
        }

        this.updateUI();
    }

    removeStaffEntry(button) {
        const staffDiv = button.closest(".staff-entry");
        if (
            staffDiv &&
            confirm("Apakah Anda yakin ingin menghapus anggota ini?")
        ) {
            staffDiv.remove();
            this.updateUI();
        }
    }

    deleteDivision(divisionId) {
        if (
            confirm(
                "Apakah Anda yakin ingin menghapus divisi ini beserta seluruh anggotanya?"
            )
        ) {
            const divisionDiv = document.querySelector(
                `[data-division-id="${divisionId}"]`
            );
            if (divisionDiv) {
                divisionDiv.remove();
                this.updateUI();
            }
        }
    }

    updateUI() {
        const divisionEntries = document.querySelectorAll(".division-entry");
        const emptyState = document.getElementById("divisionsEmptyState");

        if (divisionEntries.length === 0) {
            if (emptyState) emptyState.style.display = "block";
        } else {
            if (emptyState) emptyState.style.display = "none";
        }
    }

    collectFormData() {
        const formData = {
            name: document.getElementById("orgName")?.value.trim() || "",
            description:
                document.getElementById("orgDescription")?.value.trim() || "",
            head: {
                name: document.getElementById("headName")?.value.trim() || "",
                position:
                    document.getElementById("headPosition")?.value.trim() || "",
                email: document.getElementById("headEmail")?.value.trim() || "",
                photo: document.getElementById("headPhotoImg")?.src || "",
            },
            divisions: [],
            status: document.getElementById("status")?.value || "draft",
            updated_at: new Date().toISOString(),
        };

        // Collect divisions data
        const divisionEntries = document.querySelectorAll(".division-entry");
        divisionEntries.forEach((divisionDiv) => {
            const divisionId = divisionDiv.dataset.divisionId;
            const divisionName =
                document
                    .getElementById(`division_name_${divisionId}`)
                    ?.value.trim() || "";

            const staffEntries = divisionDiv.querySelectorAll(".staff-entry");
            const staff = [];

            staffEntries.forEach((staffDiv) => {
                const staffName =
                    staffDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="nama"]`
                        )
                        ?.value.trim() || "";
                const staffPosition =
                    staffDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="jabatan"]`
                        )
                        ?.value.trim() || "";
                const staffEmail =
                    staffDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="email"]`
                        )
                        ?.value.trim() || "";

                if (staffName) {
                    staff.push({
                        name: staffName,
                        position: staffPosition,
                        email: staffEmail,
                    });
                }
            });

            if (divisionName) {
                formData.divisions.push({
                    id: parseInt(divisionId),
                    name: divisionName,
                    staff: staff, // Urutan sudah pasti berdasarkan posisi di form
                });
            }
        });

        return formData;
    }

    validateForm() {
        const data = this.collectFormData();

        if (!data.name) {
            alert("Nama organisasi harus diisi");
            document.getElementById("orgName")?.focus();
            return false;
        }

        if (!data.description) {
            alert("Deskripsi organisasi harus diisi");
            document.getElementById("orgDescription")?.focus();
            return false;
        }

        if (!data.head.name) {
            alert("Nama kepala organisasi harus diisi");
            document.getElementById("headName")?.focus();
            return false;
        }

        if (data.divisions.length === 0) {
            alert("Minimal harus ada 1 divisi");
            return false;
        }

        // Validate divisions
        for (let division of data.divisions) {
            if (!division.name) {
                alert(`Nama divisi harus diisi`);
                return false;
            }

            if (division.staff.length === 0) {
                alert(
                    `Divisi "${division.name}" harus memiliki minimal 1 anggota`
                );
                return false;
            }

            // Validate staff
            for (let staff of division.staff) {
                if (!staff.name) {
                    alert(
                        `Nama anggota di divisi "${division.name}" harus diisi`
                    );
                    return false;
                }
                if (!staff.position) {
                    alert(
                        `Jabatan "${staff.name}" di divisi "${division.name}" harus diisi`
                    );
                    return false;
                }
            }
        }

        return true;
    }

    async saveOrganization() {
        if (!this.validateForm()) return;

        const form = document.getElementById("organizationForm");
        const formData = new FormData(form);

        try {
            const response = await fetch(
                window.routes["admin.tentang-kami.struktur-organisasi.store"],
                {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                }
            );

            const result = await response.json();

            if (result.success) {
                const lastSavedTime = document.getElementById("lastSavedTime");
                if (lastSavedTime) {
                    lastSavedTime.textContent = new Date().toLocaleString(
                        "id-ID"
                    );
                    lastSavedTime.classList.remove("text-green-600");
                    lastSavedTime.classList.add("text-blue-600");
                }

                this.showNotification(
                    "Struktur organisasi berhasil disimpan!",
                    "success"
                );
            } else {
                this.showNotification(
                    result.message || "Terjadi kesalahan saat menyimpan",
                    "error"
                );
            }
        } catch (error) {
            console.error("Error saving data:", error);
            this.showNotification(
                "Terjadi kesalahan saat menyimpan data",
                "error"
            );
        }
    }

    autoSave() {
        const formData = this.collectFormData();

        if (formData.name && formData.head.name) {
            console.log("Auto-saving...", formData);

            const lastSavedTime = document.getElementById("lastSavedTime");
            if (lastSavedTime) {
                lastSavedTime.textContent =
                    "Auto-saved: " + new Date().toLocaleTimeString("id-ID");
                lastSavedTime.classList.remove(
                    "text-green-600",
                    "text-blue-600"
                );
                lastSavedTime.classList.add("text-gray-600");
            }
        }
    }

    previewCarousel() {
        const formData = this.collectFormData();
        const carouselContent = document.getElementById("carouselContent");

        if (!carouselContent) return;

        carouselContent.innerHTML = "";

        // Create carousel items - Kepala pertama, kemudian staff
        const allMembers = [];

        // Add head first (urutan pasti pertama)
        if (formData.head.name) {
            allMembers.push({
                name: formData.head.name,
                position: formData.head.position,
                email: formData.head.email,
                photo: formData.head.photo,
                division: "Pimpinan",
            });
        }

        // Add staff from all divisions (urutan sesuai input)
        formData.divisions.forEach((division) => {
            division.staff.forEach((staff) => {
                allMembers.push({
                    name: staff.name,
                    position: staff.position,
                    email: staff.email,
                    photo: staff.photo || "",
                    division: division.name,
                });
            });
        });

        // Generate carousel items
        allMembers.forEach((member) => {
            const memberCard = document.createElement("div");
            memberCard.className = "team-carousel-card flex-shrink-0";

            memberCard.innerHTML = `
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-xl hover:border-primary/30 transition-all duration-300 transform hover:-translate-y-2 group w-56 sm:w-64 md:w-72">
                    <div class="relative w-full h-48 sm:h-56 md:h-70 overflow-hidden">
                        ${
                            member.photo
                                ? `<img src="${member.photo}" alt="${member.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">`
                                : `<div class="w-full h-full bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                                <span class="text-4xl sm:text-5xl md:text-6xl font-bold text-white">${(
                                    member.name || ""
                                )
                                    .split(" ")
                                    .map((n) => n[0])
                                    .join("")}</span>
                              </div>`
                        }
                        <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-2 text-center h-20 sm:h-24 md:h-30 flex flex-col justify-center">
                        <h3 class="text-lg sm:text-xl font-bold text-secondary mb-1 group-hover:text-custom-blue transition-colors duration-300">${
                            member.name
                        }</h3>
                        <h4 class="text-sm sm:text-base text-secondary font-medium mb-2 sm:mb-3">${
                            member.position
                        }</h4>
                    </div>
                </div>
            `;
            carouselContent.appendChild(memberCard);
        });

        // Show modal
        const modal = document.getElementById("carouselPreviewModal");
        if (modal) {
            modal.classList.remove("hidden");
        }
    }

    previewOrgChart() {
        const formData = this.collectFormData();
        const container = document.getElementById("orgChartContent");

        if (!container) return;

        container.innerHTML = "";

        if (
            !formData.name &&
            !formData.head.name &&
            formData.divisions.length === 0
        ) {
            container.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Tidak ada data struktur organisasi</p>
                    <p class="text-gray-400 text-sm mt-2">Tambahkan divisi dan anggota untuk melihat preview</p>
                </div>
            `;
        } else {
            this.renderStructurePreview(container, formData);
        }

        // Show modal
        const modal = document.getElementById("orgChartPreviewModal");
        if (modal) {
            modal.classList.remove("hidden");
        }
    }

    renderStructurePreview(container, formData) {
        const wrapper = document.createElement("div");
        wrapper.className = "space-y-6";

        // Add organization header
        if (formData.name || formData.head.name) {
            const headerDiv = document.createElement("div");
            headerDiv.className =
                "text-center bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 mb-6";

            headerDiv.innerHTML = `
                <h1 class="text-2xl font-bold text-gray-800 mb-2">${
                    formData.name || "Struktur Organisasi"
                }</h1>
                ${
                    formData.description
                        ? `<p class="text-gray-600 mb-4">${formData.description}</p>`
                        : ""
                }
                ${
                    formData.head.name
                        ? `
                    <div class="inline-flex items-center space-x-4 bg-white rounded-lg p-4 shadow-sm">
                        <img class="h-12 w-12 rounded-full object-cover border-2 border-blue-200" 
                             src="${
                                 formData.head.photo ||
                                 "/assets/img/placeholder/dummy.png"
                             }" 
                             alt="${formData.head.name}"
                             onerror="this.src='/assets/img/placeholder/dummy.png'">
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-900">${
                                formData.head.name
                            }</h3>
                            <p class="text-blue-600 text-sm">${
                                formData.head.position || "Pimpinan"
                            }</p>
                        </div>
                    </div>
                `
                        : ""
                }
            `;
            wrapper.appendChild(headerDiv);
        }

        // Loop through divisions
        formData.divisions.forEach((division, index) => {
            if (!division.staff || division.staff.length === 0) return;

            const divisionDiv = document.createElement("div");
            divisionDiv.className = "bg-white rounded-lg shadow border p-4";

            // Division header
            const headerDiv = document.createElement("div");
            headerDiv.className =
                "bg-blue-500 text-white p-3 rounded-t-lg -mt-4 -mx-4 mb-4";
            headerDiv.innerHTML = `
                <h3 class="font-semibold flex items-center">
                    <span class="bg-white bg-opacity-20 rounded px-2 py-1 text-sm mr-2">${
                        index + 1
                    }</span>
                    ${division.name}
                </h3>
            `;
            divisionDiv.appendChild(headerDiv);

            // Members
            const membersDiv = document.createElement("div");
            membersDiv.className = "space-y-3";

            division.staff.forEach((member) => {
                const memberDiv = document.createElement("div");
                memberDiv.className =
                    "flex items-center space-x-3 p-2 bg-gray-50 rounded";

                memberDiv.innerHTML = `
                    <img class="h-10 w-10 rounded-full object-cover border" 
                         src="${
                             member.photo || "/assets/img/placeholder/dummy.png"
                         }" 
                         alt="${member.name}"
                         onerror="this.src='/assets/img/placeholder/dummy.png'">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">${
                            member.name
                        }</h4>
                        <p class="text-sm text-gray-600">${member.position}</p>
                    </div>
                `;

                membersDiv.appendChild(memberDiv);
            });

            divisionDiv.appendChild(membersDiv);
            wrapper.appendChild(divisionDiv);
        });

        container.appendChild(wrapper);
    }

    showNotification(message, type = "info") {
        const notification = document.createElement("div");
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
            type === "success" ? "bg-green-500" : "bg-red-500"
        } text-white`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    closeCarouselPreview() {
        const modal = document.getElementById("carouselPreviewModal");
        if (modal) {
            modal.classList.add("hidden");
        }
    }

    closeOrgChartPreview() {
        const modal = document.getElementById("orgChartPreviewModal");
        if (modal) {
            modal.classList.add("hidden");
        }
    }
}

// Create global instance
const structureManager = new Structure();

// Export for module usage
export default structureManager;

// Global functions for onclick handlers
window.structureManager = structureManager;
window.addDivisionEntry = () => structureManager.addDivisionEntry();
window.saveOrganization = () => structureManager.saveOrganization();
window.previewCarousel = () => structureManager.previewCarousel();
window.previewOrgChart = () => structureManager.previewOrgChart();
window.closeCarouselPreview = () => structureManager.closeCarouselPreview();
window.closeOrgChartPreview = () => structureManager.closeOrgChartPreview();

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    structureManager.init();
});
