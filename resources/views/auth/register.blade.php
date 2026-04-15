<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Digitaka</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1e3766;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .register-card {
            background-color: #e9e9e9;
            border-radius: 30px;
            padding: 40px;
            width: 500px;
            margin: 40px 0;
        }

        .role-btn {
            border-radius: 15px;
            padding: 15px;
            font-weight: 600;
            border: none;
            width: 100%;
            transition: 0.2s;
        }

        .role-active {
            background-color: #1e3766;
            color: white;
        }

        .role-inactive {
            background-color: #d3d3d3;
            color: black;
        }

        .register-btn {
            background-color: #1e3766;
            border-radius: 12px;
            height: 45px;
            border: none;
            font-weight: 600;
        }

        .register-btn:hover {
            background-color: #162b4f;
        }

        .form-control {
            background-color: #f0f7ff;
            border: 1px solid #d1d9e6;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

<div class="container d-flex flex-column justify-content-center align-items-center py-5">

    <div class="text-center text-white mb-4">
        <!-- Logo -->
        <img src="{{ asset('image/logoteks.png') }}"
             alt="Logo Digitaka"
             width="200"
             class="mb-3">

        <h4>Perpustakaan digital, layanan anda</h4>
    </div>

    <div class="register-card shadow">

        <h4 class="fw-bold mb-2">Daftar akun</h4>
        <p class="text-muted">Pilih role dan lengkapi data diri anda</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- 🔥 ROLE -->
            <input type="hidden" name="role" id="roleInput" value="siswa">

            <!-- PILIH ROLE -->
            <div class="row mb-4">
                <div class="col-6">
                    <button type="button"
                        id="userBtn"
                        onclick="setRole('siswa')"
                        class="role-btn role-active">
                        Siswa
                    </button>
                </div>
                <div class="col-6">
                    <button type="button"
                        id="adminBtn"
                        onclick="setRole('admin')"
                        class="role-btn role-inactive">
                        Admin
                    </button>
                </div>
            </div>

            <!-- NAMA -->
            <div class="mb-3">
                <label class="fw-semibold">Nama Lengkap</label>
                <input type="text" name="name"
                       class="form-control rounded-3"
                       value="{{ old('name') }}"
                       required>
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email"
                       class="form-control rounded-3"
                       value="{{ old('email') }}"
                       required>
            </div>

            <!-- NISN (Conditional for Siswa) -->
            <div class="mb-3" id="nisnField">
                <label class="fw-semibold">NISN</label>
                <input type="text" name="nisn"
                       class="form-control rounded-3"
                       value="{{ old('nisn') }}">
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="fw-semibold">Password</label>
                <input type="password" name="password"
                       class="form-control rounded-3"
                       required>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-4">
                <label class="fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control rounded-3"
                       required>
            </div>

            <!-- SUBMIT -->
            <button type="submit" class="btn register-btn text-white w-100 mb-3">
                Daftar
            </button>

            <p class="text-center text-sm mb-0">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #1e3766;">Masuk</a>
            </p>
        </form>
    </div>
</div>

<script>
    const adminBtn = document.getElementById('adminBtn');
    const userBtn = document.getElementById('userBtn');
    const nisnField = document.getElementById('nisnField');

    function setRole(role) {
        document.getElementById('roleInput').value = role;

        if (role === 'admin') {
            adminBtn.classList.add('role-active');
            adminBtn.classList.remove('role-inactive');

            userBtn.classList.add('role-inactive');
            userBtn.classList.remove('role-active');

            nisnField.style.display = 'none';
        } else {
            userBtn.classList.add('role-active');
            userBtn.classList.remove('role-inactive');

            adminBtn.classList.add('role-inactive');
            adminBtn.classList.remove('role-active');

            nisnField.style.display = 'block';
        }
    }

    // Set default view
    setRole('siswa');
</script>

</body>
</html>
