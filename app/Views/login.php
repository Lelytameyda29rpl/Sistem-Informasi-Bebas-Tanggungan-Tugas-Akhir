<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" />

    <title>Login</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            --primary-color: #1e1e1e;
            --primary-color2: #fbfbfb;
            --secondary-color: #fff;

        }

        .bg {
            background-color: var(--primary-color);
            width: 100%;
            height: 100vh;
        }

        .login {
            width: 100%;
            height: 100vh;
            background-color: var(--primary-color2);

        }

        .kembali:hover {
            border-radius: 50px;
            color: #fff;
            background-color: #ff7575;
            cursor: pointer;
        }

        @media screen and (max-width: 768px) {
            .bg {
                height: 20vh;
            }

            .login {
                height: 60vh;
            }
        }
    </style>

</head>

<body>

    <section>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 p-0">
                    <div class="bg position-relative d-flex justify-content-center align-items-center">
                        <!-- Logo -->
                        <img src="../../assets/Logo.svg" alt="Logo"
                            class="img-fluid position-absolute top-0 start-0 mt-1 ms-3 p-3"
                            style="height: 5rem; width: auto;">

                        <!-- Motif -->
                        <img src="../../assets/motif.svg" alt="motif" class="img-fluid position-absolute"
                            style="max-width: 100%; height: auto;">
                    </div>
                </div>



                <div class="col-md-6 align-items-center justify-content-center">
                    <div class="login d-flex align-items-center justify-content-center">
                        <div class="card " style="width: 30rem;">
                            <div class="card-body">
                                <a href="landing.php" class="btn btn-light rounded-pill mb-3 kembali">
                                    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                                </a>
                                <form class="px-4 py-3" action="" method="POST">
                                    <h5 class="card-title fw-bold">Login</h5>
                                    <div class="card my-3 border-warning">
                                        <div class="card-body text-dark bg-warning">
                                            <p style="font-size: 75%; margin-bottom: 0px;"><b>Bagi Mahasiswa:</b> gunakan akun Siakad <br>
                                                <b>Bagi Admin/Verifikator:</b> gunakan akun Portal Polinema</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1"
                                            placeholder="email@polinema.ac.id" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                            <label class="form-check-label" for="dropdownCheck">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark rounded mt-5" style="width: 100%;">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>