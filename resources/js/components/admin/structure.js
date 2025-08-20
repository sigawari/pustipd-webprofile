// structure.js - Combined with inline script and styles from index.blade.php

// --- CSS Styles ---
const styles = `
.text-primary {
    color: #4f46e5;
}

#organizationTreeContainer {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}
`;

// Add styles to document
function addStyles(css) {
    const styleSheet = document.createElement("style");
    styleSheet.type = "text/css";
    styleSheet.innerText = css;
    document.head.appendChild(styleSheet);
}

// Apply styles when module loads
addStyles(styles);

// --- OrgTreeRenderer for Preview Modal Only ---
class OrgTreeRenderer {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
    }

    render(data) {
        if (!this.container || !data) {
            this.container.innerHTML = `
                <div class="text-center text-gray-500 py-8">
                    <p class="text-lg">Belum ada data struktur organisasi</p>
                    <p class="text-sm">Tambahkan data kepala dan divisi untuk melihat preview</p>
                </div>
            `;
            return;
        }

        this.container.innerHTML = "";

        // Render Head
        if (data.head && data.head.nama) {
            const headDiv = document.createElement("div");
            headDiv.className = "flex justify-center mb-8";
            headDiv.innerHTML = `
                <div class="text-center">
                    <img src="${
                        data.head.image || "/assets/img/placeholder/dummy.png"
                    }" alt="${
                data.head.nama
            }" class="mx-auto rounded-full w-32 h-32 object-cover border-4 border-blue-200" />
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">${
                        data.head.nama
                    }</h3>
                    <p class="text-blue-600 font-medium">${
                        data.head.jabatan
                    }</p>
                    ${
                        data.head.email
                            ? `<p class="text-gray-600 text-sm">${data.head.email}</p>`
                            : ""
                    }
                </div>
            `;
            this.container.appendChild(headDiv);
        }

        // Render Divisions
        if (data.divisions && data.divisions.length > 0) {
            data.divisions.forEach((division) => {
                const divSection = document.createElement("div");
                divSection.className = "mb-8";

                const divTitle = document.createElement("h4");
                divTitle.textContent = division.name;
                divTitle.className =
                    "text-center text-xl font-bold text-primary mb-6 bg-blue-100 py-2 rounded-lg";
                divSection.appendChild(divTitle);

                if (division.members && division.members.length > 0) {
                    const membersGrid = document.createElement("div");
                    membersGrid.className =
                        "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4";

                    division.members.forEach((member) => {
                        const memberCard = document.createElement("div");
                        memberCard.className =
                            "bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition-shadow";

                        memberCard.innerHTML = `
                            <img src="${
                                member.image ||
                                "/assets/img/placeholder/dummy.png"
                            }" alt="${
                            member.nama
                        }" class="mx-auto rounded-full w-20 h-20 object-cover border-2 border-gray-200" />
                            <h5 class="mt-3 font-semibold text-gray-800">${
                                member.nama
                            }</h5>
                            <p class="text-gray-600 text-sm">${
                                member.jabatan
                            }</p>
                            ${
                                member.email
                                    ? `<p class="text-blue-600 text-xs">${member.email}</p>`
                                    : ""
                            }
                        `;

                        membersGrid.appendChild(memberCard);
                    });

                    divSection.appendChild(membersGrid);
                }

                this.container.appendChild(divSection);
            });
        } else if (!data.head || !data.head.nama) {
            this.container.innerHTML = `
                <div class="text-center text-gray-500 py-8">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-lg">Belum ada data struktur organisasi</p>
                    <p class="text-sm">Tambahkan data kepala dan divisi untuk melihat preview</p>
                </div>
            `;
        }
    }

    collectFormData() {
        const formData = {
            name: document.getElementById("orgName")?.value.trim() || "",
            description:
                document.getElementById("orgDescription")?.value.trim() || "",
            head: {
                nama: document.getElementById("headName")?.value.trim() || "", // ubah dari 'name' ke 'nama'
                jabatan:
                    document.getElementById("headPosition")?.value.trim() || "", // ubah dari 'position' ke 'jabatan'
                email: document.getElementById("headEmail")?.value.trim() || "",
                image: document.getElementById("headPhotoImg")?.src || "", // ubah dari 'photo' ke 'image'
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

            const memberEntries = divisionDiv.querySelectorAll(".member-entry");
            const members = []; // ubah dari 'member' ke 'members'

            memberEntries.forEach((memberDiv) => {
                const memberName =
                    memberDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="nama"]`
                        )
                        ?.value.trim() || "";
                const memberPosition =
                    memberDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="jabatan"]`
                        )
                        ?.value.trim() || "";
                const memberEmail =
                    memberDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="email"]`
                        )
                        ?.value.trim() || "";

                if (memberName) {
                    members.push({
                        nama: memberName, // konsisten dengan 'nama'
                        jabatan: memberPosition, // konsisten dengan 'jabatan'
                        email: memberEmail,
                        image: "/assets/img/placeholder/dummy.png", // konsisten dengan 'image'
                    });
                }
            });

            if (divisionName) {
                formData.divisions.push({
                    id: parseInt(divisionId),
                    name: divisionName,
                    members: members, // ubah dari 'member' ke 'members'
                });
            }
        });

        return formData;
    }
}

// --- Main Structure Class ---
export class Structure {
    constructor() {
        this.divisionCounter = 0;
        this.organizationData = {
            name: "",
            description: "",
            head: {},
            divisions: [],
        };
        this.autoSaveTimer = null;
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
                this.loadDummyData();
            }
        } catch (error) {
            console.error("Error loading data:", error);
            this.loadDummyData();
        }
    }

    loadDummyData() {
        // Implementation for dummy data if needed
        console.log("Loading dummy data...");
    }

    populateForm(data) {
        document.getElementById("orgName").value = data.name || "";
        document.getElementById("orgDescription").value =
            data.description || "";

        if (data.head) {
            document.getElementById("headName").value = data.head.nama || "";
            document.getElementById("headPosition").value =
                data.head.jabatan || "Kepala PUSTIPD";
            document.getElementById("headEmail").value = data.head.email || "";

            if (data.head.image) {
                this.displayHeadPhoto(data.head.image);
            }
        }

        if (data.divisions && data.divisions.length > 0) {
            document.getElementById("divisionsEmptyState").style.display =
                "none";
            data.divisions.forEach((division) => {
                this.addDivisionEntry(division);
            });
        }
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

        // Bind event delegation for dynamic inputs
        this.bindInputEvents();
    }

    bindInputEvents() {
        const divisionsContainer =
            document.getElementById("divisionsContainer");
        if (divisionsContainer) {
            divisionsContainer.addEventListener("input", (event) => {
                if (
                    event.target.matches(
                        'input[type="text"], input[type="email"]'
                    )
                ) {
                    this.debounceAutoSave();
                }
            });
        }

        // Bind head inputs
        const inputs = [
            "orgName",
            "orgDescription",
            "headName",
            "headPosition",
            "headEmail",
        ];
        inputs.forEach((id) => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener("input", () => {
                    this.debounceAutoSave();
                });
            }
        });
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

    handlePhotoUpload(event, type, divisionId = null, memberIndex = null) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (type === "head") {
                    this.displayHeadPhoto(e.target.result);
                } else if (type === "member") {
                    this.displaymemberPhoto(
                        e.target.result,
                        divisionId,
                        memberIndex
                    );
                }
            };
            reader.readAsDataURL(file);
        }
    }

    displaymemberPhoto(src, divisionId, memberIndex) {
        const img = document.getElementById(
            `memberPhoto_${divisionId}_${memberIndex}`
        );
        const svg = document.querySelector(
            `#memberPhotoPreview_${divisionId}_${memberIndex} svg`
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
                    <button type="button" onclick="structureManager.addmemberEntry(${id})" 
                            class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Anggota
                    </button>
                </div>
                <div id="memberContainer_${id}" class="space-y-4"></div>
            </div>
        `;

        container.appendChild(divisionDiv);

        // Add existing members if any
        if (data?.members && data.members.length > 0) {
            data.members.forEach((member, index) => {
                this.addmemberEntry(
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

    addmemberEntry(
        divisionId,
        name = "",
        position = "",
        email = "",
        photo = "",
        memberIndex = null
    ) {
        const memberContainer = document.getElementById(
            `memberContainer_${divisionId}`
        );
        if (!memberContainer) return;

        const currentMemberCount = memberContainer.children.length + 1;
        const memberNumber = memberIndex || currentMemberCount;

        const memberDiv = document.createElement("div");
        memberDiv.className =
            "member-entry bg-white border border-gray-200 rounded-lg p-4";
        memberDiv.dataset.memberIndex = memberNumber;

        memberDiv.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <h6 class="text-sm font-medium text-gray-800">Anggota ${memberNumber}</h6>
                <button type="button" onclick="structureManager.removememberEntry(this)" 
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

        memberContainer.appendChild(memberDiv);

        if (photo) {
            this.displaymemberPhoto(photo, divisionId, memberNumber);
        }

        this.updateUI();
    }

    removememberEntry(button) {
        const memberDiv = button.closest(".member-entry");
        if (
            memberDiv &&
            confirm("Apakah Anda yakin ingin menghapus anggota ini?")
        ) {
            memberDiv.remove();
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

            const memberEntries = divisionDiv.querySelectorAll(".member-entry");
            const member = [];

            memberEntries.forEach((memberDiv) => {
                const memberName =
                    memberDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="nama"]`
                        )
                        ?.value.trim() || "";
                const memberPosition =
                    memberDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="jabatan"]`
                        )
                        ?.value.trim() || "";
                const memberEmail =
                    memberDiv
                        .querySelector(
                            `[name^="divisions[${divisionId}][members]"][name$="email"]`
                        )
                        ?.value.trim() || "";

                if (memberName) {
                    member.push({
                        name: memberName,
                        position: memberPosition,
                        email: memberEmail,
                    });
                }
            });

            if (divisionName) {
                formData.divisions.push({
                    id: parseInt(divisionId),
                    name: divisionName,
                    member: member,
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
                alert("Nama divisi harus diisi");
                return false;
            }

            if (division.members.length === 0) {
                alert(
                    `Divisi "${division.name}" harus memiliki minimal 1 anggota`
                );
                return false;
            }

            // Validate member
            for (let member of division.members) {
                if (!member.name) {
                    alert(
                        `Nama anggota di divisi "${division.name}" harus diisi`
                    );
                    return false;
                }
                if (!member.position) {
                    alert(
                        `Jabatan "${member.name}" di divisi "${division.name}" harus diisi`
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

    debounceAutoSave() {
        clearTimeout(this.autoSaveTimer);
        this.autoSaveTimer = setTimeout(() => this.autoSave(), 2000);
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
}

// Create global instance
const structureManager = new Structure();

// Export for module usage
export default structureManager;

// Global functions for onclick handlers
window.structureManager = structureManager;
window.addDivisionEntry = () => structureManager.addDivisionEntry();
window.saveOrganization = () => structureManager.saveOrganization();

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    structureManager.init();
});
