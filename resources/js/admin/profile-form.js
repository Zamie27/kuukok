/**
 * Profile Management Form Logic
 * Handles autosave, Trix editor integration, and dynamic certification fields.
 *
 * @param {Object} initialData - Data passed from Blade (techStacks, certifications, etc.)
 */
window.profileForm = function () {
    return {
        tab: "basic",
        previewUrl: null,
        isChanged: false,
        isSubmitting: false,

        // Tech Stack Data
        techSearch: "",
        selectedTechStacks: [],

        // Certification Data
        deletedCertIds: [],
        newCerts: [],
        existingCerts: [],

        // Certificate Modal
        certModalOpen: false,
        certTitle: "",
        certImage: "",

        init() {
            // Read data from DOM data attributes (Robustness: prevent JSON parse errors)
            if (this.$el.dataset.techStacks) {
                try {
                    const parsed = JSON.parse(this.$el.dataset.techStacks);
                    this.selectedTechStacks = Array.isArray(parsed)
                        ? parsed
                        : [];
                } catch (e) {
                    console.error("Failed to parse tech stacks:", e);
                    this.selectedTechStacks = [];
                }
            }

            if (this.$el.dataset.existingCerts) {
                try {
                    const parsed = JSON.parse(this.$el.dataset.existingCerts);
                    this.existingCerts = Array.isArray(parsed) ? parsed : [];
                } catch (e) {
                    console.error("Failed to parse existing certs:", e);
                    this.existingCerts = [];
                }
            }

            // Detect changes in form inputs
            this.$el.addEventListener("input", () => {
                this.isChanged = true;
                this.debouncedAutosave();
            });

            // Trix Editor Listener
            document.addEventListener("trix-change", () => {
                this.isChanged = true;
                this.debouncedAutosave();
            });
        },

        autosaveTimer: null,
        debouncedAutosave() {
            clearTimeout(this.autosaveTimer);
            this.autosaveTimer = setTimeout(() => {
                this.saveDraft();
            }, 3000); // Autosave after 3 seconds of inactivity
        },

        async saveDraft() {
            if (!this.isChanged || this.isSubmitting) return;

            // Don't autosave if there are files (too heavy)
            const fileInputs = this.$el.querySelectorAll('input[type="file"]');
            for (let input of fileInputs) {
                if (input.files.length > 0) return;
            }

            // Perform silent save
            await this.submitViaAjax();
        },

        fileChosen(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewUrl = URL.createObjectURL(file);
                this.isChanged = true;
            }
        },

        // Tech Stack Filter Logic
        shouldShowCategory(categoryName) {
            if (!this.techSearch) return true;
            return true;
        },
        shouldShowStack(stackName) {
            if (!this.techSearch) return true;
            return stackName
                .toLowerCase()
                .includes(this.techSearch.toLowerCase());
        },

        // Certification Logic
        openCert(title, filePath) {
            const isImage = /\.(jpg|jpeg|png|webp)$/i.test(filePath);
            const url = "/storage/" + filePath;

            if (isImage) {
                this.certTitle = title;
                this.certImage = url;
                this.certModalOpen = true;
            } else {
                window.open(url, "_blank");
            }
        },

        deleteCert(id) {
            if (confirm("Apakah Anda yakin ingin menghapus sertifikat ini?")) {
                this.deletedCertIds.push(id);
                this.isChanged = true;
            }
        },
        addCertRow() {
            this.newCerts.push({});
            this.isChanged = true;
        },
        removeCertRow(index) {
            this.newCerts.splice(index, 1);
        },

        /**
         * Manual Submit Handler
         * Triggered by the "Simpan Perubahan" button.
         * We let the browser handle the submission normally (Standard POST).
         */
        submitManual(e) {
            // We do NOT prevent default here.
            // Just show loading state while browser navigates.
            this.isSubmitting = true;
            console.log("Manual submit initiated (Browser Default)...");
        },

        /**
         * Autosave Handler (AJAX)
         * Only used for background saving.
         */
        async submitViaAjax() {
            // Prevent double submit
            if (this.isSubmitting) return;

            this.isSubmitting = true;
            console.log("Autosaving...");

            const form = this.$el.querySelector("form");
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN":
                            document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute("content") || "",
                    },
                });

                if (response.ok) {
                    this.isChanged = false;
                    this.showToast("Perubahan tersimpan otomatis.", "info");

                    const data = await response.json();
                    if (data.profile) {
                        // Update local state if needed
                        // For autosave, we mostly care about not losing data
                    }
                } else {
                    console.warn("Autosave failed silently");
                }
            } catch (error) {
                console.error("Autosave Error:", error);
            } finally {
                this.isSubmitting = false;
            }
        },

        showToast(message, type) {
            const toast = document.createElement("div");
            toast.className = `alert alert-${type} shadow-lg mb-2`;
            toast.innerHTML = `<span>${message}</span>`;

            const container = document.getElementById("toast-container");
            if (container) {
                container.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            } else {
                console.error("Toast container not found!", message);
                alert(message); // Fallback
            }
        },
    };
};
