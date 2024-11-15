<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SINTA KAISA | Sistem Inventaris Kaisa Rossie</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="template/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="template/dist/assets/css/app.css">
    <link rel="stylesheet" href="template/dist/assets/css/pages/auth.css">

    <link rel="icon" href="/img/kaisa-trans.png">
</head>

<body class="text-center">
    <div id="auth">
        <div class="container text-center">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <div id="auth-left">
                        <h1 class="auth-title">Log in.</h1>
                        <p class="auth-subtitle mb-5">Sistem Inventaris Kaisa Rossie</p>
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible show fade">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="/login" method="POST">
                            @csrf
                            <div class="form-group position-relative mb-4">
                                <input type="text" name="username"
                                    class="form-control form-control-xl @error('username')is-invalid @enderror"
                                    placeholder="Username" autocomplete="off">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group position-relative mb-4">
                                <input type="password" name="password"
                                    class="form-control form-control-xl @error('username')is-invalid @enderror"
                                    placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="template/dist/assets/js/bootstrap.bundle.min.js"></script>

<script src="template/dist/assets/js/mazer.js"></script>

</html>
