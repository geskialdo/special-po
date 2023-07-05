<!DOCTYPE html>
<html lang="en">

<head>
    <div class="spinner-container">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <style>
        .spinner-container {
            height: 100%;
            width: 100%;
            background-color: white;
            position: fixed;
            z-index: 1000;
            padding: 0;
            margin: 0;
            top: 0;
            left: 0;
        }

        .spinner {
            width: 40px;
            height: 40px;
            margin: auto auto;
            position: relative;
            top: 35%;
        }

        .double-bounce1,
        .double-bounce2 {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #333;
            opacity: 0.6;
            position: absolute;
            top: 0;
            left: 0;

            -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
            animation: sk-bounce 2.0s infinite ease-in-out;
        }

        .double-bounce2 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        @-webkit-keyframes sk-bounce {

            0%,
            100% {
                -webkit-transform: scale(0.0)
            }

            50% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bounce {

            0%,
            100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            }

            50% {
                transform: scale(1.0);
                -webkit-transform: scale(1.0);
            }
        }
    </style>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login - Pajak Online Padang Pariaman</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <main>
        <div class="container">
            <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">pajak-online</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">
                                    <div class="pt-2 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Masuk ke akun Anda</h5>
                                        <p class="text-center small">Pajak Online Kabupaten Padang Pariaman</p>
                                    </div>

                                    <form class="row g-3 needs-validation" id="login-form" method="POST"
                                        action="/login">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username / Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" id="username"
                                                    class="form-control" required>
                                                <div class="invalid-feedback">Isikan username Anda</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                required>
                                            <div class="invalid-feedback">Isikan password Anda</div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                                            </div>
                                        </div> --}}

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 submit-button"
                                                type="submit">Masuk</button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0">Belum mendaftar? <a href="/register">Daftar
                                                    Sekarang</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Template by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Template Main JS File -->
    {{-- <script src="assets/js/main.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            toastr.options.progressBar = true
            // toastr.options.positionClass = 'toast-bottom-right';

            setTimeout(function() {
                $('.spinner-container').fadeOut()
            }, 250)

            const loginForm = document.querySelector('form#login-form')
            const submitButton = loginForm.querySelector('button.submit-button')
            const usernameInput = loginForm.querySelector('input#username')
            const passwordInput = loginForm.querySelector('input#password')
            const tokenInput = loginForm.querySelector('input[name="_token"]')

            loginForm.addEventListener('submit', (event) => {
                event.preventDefault()
                toastr.clear()
                submitButton.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Mohon tunggu...'
                submitButton.disabled = true
                usernameInput.disabled = true
                passwordInput.disabled = true

                const loginData = {
                    username: usernameInput.value,
                    password: passwordInput.value,
                    _token: tokenInput.value
                }

                axios.post('/login', loginData)
                    .then(function(response) {
                        toastr.success(response.data.message, 'Login berhasil', {
                            timeOut: 700
                        })
                        submitButton.innerHTML = '<i class="fa-solid fa-check"></i> Login Berhasil'
                        setTimeout(function() {
                            location.replace('/dashboard')
                        }, 800)
                    })
                    .catch(function(error) {
                        var message
                        if (error.response === undefined) {
                            message = 'Anda sedang tidak memiliki koneksi internet yg baik'
                        } else {
                            message = error.response.status === 401 || error.response
                                .status === 422 ? error.response.data
                                .message :
                                (error.response.status + ' ' + error.response.statusText)
                        }

                        toastr.error(message, 'Login gagal', {
                            timeOut: 5000
                        })

                        submitButton.innerHTML = '<i class="fa-solid fa-xmark"></i></i> Login Gagal'

                        setTimeout(function() {
                            submitButton.disabled = false
                            usernameInput.disabled = false
                            passwordInput.disabled = false
                            submitButton.innerHTML = 'Masuk'
                        }, 1000)
                    })

            })
        })
    </script>

</body>

</html>
