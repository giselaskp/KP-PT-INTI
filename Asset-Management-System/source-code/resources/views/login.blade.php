<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Asset Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body style="--auth-bg-image: url('{{ asset('images/gedung.png') }}');">

    <div class="position-absolute top-0 start-0 m-4">
        <a href="https://www.inti.co.id/"
        target="_blank"
        title="PT INTI (Persero)">
            <img src="{{ asset('images/logo.png') }}"
                class="logo"
                alt="Logo PT INTI">
        </a>
    </div>

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="auth-card border-0 p-4">
            <div class="card-body">

                <div class="text-center mb-4">
                    <span class="brand-badge">PT INTI (Persero)</span>
                    <h2 class="title mt-3 mb-2">Asset Management</h2>
                    <p class="subtitle mb-0">Please sign in to continue</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success py-2">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="name@company.com" value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                id="password"
                                placeholder="••••••••"
                                required>

                            <button
                                class="input-group-text password-eye"
                                type="button"
                                onclick="togglePassword()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-auth w-100 mt-2">
                        Login
                    </button>
                </form>

                <p class="helper-text text-center mt-4 mb-0">
                    Don't have an account?
                    <a href="/register" class="auth-link">Register</a>
                </p>

            </div>
        </div>
    </div>

    <footer class="position-fixed bottom-0 start-50 translate-middle-x mb-3">
        <small>
            © 2026 • Designed & Developed by
            <a href="https://github.com/giselaskp"
               target="_blank"
               class="fw-bold text-decoration-none"
               style="color:#7DD3FC;">
                <i class="bi bi-github me-1"></i>supgeesashere
            </a>
        </small>
    </footer>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const eye = document.getElementById("eyeIcon");

            if (password.type === "password") {
                password.type = "text";
                eye.className = "bi bi-eye-slash";
            } else {
                password.type = "password";
                eye.className = "bi bi-eye";
            }
        }
    </script>

</body>
</html>
