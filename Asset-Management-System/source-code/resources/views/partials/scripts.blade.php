<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
</script>

<script>
function updateDate(){
    const now = new Date();
    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "2-digit"
    };
    document.getElementById("todayDate").textContent =
        now.toLocaleDateString("en-US", options);
}

updateDate();
setInterval(updateDate, 60000);
</script>

<script>
    const searchInput = document.getElementById("searchInput");
    const clearSearch = document.getElementById("clearSearch");
    const assetTableArea = document.getElementById("assetTableArea");

    let searchTimer;

    function toggleClearButton() {
        clearSearch.style.display = searchInput.value ? "flex" : "none";
    }

    function loadAssets(url) {
        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");
            const newTable = doc.getElementById("assetTableArea");

            if (newTable) {
                assetTableArea.innerHTML = newTable.innerHTML;
            }
        });
    }

    searchInput.addEventListener("input", function () {
        clearTimeout(searchTimer);

        const keyword = this.value.trim();
        const url = keyword
            ? `/dashboard?search=${encodeURIComponent(keyword)}`
            : `/dashboard`;

        toggleClearButton();

        searchTimer = setTimeout(() => {
            loadAssets(url);
            window.history.replaceState({}, "", url);
            searchInput.focus();
        }, 250);
    });

    clearSearch.addEventListener("click", function () {
        searchInput.value = "";
        toggleClearButton();

        loadAssets("/dashboard");
        window.history.replaceState({}, "", "/dashboard");
        searchInput.focus();
    });

    document.addEventListener("click", function (e) {
        const pageLink = e.target.closest(".pagination a");

        if (pageLink) {
            e.preventDefault();
            loadAssets(pageLink.href);
            window.history.replaceState({}, "", pageLink.href);
            searchInput.focus();
        }
    });

    toggleClearButton();
</script>

<script>
    setTimeout(() => {
        document.querySelectorAll('.auto-alert').forEach(alert => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        });
    }, 4200);
</script>

<script>
    const assetCodes = @json($assetCodes);

    document.querySelectorAll('.asset-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const alertBox = form.querySelector('.modal-alert');
            const assetCodeInput = form.querySelector('[name="asset_code"]');

            let message = '';
            let firstInvalidField = null;

            form.querySelectorAll('[required]').forEach(field => {
                const label = field.dataset.label || field.name;

                if (!message && field.value.trim() === '') {
                    message = `${label} wajib diisi.`;
                    firstInvalidField = field;
                }

                if (!message && field.maxLength > 0 && field.value.length > field.maxLength) {
                    message = `${label} maksimal ${field.maxLength} karakter.`;
                    firstInvalidField = field;
                }
            });

            const assetCode = assetCodeInput.value.trim();
            const currentId = form.dataset.assetId || null;

            Object.entries(assetCodes).forEach(([id, code]) => {
                if (!message && code.toLowerCase() === assetCode.toLowerCase() && id !== currentId) {
                    message = 'Asset Code sudah digunakan. Silakan gunakan kode lain.';
                    firstInvalidField = assetCodeInput;
                }
            });

            if (message) {
                e.preventDefault();
                alertBox.textContent = message;
                alertBox.classList.remove('d-none');

                if (firstInvalidField) {
                    firstInvalidField.focus();
                }
            }
        });
    });
</script>

<script>
    function validateImage(file, input) {
        const maxSize = 5 * 1024 * 1024;

        if (!file) return false;

        if (!file.type.startsWith("image/")) {
            alert("Please select an image file.");
            input.value = "";
            return false;
        }

        if (file.size > maxSize) {
            alert("Image size must not exceed 5 MB.");
            input.value = "";
            return false;
        }

        return true;
    }

    function renderImagePreview(input, file) {
        const container = input.closest(".mb-3");
        const uploadBox = container.querySelector(".upload-box");
        const existingWrapper = container.querySelector(".uploaded-image-wrapper");
        const removeInput = container.querySelector(".remove-image-input");
        const imageUrl = URL.createObjectURL(file);

        if (removeInput) {
            removeInput.value = "0";
        }

        if (existingWrapper) {
            existingWrapper.querySelector(".uploaded-image").src = imageUrl;
            return;
        }

        if (uploadBox) {
            uploadBox.remove();
        }

        container.insertAdjacentHTML("beforeend", `
            <div class="uploaded-image-wrapper mt-3">
                <img src="${imageUrl}" class="uploaded-image">

                <div class="image-overlay">
                    <label for="${input.id}" class="change-image">
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>Change Image</span>
                    </label>

                    <button type="button" class="remove-image">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `);
    }

    document.addEventListener("change", function (e) {
        if (!e.target.classList.contains("image-input")) return;

        const input = e.target;
        const file = input.files[0];

        if (!validateImage(file, input)) return;

        renderImagePreview(input, file);
    });

    document.addEventListener("click", function (e) {
        const removeBtn = e.target.closest(".remove-image");
        if (!removeBtn) return;

        const wrapper = removeBtn.closest(".uploaded-image-wrapper");
        const container = wrapper.closest(".mb-3");
        const input = container.querySelector('input[type="file"]');
        const removeInput = container.querySelector(".remove-image-input");

        input.value = "";

        if (removeInput) {
            removeInput.value = "1";
        }

        wrapper.remove();

        container.insertAdjacentHTML("beforeend", `
            <label for="${input.id}" class="upload-box">
                <i class="bi bi-cloud-arrow-up"></i>
                <h5>Drag & Drop image here</h5>
                <p>or click to choose file</p>
            </label>
        `);
    });

    document.addEventListener("dragover", function (e) {
        const target = e.target.closest(".upload-box, .uploaded-image-wrapper");
        if (!target) return;

        e.preventDefault();
        target.classList.add("dragover");
    });

    document.addEventListener("dragleave", function (e) {
        const target = e.target.closest(".upload-box, .uploaded-image-wrapper");
        if (!target) return;

        target.classList.remove("dragover");
    });

    document.addEventListener("drop", function (e) {
        const target = e.target.closest(".upload-box, .uploaded-image-wrapper");
        if (!target) return;

        e.preventDefault();
        target.classList.remove("dragover");

        const container = target.closest(".mb-3");
        const input = container.querySelector('input[type="file"]');
        const file = e.dataTransfer.files[0];

        if (!input || !validateImage(file, input)) return;

        input.files = e.dataTransfer.files;
        renderImagePreview(input, file);
    });
</script>

<script>
    const imagePreviewModal = document.getElementById("imagePreviewModal");

    if (imagePreviewModal) {
        imagePreviewModal.addEventListener("show.bs.modal", function (event) {
            const trigger = event.relatedTarget;

            const image = trigger.getAttribute("data-image");
            const title = trigger.getAttribute("data-title");

            document.getElementById("imagePreviewModalImg").src = image;
            document.getElementById("imagePreviewTitle").textContent = title;
        });
    }
</script>
