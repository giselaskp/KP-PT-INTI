<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Asset Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(rgba(41, 118, 255, .66), rgba(15, 46, 110, .86)),
                radial-gradient(circle at top right, rgba(0, 198, 255, .25), transparent 45%),
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
            background: radial-gradient(circle at top right, rgba(0,198,255,.22), transparent 40%);
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

        .auth-card {
            width: 500px;
            border-radius: 28px;
            background: rgba(255, 255, 255, .23);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border: 1px solid rgba(255, 255, 255, .35);
            box-shadow: 0 25px 70px rgba(0, 0, 0, .24);
            animation: fadeUp .8s ease;
            position: relative;
            z-index: 2;
            transition: .35s ease;
        }

        .auth-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, .28);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(28px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.24);
            color: white;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .title {
            color: white;
            font-weight: 800;
            letter-spacing: .4px;
        }

        .subtitle {
            color: rgba(255,255,255,.80);
        }

        .form-label {
            color: white;
        }

        .input-group-text {
            background: rgba(255,255,255,.94);
            border-right: none;
            color: #64748B;
            height: 48px;
        }

        .form-control {
            height: 48px;
            border-left: none;
            background: rgba(255,255,255,.94);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .password-eye {
            border-left: none;
            cursor: pointer;
        }

        .btn-auth {
            height: 50px;
            border-radius: 14px;
            font-weight: 700;
            color: white;
            border: none;
            background: linear-gradient(135deg, #214A9B, #2F63C7, #039BE5);
            transition: .3s ease;
        }

        .btn-auth:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(3, 155, 229, .30);
        }

        .auth-link {
            color: #7DD3FC;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-link:hover {
            color: white;
        }

        .helper-text {
            color: rgba(255,255,255,.88);
        }

        footer {
            position: relative;
            z-index: 2;
            color: white;
            opacity: .9;
            letter-spacing: .3px;
        }
    </style>
</head>

<body>

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
                    <h2 class="title mt-3 mb-2">Get Started</h2>
                    <p class="subtitle mb-0">Create your administrator account</p>
                </div>

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
                            <input type="text" name="name" class="form-control" id="fullName" placeholder="Gisela S.K.P." value="{{ old('name') }}" autocomplete="name" required>
                        </div>
                    </div>

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
                                placeholder="Minimum 8 characters"
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
                        Register
                    </button>
                </form>

                <p class="helper-text text-center mt-4 mb-0">
                    Already have an account?
                    <a href="/login" class="auth-link">Login</a>
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
