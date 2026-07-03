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
