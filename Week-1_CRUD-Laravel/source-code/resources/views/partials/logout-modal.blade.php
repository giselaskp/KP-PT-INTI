<!-- Logout Modal -->
<div class="modal fade"
    id="logoutModal"
    tabindex="-1"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title fw-bold">
                    Logout
                </h4>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body text-center py-4">
                <h5 class="fw-semibold">
                    Logout Session?
                </h5>
                <p class="text-secondary mb-0">
                    Are you sure you want to logout from your account?
                </p>
            </div>

            <div class="modal-footer border-0 justify-content-center">
                <button
                    type="button"
                    class="btn btn-light modal-action-btn"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <form action="/logout" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="btn btn-main modal-action-btn">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
