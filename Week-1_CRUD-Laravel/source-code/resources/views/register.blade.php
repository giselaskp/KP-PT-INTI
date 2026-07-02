<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | CRUD System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(
                    rgba(41, 118, 255, .70),
                    rgba(25, 42, 86, .82)
                ),
                radial-gradient(
                    circle at top right,
                    rgba(0, 198, 255, .25),
                    transparent 45%
                ),
                url("{{ asset('images/gedung.png') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(
                circle at top right,
                rgba(0, 198, 255, .20),
                transparent 40%
            );
            pointer-events: none;
        }

        .logo {
            width: 125px;
            transition: .3s;
            position: relative;
            z-index: 2;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .register-card {
            width: 450px;
            border-radius: 22px;
            background: rgba(255, 255, 255, .94);
            backdrop-filter: blur(14px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .20);
            animation: fadeUp .8s ease;
            position: relative;
            z-index: 2;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            color: #311B92;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .subtitle {
            color: #6c757d;
        }

        .input-group-text {
            background: white;
            border-right: none;
            color: #6c757d;
            height: 48px;
        }

        .form-control {
            height: 48px;
            border-left: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .password-eye {
            border-left: none;
            cursor: pointer;
        }

        .btn-register {
            height: 50px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            border: none;
            background: linear-gradient(
                135deg,
                #311B92,
                #4527A0,
                #039BE5
            );
            transition: .3s;
        }

        .btn-register:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(69, 39, 160, .35);
        }

        .login-link {
            color: #039BE5;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover {
            color: #311B92;
        }

        footer {
            position: relative;
            z-index: 2;
            color: white;
            opacity: .85;
            letter-spacing: .3px;
        }
    </style>
</head>

<body>

    <!-- Logo -->
    <div class="position-absolute top-0 start-0 m-4">
        <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo PT INTI">
    </div>

    <!-- Register Card -->
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="card register-card border-0 p-4">
            <div class="card-body">

                <h3 class="title text-center mb-2">Create Account</h3>
                <p class="subtitle text-center mb-4">Register your new account</p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="/register" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter your full name" value="{{ old('name') }}" autocomplete="name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" autocomplete="email" required>
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
                                placeholder="Create your password"
                                required>

                            <button
                                class="input-group-text password-eye"
                                type="button"
                                onclick="togglePassword()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-register w-100 mt-2">
                        Register
                    </button>
                </form>

                <p class="text-center mt-4 mb-0">
                    Already have an account?
                    <a href="/login" class="login-link">Login</a>
                </p>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="position-fixed bottom-0 start-50 translate-middle-x mb-3">
        <small>
            © 2026 • Designed & Developed by
            <a href="https://github.com/supgeesashere"
               target="_blank"
               class="fw-bold text-decoration-none"
               style="color:#00C6FF;">
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