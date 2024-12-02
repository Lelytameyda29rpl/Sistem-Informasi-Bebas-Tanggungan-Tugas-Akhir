<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" />

    <title>SIBTTA</title>

    <style>
        :root{
            --primary-color: #1e1e1e;
            --secondary-color: #fff;
            --textcolor: #fff;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        .container {
            padding: 10px 100px;
        }

        .section {
            padding: 60px 0;
        }

        .bg-dark-section {
            background-color: var(--primary-color);
            color: var(--textcolor);
        }

        .header {
            height: 100%;
            background-color: var(--primary-color);
            color: var(--textcolor);
        }

        .header a {
            color: var(--textcolor);
        }

        #navbarNav a:hover {
            color: #FFAF01;
        }

        footer {
            background-color: var(--primary-color);
            color: var(--textcolor);
        }

        #Beranda .btn{
            transition: 0.3s ease-in-out;
        }

        #Beranda .btn:hover {
            color: var(--primary-color);
            background-color: #FFAF01;
            border-color: #FFAF01;
        }

        @media screen and (max-width: 1200px) {
            .container {
                padding: 10px 20px;
            }

        }

        .navbar-nav .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }


    </style>
</head>

<body>

    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand fw-bold" href="#">SIBTTA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tentang-kami"
                                onclick="scrollToSection(event, 'tentang-kami')">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fitur" onclick="scrollToSection(event, 'fitur')">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#panduan" onclick="scrollToSection(event, 'panduan')">Panduan</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="nav-link btn btn-dark rounded-pill fw-bold px-4" href="login.php">Masuk</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Beranda -->
    <div class="section text-center bg-dark-section" id="Beranda">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-6 text-md-start">
                    <h1 class="fw-bold">Selamat Datang di Sistem Bebas Tanggungan Tugas Akhir Polinema</h1>
                    <p class="mt-3">Permudah proses pengajuan bebas tanggungan Anda dengan sistem daring yang
                        terintegrasi.</p>
                    <a href="login.php" class="btn btn-light rounded-pill mt-3 px-4 fw-bold">Mulai Sekarang</a>
                </div>
                <div class="col-md-6 p-5">
                    <img src="../../assets/Toga.svg" alt="SIBTTA" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <div class="section" id="tentang-kami" data-aos="fade-up">
        <div class="container">
            <div class="text-center">
                <h2 class="fw-bold mb-4">Tentang Sistem Bebas Tanggungan</h2>
                <p>
                    Sistem Bebas Tanggungan Tugas Akhir (SIBTTA) adalah solusi digital inovatif yang dirancang
                    untuk membantu mahasiswa Polinema dalam mengurus administrasi bebas tanggungan.
                    Dengan platform ini, proses pengajuan menjadi lebih cepat, terintegrasi, dan efisien.
                </p>
                <p>
                    Kami bertujuan memberikan kemudahan kepada mahasiswa, verifikator, dan admin dalam pengelolaan data
                    dan dokumentasi secara daring, sehingga semua pihak dapat fokus pada tugas inti masing-masing.
                </p>
                <!-- <a href="#" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a> -->
            </div>
        </div>
    </div>

    <!-- Section: Fitur Utama -->
    <div class="section py-5 bg-light" data-aos="fade-up" id="fitur">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Fitur Utama</h2>
            <div id="carouselFeatures" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Pengunggahan Berkas</h5>
                                        <p class="card-text">Mahasiswa dapat mengunggah berkas yang diperlukan seperti
                                            laporan tugas akhir, surat bebas kompen, dan sertifikat TOEIC secara
                                            langsung melalui sistem. Setiap berkas yang diunggah akan otomatis tersimpan
                                            dan dapat diperiksa oleh admin.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Verifikasi Online</h5>
                                        <p class="card-text">Sistem memungkinkan admin jurusan dan admin prodi untuk
                                            melakukan verifikasi berkas mahasiswa secara daring. Proses verifikasi ini
                                            memudahkan semua pihak dalam memastikan kelengkapan dokumen tanpa perlu
                                            bertatap muka.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"> Notifikasi Status</h5>
                                        <p class="card-text">Mahasiswa dapat melihat status terbaru dari berkas-berkas
                                            yang telah diajukan. Status verifikasi akan diperbarui secara langsung oleh
                                            admin setelah proses pengecekan selesai, sehingga mahasiswa dapat memantau
                                            setiap tahapan proses.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeatures"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselFeatures"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>


    <!-- Panduan Pengguna -->
    <div class="section" id="panduan" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Panduan Pengguna</h2>
            <div class="row justify-content-center">
                <!-- Langkah 1 -->
                <div class="col-md-10 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="step-number me-3">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px;">
                                1
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Login</h5>
                            <p>Login menggunakan akun Polinema yang valid. </p>
                        </div>
                    </div>
                </div>
                <!-- Langkah 2 -->
                <div class="col-md-10 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="step-number me-3">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px;">
                                2
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Unggah Berkas</h5>
                            <p>Unggah berkas yang diperlukan sesuai dengan petunjuk dan persyaratan yang ada.</p>
                        </div>
                    </div>
                </div>
                <!-- Langkah 3 -->
                <div class="col-md-10 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="step-number me-3">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px;">
                                3
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Verifikasi Berkas</h5>
                            <p>Tunggu hingga admin melakukan verifikasi berkas. Anda dapat memantau status verifikasi di
                                halaman profil Anda. </p>
                        </div>
                    </div>
                </div>
                <!-- Langkah 4 -->
                <div class="col-md-10 mb-4">
                    <div class="d-flex align-items-start">
                        <div class="step-number me-3">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px;">
                                4
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Cetak Surat Bebas Tanggungan</h5>
                            <p>Jika semua berkas telah disetujui, Anda dapat mencetak Surat Bebas Tanggungan sebagai
                                syarat pengambilan ijazah dan transkrip.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container text-center">
            <div class="row ">
                <div class="col-md-3 p-5">
                    <img src="../../assets/Toga.svg" alt="SIBTTA" class="img-fluid">
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold">No. Telepon</h5>
                    <p>Admin Jurusan (Mas Anggi)</p>
                    <p>089563050522(Chat Only)</p>
                    <p>Admin Prodi (Bu Yanti)</p>
                    <p>083800666233 (Chat Only)</p>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold">Email</h5>
                    <p>info@sibtta.com</p>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold">Alamat</h5>
                    <p>Jl. Soekarno Hatta No. 9, Malang</p>
                </div>
            </div>
        </div>
        <div class="container text-center text-muted">
            <p>Copyright © 2024 • Jurusan Teknologi Informasi - Politeknik Negeri Malang</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- atur efek klik navbar biar agar agak keatas -->
    <script>
        function scrollToSection(event, sectionId) {
            event.preventDefault();
            const section = document.getElementById(sectionId);

            const offset = 150; // Ubah ini sesuai kebutuhan untuk mengatur offset ke atas
            const sectionPosition = section.getBoundingClientRect().top + window.scrollY - offset;

            window.scrollTo({
                top: sectionPosition,
                behavior: 'smooth' // Menambahkan efek smooth scroll
            });
        }
    </script>

    <script>
        // Fungsi untuk mengubah link aktif
        function updateActiveLink() {
            const sections = document.querySelectorAll('.section'); // Ambil semua elemen dengan kelas 'section'
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link'); // Ambil semua link di navbar

            let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop; // Posisi scroll saat ini

            sections.forEach(section => {
                const sectionTop = section.offsetTop; // Posisi atas section
                const sectionHeight = section.clientHeight; // Tinggi section

                // Cek apakah posisi scroll berada dalam section saat ini
                if (scrollPosition >= sectionTop - 300 && scrollPosition < sectionTop + sectionHeight) {
                    // Jika ya, tambahkan kelas 'active' pada link yang sesuai
                    navLinks.forEach(link => {
                        link.classList.remove('active'); // Hapus kelas 'active' dari semua link
                        if (link.getAttribute('href') === '#' + section.id) {
                            link.classList.add('active'); // Tambahkan kelas 'active' pada link yang sesuai
                        }
                    });
                }
            });
        }

        // Event listener untuk scroll
        window.addEventListener('scroll', updateActiveLink);
    </script>
</body>

</html>