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

    loadExistingData() {
        // Load existing data (dalam implementasi nyata, data akan dimuat dari server)
        this.organizationData = {
            name: "PUSTIPD UIN Raden Fatah Palembang",
            description: "",
            head: {
                name: "Awang Sugiarto, S.Kom.",
                position: "Kepala PUSTIPD",
                email: "kepala@pustipd.uinrf.ac.id",
                photo: "https://via.placeholder.com/200x200?text=Kepala",
                order: 0,
            },
            divisions: [
                {
                    id: 1,
                    name: "Divisi Pengembangan Perangkat Lunak",
                    staff: [
                        {
                            name: "Budi Santoso, S.Kom",
                            position: "Kepala Divisi",
                            email: "budi@pustipd.uinrf.ac.id",
                            photo: "https://via.placeholder.com/200x200?text=Budi",
                            order: 1,
                        },
                        {
                            name: "Sari Wulandari, S.T.",
                            position: "Programmer",
                            email: "sari@pustipd.uinrf.ac.id",
                            photo: "https://via.placeholder.com/200x200?text=Sari",
                            order: 2,
                        },
                    ],
                },
                {
                    id: 2,
                    name: "Divisi Jaringan dan Infrastruktur",
                    staff: [
                        {
                            name: "Eko Prasetyo, S.T.",
                            position: "Kepala Divisi",
                            email: "eko@pustipd.uinrf.ac.id",
                            photo: "https://via.placeholder.com/200x200?text=Eko",
                            order: 3,
                        },
                    ],
                },
            ],
        };

        // Populate form with existing data
        const orgName = document.getElementById("orgName");
        const orgDescription = document.getElementById("orgDescription");
        const headName = document.getElementById("headName");
        const headPosition = document.getElementById("headPosition");
        const headEmail = document.getElementById("headEmail");

        if (orgName) orgName.value = this.organizationData.name;
        if (orgDescription)
            orgDescription.value = this.organizationData.description;
        if (headName) headName.value = this.organizationData.head.name;
        if (headPosition)
            headPosition.value = this.organizationData.head.position;
        if (headEmail) headEmail.value = this.organizationData.head.email;

        // Load head photo
        if (this.organizationData.head.photo) {
            this.displayHeadPhoto(this.organizationData.head.photo);
        }

        // Load existing divisions
        this.organizationData.divisions.forEach((division) => {
            this.addDivisionEntry(division.name, division.staff, division.id);
        });
    }

    bindEvents() {
        // Head photo upload
        const headPhotoInput = document.getElementById("headPhoto");
        if (headPhotoInput) {
            headPhotoInput.addEventListener("change", (e) => {
                this.handlePhotoUpload(e, "head");
            });
        }

        // Form auto-save
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

    addDivisionEntry(existingName = "", existingStaff = [], divisionId = null) {
        this.divisionCounter++;
        const id = divisionId || this.divisionCounter;
        const container = document.getElementById("divisionsContainer");
        const emptyState = document.getElementById("divisionsEmptyState");

        if (!container) return;

        if (emptyState) {
            emptyState.style.display = "none";
        }

        const divisionDiv = document.createElement("div");
        divisionDiv.className =
            "division-entry bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl p-6";
        divisionDiv.dataset.divisionId = id;

        divisionDiv.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm font-bold mr-3">${id}</div>
                    <h4 class="text-base font-semibold text-gray-900">Divisi ${id}</h4>
                </div>
                <div class="flex items-center space-x-2">
                    <button type="button" data-action="move-up" data-division-id="${id}" 
                            class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-200" title="Pindah ke atas">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 14l5-5 5 5"></path>
                        </svg>
                    </button>
                    <button type="button" data-action="move-down" data-division-id="${id}" 
                            class="text-gray-600 hover:text-gray-900 p-1 rounded hover:bg-gray-200" title="Pindah ke bawah">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 10l-5 5-5-5"></path>
                        </svg>
                    </button>
                    <button type="button" data-action="delete" data-division-id="${id}" 
                            class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Divisi">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Division Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Divisi</label>
                <input type="text" name="division_name_${id}" id="division_name_${id}" required
                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Contoh: Divisi Pengembangan Perangkat Lunak" value="${existingName}">
            </div>

            <!-- Staff Management -->
            <div class="mb-4">
                <div class="flex items-center justify-between mb-3">
                    <h5 class="text-sm font-medium text-gray-700">Staff Divisi</h5>
                    <button type="button" data-action="add-staff" data-division-id="${id}" 
                            class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Staff
                    </button>
                </div>
                
                <div id="staffContainer_${id}" class="space-y-4">
                    <!-- Staff entries akan ditambahkan di sini -->
                </div>
            </div>
        `;

        container.appendChild(divisionDiv);

        // Bind events for this division
        this.bindDivisionEvents(divisionDiv);

        // Add existing staff
        if (existingStaff && existingStaff.length > 0) {
            existingStaff.forEach((staff, index) => {
                this.addStaffEntry(
                    id,
                    staff.name,
                    staff.position,
                    staff.email,
                    staff.photo,
                    staff.order
                );
            });
        }

        this.updateUI();
    }

    bindDivisionEvents(divisionDiv) {
        // Bind button events using event delegation
        divisionDiv.addEventListener("click", (e) => {
            const button = e.target.closest("button[data-action]");
            if (!button) return;

            const action = button.dataset.action;
            const divisionId = button.dataset.divisionId;

            switch (action) {
                case "move-up":
                    this.moveDivision(divisionId, "up");
                    break;
                case "move-down":
                    this.moveDivision(divisionId, "down");
                    break;
                case "delete":
                    this.deleteDivision(divisionId);
                    break;
                case "add-staff":
                    this.addStaffEntry(divisionId);
                    break;
            }
        });
    }

    addStaffEntry(
        divisionId,
        existingName = "",
        existingPosition = "",
        existingEmail = "",
        existingPhoto = "",
        existingOrder = ""
    ) {
        const staffContainer = document.getElementById(
            `staffContainer_${divisionId}`
        );
        if (!staffContainer) return;

        const staffCount = staffContainer.children.length;
        const staffIndex = staffCount;

        const staffDiv = document.createElement("div");
        staffDiv.className =
            "staff-entry bg-white border border-gray-200 rounded-lg p-4";
        staffDiv.dataset.staffIndex = staffIndex;

        staffDiv.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <h6 class="text-sm font-medium text-gray-800">Staff ${
                    staffIndex + 1
                }</h6>
                <button type="button" data-action="remove-staff" data-division-id="${divisionId}" data-staff-index="${staffIndex}" 
                        class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus Staff">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Photo -->
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-2 overflow-hidden" id="staffPhotoPreview_${divisionId}_${staffIndex}">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <img id="staffPhoto_${divisionId}_${staffIndex}" class="w-full h-full object-cover hidden" src="${existingPhoto}" alt="">
                        </div>
                        <input type="file" id="staffPhotoInput_${divisionId}_${staffIndex}" name="staff_photo_${divisionId}_${staffIndex}" accept="image/*" class="hidden">
                        <button type="button" data-action="upload-photo" data-target="staffPhotoInput_${divisionId}_${staffIndex}" 
                                class="bg-gray-600 text-white px-2 py-1 rounded text-xs hover:bg-gray-700 transition-colors duration-200">
                            Upload
                        </button>
                    </div>
                </div>

                <!-- Info -->
                <div class="md:col-span-2 space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="staff_name_${divisionId}_${staffIndex}" required
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                               placeholder="Nama lengkap staff" value="${existingName}">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" name="staff_position_${divisionId}_${staffIndex}" required
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                               placeholder="Jabatan/posisi" value="${existingPosition}">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="staff_email_${divisionId}_${staffIndex}"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                   placeholder="email@pustipd.uinrf.ac.id" value="${existingEmail}">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                            <input type="number" name="staff_order_${divisionId}_${staffIndex}" min="1"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                   placeholder="1" value="${
                                       existingOrder || staffIndex + 1
                                   }">
                        </div>
                    </div>
                </div>
            </div>
        `;

        staffContainer.appendChild(staffDiv);

        // Bind events for this staff entry
        this.bindStaffEvents(staffDiv, divisionId, staffIndex);

        // Display existing photo if available
        if (existingPhoto) {
            this.displayStaffPhoto(existingPhoto, divisionId, staffIndex);
        }
    }

    bindStaffEvents(staffDiv, divisionId, staffIndex) {
        staffDiv.addEventListener("click", (e) => {
            const button = e.target.closest("button[data-action]");
            if (!button) return;

            const action = button.dataset.action;

            switch (action) {
                case "remove-staff":
                    this.removeStaffEntry(divisionId, staffIndex);
                    break;
                case "upload-photo":
                    const targetId = button.dataset.target;
                    const input = document.getElementById(targetId);
                    if (input) input.click();
                    break;
            }
        });

        // Bind photo upload event
        const photoInput = document.getElementById(
            `staffPhotoInput_${divisionId}_${staffIndex}`
        );
        if (photoInput) {
            photoInput.addEventListener("change", (e) => {
                this.handlePhotoUpload(e, "staff", divisionId, staffIndex);
            });
        }
    }

    removeStaffEntry(divisionId, staffIndex) {
        if (confirm("Apakah Anda yakin ingin menghapus staff ini?")) {
            const staffDiv = document.querySelector(
                `[data-division-id="${divisionId}"] [data-staff-index="${staffIndex}"]`
            );
            if (staffDiv) {
                staffDiv.remove();
            }
        }
    }

    deleteDivision(divisionId) {
        if (
            confirm(
                "Apakah Anda yakin ingin menghapus divisi ini beserta seluruh staff-nya?"
            )
        ) {
            const divisionDiv = document.querySelector(
                `[data-division-id="${divisionId}"]`
            );
            if (divisionDiv) {
                divisionDiv.remove();
                this.reorderDivisions();
                this.updateUI();
            }
        }
    }

    moveDivision(divisionId, direction) {
        const divisionDiv = document.querySelector(
            `[data-division-id="${divisionId}"]`
        );
        if (!divisionDiv) return;

        const container = divisionDiv.parentNode;

        if (direction === "up") {
            const prevDiv = divisionDiv.previousElementSibling;
            if (prevDiv) {
                container.insertBefore(divisionDiv, prevDiv);
            }
        } else if (direction === "down") {
            const nextDiv = divisionDiv.nextElementSibling;
            if (nextDiv) {
                container.insertBefore(nextDiv, divisionDiv);
            }
        }

        this.reorderDivisions();
    }

    reorderDivisions() {
        const divisionEntries = document.querySelectorAll(".division-entry");
        divisionEntries.forEach((entry, index) => {
            const newNumber = index + 1;

            // Update data attribute
            entry.dataset.divisionId = newNumber;

            // Update number badge
            const badge = entry.querySelector(".w-8.h-8");
            if (badge) {
                badge.textContent = newNumber;
            }

            // Update title
            const title = entry.querySelector("h4");
            if (title) {
                title.textContent = `Divisi ${newNumber}`;
            }

            // Update all form elements with new IDs
            const elements = entry.querySelectorAll("[name], [id]");
            elements.forEach((element) => {
                if (element.name) {
                    element.name = element.name
                        .replace(/_\d+_/, `_${newNumber}_`)
                        .replace(/_\d+$/, `_${newNumber}`);
                }
                if (element.id) {
                    element.id = element.id
                        .replace(/_\d+_/, `_${newNumber}_`)
                        .replace(/_\d+$/, `_${newNumber}`);
                }
            });

            // Update data attributes
            const buttons = entry.querySelectorAll("[data-division-id]");
            buttons.forEach((button) => {
                button.dataset.divisionId = newNumber;
            });
        });
    }

    updateUI() {
        const divisionEntries = document.querySelectorAll(".division-entry");
        const emptyState = document.getElementById("divisionsEmptyState");

        if (divisionEntries.length === 0) {
            if (emptyState) {
                emptyState.style.display = "block";
            }
        } else {
            if (emptyState) {
                emptyState.style.display = "none";
            }
        }
    }

    // Sisanya methods collectFormData, validateForm, saveOrganization, autoSave, dll.
    // (copy semua method yang ada di kode asli dengan sedikit modifikasi untuk menghilangkan dependency global)

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
                order: 0,
            },
            divisions: [],
            status: document.getElementById("status")?.value || "draft",
            updated_at: new Date().toISOString(),
        };

        // Collect divisions data
        const divisionEntries = document.querySelectorAll(".division-entry");
        divisionEntries.forEach((divisionDiv, divisionIndex) => {
            const divisionId = divisionDiv.dataset.divisionId;
            const divisionName =
                document
                    .getElementById(`division_name_${divisionId}`)
                    ?.value.trim() || "";

            const staffEntries = divisionDiv.querySelectorAll(".staff-entry");
            const staff = [];

            staffEntries.forEach((staffDiv, staffIndex) => {
                const staffName =
                    staffDiv
                        .querySelector(`[name^="staff_name_${divisionId}_"]`)
                        ?.value.trim() || "";
                const staffPosition =
                    staffDiv
                        .querySelector(
                            `[name^="staff_position_${divisionId}_"]`
                        )
                        ?.value.trim() || "";
                const staffEmail =
                    staffDiv
                        .querySelector(`[name^="staff_email_${divisionId}_"]`)
                        ?.value.trim() || "";
                const staffOrder =
                    staffDiv.querySelector(
                        `[name^="staff_order_${divisionId}_"]`
                    )?.value || staffIndex + 1;
                const staffPhoto =
                    staffDiv.querySelector(`[id^="staffPhoto_${divisionId}_"]`)
                        ?.src || "";

                if (staffName) {
                    staff.push({
                        name: staffName,
                        position: staffPosition,
                        email: staffEmail,
                        photo: staffPhoto,
                        order: parseInt(staffOrder),
                    });
                }
            });

            if (divisionName) {
                formData.divisions.push({
                    id: parseInt(divisionId),
                    name: divisionName,
                    staff: staff.sort((a, b) => a.order - b.order),
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
        for (let i = 0; i < data.divisions.length; i++) {
            const division = data.divisions[i];
            if (!division.name) {
                alert(`Nama divisi ${i + 1} harus diisi`);
                return false;
            }

            if (division.staff.length === 0) {
                alert(
                    `Divisi "${division.name}" harus memiliki minimal 1 staff`
                );
                return false;
            }

            // Validate staff
            for (let j = 0; j < division.staff.length; j++) {
                const staff = division.staff[j];
                if (!staff.name) {
                    alert(
                        `Nama staff ${j + 1} di divisi "${
                            division.name
                        }" harus diisi`
                    );
                    return false;
                }
                if (!staff.position) {
                    alert(
                        `Jabatan staff "${staff.name}" di divisi "${division.name}" harus diisi`
                    );
                    return false;
                }
            }
        }

        return true;
    }

    saveOrganization() {
        if (!this.validateForm()) {
            return;
        }

        const formData = this.collectFormData();
        console.log("Saving Organization:", formData);

        // Simulate API call
        setTimeout(() => {
            const lastSavedTime = document.getElementById("lastSavedTime");
            if (lastSavedTime) {
                lastSavedTime.textContent = new Date().toLocaleString("id-ID");
                lastSavedTime.classList.remove("text-green-600");
                lastSavedTime.classList.add("text-blue-600");
            }

            alert("Struktur organisasi berhasil disimpan!");
        }, 1000);
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

    // Methods untuk preview (copy dari kode asli)
    previewCarousel() {
        const formData = this.collectFormData();
        const carouselContent = document.getElementById("carouselContent");

        if (!carouselContent) return;

        carouselContent.innerHTML = "";

        // Create carousel items
        const allMembers = [];

        // Add head
        allMembers.push({
            name: formData.head.name,
            position: formData.head.position,
            email: formData.head.email,
            photo: formData.head.photo,
            order: 0,
            division: "Pimpinan",
        });

        // Add staff from all divisions
        formData.divisions.forEach((division) => {
            division.staff.forEach((staff) => {
                allMembers.push({
                    name: staff.name,
                    position: staff.position,
                    email: staff.email,
                    photo: staff.photo,
                    order: staff.order,
                    division: division.name,
                });
            });
        });

        // Sort by order
        allMembers.sort((a, b) => a.order - b.order);

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

    previewOrgChart(strukturData = null) {
        console.log("previewOrgChart dipanggil"); // Debug log

        // Jika strukturData tidak diberikan, ambil dari form data
        if (!strukturData) {
            const formData = this.collectFormData();
            strukturData = this.formatDataForChart(formData);
        }

        const container = document.getElementById("orgChartContainer");
        if (!container) {
            console.error("Container orgChartContainer tidak ditemukan");
            alert("Error: Container untuk preview tidak ditemukan!");
            return;
        }

        // Clear existing content
        container.innerHTML = "";

        // Cek jika data kosong
        if (!strukturData || Object.keys(strukturData).length === 0) {
            container.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Tidak ada data struktur organisasi</p>
                    <p class="text-gray-400 text-sm mt-2">Tambahkan divisi dan staff untuk melihat preview</p>
                </div>
            `;
        } else {
            // Create structure preview sama seperti di solution sebelumnya
            this.renderStructurePreview(container, strukturData);
        }

        // Show modal
        const modal = document.getElementById("orgChartPreviewModal");
        if (modal) {
            modal.classList.remove("hidden");
            console.log("Modal ditampilkan"); // Debug log
        } else {
            console.error("Modal orgChartPreviewModal tidak ditemukan");
            alert("Error: Modal preview tidak ditemukan!");
        }
    }

    // Helper method untuk render struktur
    renderStructurePreview(container, strukturData) {
        const wrapper = document.createElement("div");
        wrapper.className = "space-y-6";

        // Get form data untuk header
        const formData = this.collectFormData();

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
        Object.keys(strukturData).forEach((divisi, index) => {
            const members = strukturData[divisi];
            if (!members || members.length === 0) return;

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
                    ${divisi}
                </h3>
            `;
            divisionDiv.appendChild(headerDiv);

            // Members
            const membersDiv = document.createElement("div");
            membersDiv.className = "space-y-3";

            members.forEach((member) => {
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

    // Helper method untuk format data
    formatDataForChart(formData) {
        const strukturData = {};

        formData.divisions.forEach((division) => {
            if (division.name && division.staff && division.staff.length > 0) {
                strukturData[division.name] = division.staff;
            }
        });

        return strukturData;
    }

    // Helper method untuk format data
    formatDataForChart(formData) {
        const strukturData = {};

        // Add divisions and their staff
        formData.divisions.forEach((division) => {
            if (division.name && division.staff && division.staff.length > 0) {
                strukturData[division.name] = division.staff.map((staff) => ({
                    nama: staff.name,
                    jabatan: staff.position,
                    email: staff.email,
                    foto: staff.photo
                        ? staff.photo.replace("/storage/", "")
                        : null,
                    urutan_index: staff.order,
                }));
            }
        });

        return strukturData;
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

// Export functions untuk compatibility dengan global scope
export const structureFunctions = {
    addDivisionEntry: (manager) => () => manager.addDivisionEntry(),
    saveOrganization: (manager) => () => manager.saveOrganization(),
    previewCarousel: (manager) => () => manager.previewCarousel(),
    previewOrgChart: (manager) => () => manager.previewOrgChart(),
    closeCarouselPreview: (manager) => () => manager.closeCarouselPreview(),
    closeOrgChartPreview: (manager) => () => manager.closeOrgChartPreview(),
};
