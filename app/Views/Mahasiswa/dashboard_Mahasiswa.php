<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Beranda</title>

    <!-- External Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            background-color: #f5f5f5;
            color: #1E1E1E;
        }

        @media (max-width: 768px) {

            .footer {
                left: 0;
                width: 100%;
            }
        }

    </style>
</head>

<body>
    <?php 
    include(__DIR__ . '/../layouts/header.php');
    include(__DIR__ . '/../layouts/sidebar_mhs.php');
    include(__DIR__ . '/../layouts/content_mhs.php');
    include(__DIR__ . '/../layouts/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    

    <script>
        function toggleIcon(element) {
            const icon = element.querySelector(".rotate-icon");
            icon.classList.toggle("rotated"); // Toggle kelas untuk memutar ikon
        }

        function showTab(tab) {
            console.log("Navigating to:", tab);
        }
    </script>

    <script>
        document.querySelector('.toggle-sidebar i').addEventListener('click', function () {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            const footer = document.querySelector('.footer');
            sidebar.classList.toggle('hidden');
            content.classList.toggle('full-width');
            footer.classList.toggle('full-width');
        });
    </script>

    <script>
        function showTab(tabId) {
            // Sembunyikan semua tab
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });

            // Tampilkan tab yang dipilih
            const targetTab = document.getElementById(tabId);
            if (targetTab) {
                targetTab.classList.add('active');
            }
        }

        // // Event Listener untuk menu item
        // document.querySelectorAll('.menu-item').forEach(item => {
        //     item.addEventListener('click', function (e) {
        //         e.preventDefault();

        //         // Hapus kelas aktif pada semua menu
        //         document.querySelectorAll('.menu-item').forEach(menu => menu.classList.remove('active'));

        //         // Tambahkan kelas aktif pada menu yang diklik
        //         this.classList.add('active');

        //         // Tampilkan tab yang sesuai
        //         const tabId = this.getAttribute('href').substring(1); // Ambil ID dari href (#)
        //         showTab(tabId);
        //     });
        // });

        // // Tampilkan tab pertama kali
        // showTab('beranda');

        // Event Listener untuk menu item
        document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function (e) {
        e.preventDefault();

        // Hapus kelas aktif pada semua menu
        document.querySelectorAll('.menu-item').forEach(menu => menu.classList.remove('active'));

        // Tambahkan kelas aktif pada menu yang diklik
        this.classList.add('active');

        // Tampilkan tab yang sesuai
        const tabId = this.getAttribute('href').substring(1); // Ambil ID dari href (#)
        showTab(tabId);

        // Simpan tab aktif ke localStorage
        localStorage.setItem('activeTab', tabId);
        });
        });

        // load halaman yang sama
        // Default
        window.addEventListener('load', () => {
        const activeTab = localStorage.getItem('activeTab') || 'beranda'; // Default ke 'beranda'
        showTab(activeTab);

        // Tandai menu aktif
        document.querySelectorAll('.menu-item').forEach(menu => {
            if (menu.getAttribute('href') === `#${activeTab}`) {
                menu.classList.add('active');
            } else {
                menu.classList.remove('active');
            }
        });
        });

        // logout
        document.querySelector('.logout').addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah tindakan default
        localStorage.clear(); // Hapus semua data yang tersimpan
        sessionStorage.clear(); // Opsional: Hapus sessionStorage jika digunakan
        window.location.href = this.getAttribute('href'); // Arahkan ke halaman login
        });

    </script>


</body>

</html>