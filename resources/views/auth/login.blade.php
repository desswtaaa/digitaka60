<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Digitaka</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1e3766;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background-color: #e9e9e9;
            border-radius: 30px;
            padding: 40px;
            width: 500px;
        }

        .role-btn {
            border-radius: 15px;
            padding: 20px;
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

        .login-btn {
            background-color: #1e3766;
            border-radius: 12px;
            height: 45px;
            border: none;
        }

        .login-btn:hover {
            background-color: #162b4f;
        }
    </style>
</head>
<body>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">

    <div class="text-center text-white mb-4">

        <!-- Logo -->
        <img src="{{ asset('image/logoteks.png') }}"
             alt="Logo Digitaka"
             width="200"
             class="mb-3">

        <h4>Perpustakaan digital, layanan anda</h4>
    </div>

    <div class="login-card shadow">

        <h4 class="fw-bold mb-2">Masuk ke sistem</h4>
        <p class="text-muted">Pilih role dan masukkan data diri anda</p>

        {{-- Error --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- 🔥 ROLE (WAJIB ADA) -->
            <input type="hidden" name="role" id="roleInput" value="admin">

            <!-- PILIH ROLE -->
            <div class="row mb-4">
                <div class="col-6">
                    <button type="button"
                        id="adminBtn"
                        onclick="setRole('admin')"
                        class="role-btn role-active">
                        Admin
                    </button>
                </div>
                <div class="col-6">
                    <button type="button"
                        id="userBtn"
                        onclick="setRole('user')"
                        class="role-btn role-inactive">
                        Siswa
                    </button>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email"
                       class="form-control rounded-3"
                       required>
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="fw-semibold">Password</label>
                <input type="password" name="password"
                       class="form-control rounded-3"
                       required>
            </div>

            <!-- SUBMIT -->
            <button type="submit" class="btn login-btn text-white w-100">
                Masuk
            </button>
        </form>
    </div>
</div>

<script>
    const adminBtn = document.getElementById('adminBtn');
    const userBtn = document.getElementById('userBtn');

    function setRole(role) {
        document.getElementById('roleInput').value = role;

        if (role === 'admin') {
            adminBtn.classList.add('role-active');
            adminBtn.classList.remove('role-inactive');

            userBtn.classList.add('role-inactive');
            userBtn.classList.remove('role-active');
        } else {
            userBtn.classList.add('role-active');
            userBtn.classList.remove('role-inactive');

            adminBtn.classList.add('role-inactive');
            adminBtn.classList.remove('role-active');
        }
    }
</script>

</body>
</html>
