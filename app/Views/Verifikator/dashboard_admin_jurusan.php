<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikator - Beranda</title>
    <!-- CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    include __DIR__ . '/../layouts/header.php';
    include __DIR__ . '/../layouts/sidebar_ver.php';
    include __DIR__ . '/../layouts/content_ver.php';
    include __DIR__ . '/../layouts/footer.php';

    ?>
    <!-- filter -->
    <script>
        function toggleFilterModal() {
            const filterModal = document.getElementById('filterModal');
            filterModal.style.display = filterModal.style.display === 'block' ? 'none' : 'block';
        }


        function applyFilters() {
            const searchInput = document.querySelector('.search-input').value.toLowerCase();
            const filterAngkatan = document.getElementById('filterAngkatan').value;
            const filterProdi = document.getElementById('filterProdi').value;
            const filterKelas = document.getElementById('filterKelas').value;

            const rows = document.querySelectorAll('#userTableBody tr');

            rows.forEach(row => {
                const nama = row.cells[1].textContent.toLowerCase();
                const angkatan = row.cells[4].textContent;
                const prodi = row.cells[2].textContent;
                const kelas = row.cells[5].textContent;

                const nameMatch = nama.includes(searchInput);
                const angkatanMatch = !filterAngkatan || angkatan === filterAngkatan;
                const prodiMatch = !filterProdi || prodi === filterProdi;
                const kelasMatch = !filterKelas || kelas === filterKelas;

                row.style.display = nameMatch && angkatanMatch && prodiMatch && kelasMatch ? '' : 'none';
            });

            document.getElementById('filterModal').style.display = 'none';
        }

        document.querySelector('.search-input').addEventListener('input', applyFilters);

        const kelasOptions = {
            "D-IV Teknik Informatika": [
                "TI-4A", "TI-4B", "TI-4C", "TI-4D",
                "TI-4E", "TI-4F", "TI-4G", "TI-4H", "TI-4I"
            ],
            "D-IV Sistem Informasi Bisnis": [
                "SIB-4A", "SIB-4B", "SIB-4C", "SIB-4D",
                "SIB-4E", "SIB-4F", "SIB-4G"
            ]
        };

        function updateKelasOptions() {
            const prodiSelect = document.getElementById('filterProdi');
            const kelasSelect = document.getElementById('filterKelas');

            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';

            const selectedProdi = prodiSelect.value;

            if (selectedProdi) {
                const classes = kelasOptions[selectedProdi];
                classes.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.textContent = kelas;
                    kelasSelect.appendChild(option);
                });
            }
        }
    </script>
    <!-- Sidebar -->
    <script>
        document.querySelector('.toggle-sidebar i').addEventListener('click', function () {
            var sidebar = document.querySelector('.sidebar');
            var content = document.querySelector('.content');
            var footer = document.querySelector('.footer');
            var welcome = document.querySelector('.welcome');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                content.style.marginLeft = '300px';
                footer.style.width = 'calc(100% - 300px)';
                footer.style.left = '300px';
                welcome.style.left = '300px';
            } else {
                sidebar.classList.add('hidden');
                content.style.marginLeft = '0';
                footer.style.width = '100%';
                footer.style.left = '0';
                welcome.style.left = '0';
            }
        });

        // transisi menu sidebar
        function showTab(tab) {
            console.log("Navigating to:", tab);
        }
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
    </script>
    <!-- Load Halaman -->
    <script>
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
    </script>
    <!-- logout -->
    <script>
        document.querySelector('.logout').addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah tindakan default
            localStorage.clear(); // Hapus semua data yang tersimpan
            sessionStorage.clear(); // Opsional: Hapus sessionStorage jika digunakan
            window.location.href = this.getAttribute('href'); // Arahkan ke halaman login
        });
    </script>
    <!-- chart beranda.php -->
    <script>
        new Chart(document.getElementById("chartjs-bar"), {
            type: "bar",
            data: {
                labels: ["2022", "2023", "2024"],
                datasets: [{
                    label: "Terverifikasi",
                    backgroundColor: "#007bff",
                    borderColor: "#007bff",
                    hoverBackgroundColor: "#007bff",
                    hoverBorderColor: "#007bff",
                    data: [
                        <?= htmlspecialchars($terverifikasiCount22 ?? 0) ?>,
                        <?= htmlspecialchars($terverifikasiCount23 ?? 0) ?>,
                        <?= htmlspecialchars($terverifikasiCount24 ?? 0) ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5,
                    borderWidth: 1,
                    borderRadius: 5,
                    font: {
                        size: 12
                    }
                }, {
                    label: "Belum Terverifikasi",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [
                        <?= htmlspecialchars($belumDiverifikasiCount22 ?? 0) ?>,
                        <?= htmlspecialchars($belumDiverifikasiCount23 ?? 0) ?>,
                        <?= htmlspecialchars($belumDiverifikasiCount24 ?? 0) ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5,
                    borderWidth: 1,
                    borderRadius: 5,
                    font: {
                        size: 12
                    }
                }, {
                    label: "Total Mahasiswa",
                    backgroundColor: "#ffcc00",
                    borderColor: "#ffcc00",
                    hoverBackgroundColor: "#ffcc00",
                    hoverBorderColor: "#ffcc00",
                    data: [
                        <?= htmlspecialchars($mahasiswaCount22 ?? 0) ?>,
                        <?= htmlspecialchars($mahasiswaCount23 ?? 0) ?>,
                        <?= htmlspecialchars($mahasiswaCount24 ?? 0) ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5,
                    borderWidth: 1,
                    borderRadius: 5,
                    font: {
                        size: 14
                    }
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 30,
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            }
        });
    </script>

    <!-- tabel verifikasi dokumen mahasiswa -->
    <script>
        const rowsPerPage = 10; // Jumlah data per halaman
        let currentPage = 1; // Halaman saat ini
        let filteredResults = dataMahasiswa; // Data yang difilter (default semua data)


        // Fungsi untuk membuat pagination
        function setupPagination() {
            const totalPages = Math.ceil(filteredResults.length / rowsPerPage);
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = ""; // Reset pagination

            if (currentPage > 1) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">&lt;</a>
            </li>
        `;
            }

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
            <li class="page-item ${i === currentPage ? "active" : ""}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>
        `;
            }

            if (currentPage < totalPages) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">&gt;</a>
            </li>
        `;
            }
        }

        // Fungsi untuk mengubah halaman
        function changePage(page) {
            currentPage = page;
            displayTableData(page);
            setupPagination();
        }

        // Fungsi pencarian data
        function searchTable() {
            const searchInput = document.getElementById("search-input").value.toLowerCase();
            filteredResults = dataMahasiswa.filter((data) => {
                return (
                    data.nama.toLowerCase().includes(searchInput) ||
                    data.nim.toLowerCase().includes(searchInput)
                );
            });
            currentPage = 1;
            displayTableData(currentPage);
            setupPagination();
        }

        // Fungsi filter data
        function filterTable() {
            const angkatan = document.getElementById("filter-angkatan").value;
            const prodi = document.getElementById("filter-prodi").value;
            const kelas = document.getElementById("filter-kelas").value;

            filteredResults = dataMahasiswa.filter((data) => {
                const matchesAngkatan = angkatan === "" || data.role_angkatan === angkatan;
                const matchesProdi = prodi === "" || data.role_prodi === prodi;
                const matchesKelas = kelas === "" || data.kelas === kelas;
                return matchesAngkatan && matchesProdi && matchesKelas;
            });

            currentPage = 1;
            displayTableData(currentPage);
            setupPagination();
        }

        // Fungsi untuk mengisi opsi kelas berdasarkan prodi
        function populateKelasOptions() {
            const prodi = document.getElementById("filter-prodi").value;
            const kelasSelect = document.getElementById("filter-kelas");
            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>'; // Reset opsi kelas

            const kelasByProdi = {
                "D-IV Teknik Informatika": ["TI-1A", "TI-1B", "TI-1C"],
                "D-IV Sistem Informasi Bisnis": ["SIB-1A", "SIB-1B"]
            };

            if (kelasByProdi[prodi]) {
                kelasByProdi[prodi].forEach((kelas) => {
                    const option = document.createElement("option");
                    option.value = kelas;
                    option.textContent = kelas;
                    kelasSelect.appendChild(option);
                });
                kelasSelect.disabled = false;
            } else {
                kelasSelect.disabled = true;
            }
        }

        // Inisialisasi pertama kali
        document.addEventListener("DOMContentLoaded", () => {
            displayTableData(currentPage);
            setupPagination();
        });
    </script>
    <!-- container verifikasi dokumen mahasiswa -->
    <script>
        // Fungsi untuk menampilkan informasi mahasiswa
        function showStudentInfo(nim) {
            // Ambil data mahasiswa berdasarkan NIM (misalnya menggunakan AJAX)
            const studentData = <?= json_encode($mhsDokumenLengkap) ?>.find(student => student.nim === nim);

            if (studentData) {
                // Tampilkan verifikasi container
                document.getElementById('verif-container').style.display = 'block';

                // Isi informasi mahasiswa
                document.getElementById('student-info').innerHTML = `
                    <p><span class="label">NIM</span>: ${studentData.nim}</p>
                    <p><span class="label">Nama Mahasiswa</span>: ${studentData.nama}</p>
                    <p><span class="label">Prodi</span>: ${studentData.role_prodi}</p>
                    <p><span class="label">Jurusan</span>: ${studentData.role_jurusan}</p>
                    <p><span class="label">Angkatan</span>: ${studentData.role_angkatan}</p>
                    <p><span class="label">Kelas</span>: ${studentData.kelas}</p>
                    `;
            }
        }


        // function untuk tombol verif
        function displayVerifContent() {
            document.querySelector('.table-container').style.display = 'none';
            document.querySelector('.verif-container').style.display = 'block';
        }

        function setupVerifButtons() {
            const tableBody = document.getElementById('table-body');

            tableBody.addEventListener('click', function (event) {
                if (event.target.classList.contains('btn-success')) {
                    const row = event.target.closest('tr');
                    if (row) {
                        const cells = row.getElementsByTagName('td');
                        const nim = cells[0].innerText;
                        const nama = cells[1].innerText;
                        const prodi = cells[2].innerText;
                        const jurusan = cells[3].innerText;
                        const angkatan = cells[4].innerText;
                        const kelas = cells[5].innerText;
                        showStudentInfo(nim, nama, prodi, jurusan, angkatan, kelas);
                        displayVerifContent();
                    }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function () {
            const tableBody = document.getElementById('table-body');

            tableBody.addEventListener('click', function (event) {
                if (event.target.classList.contains('btn-success')) {
                    const notification = document.querySelector('.notification');
                    const tableContainer = document.querySelector('.table-container');

                    // Tampilkan notifikasi dengan animasi
                    notification.style.display = 'flex';
                    setTimeout(() => {
                        notification.style.opacity = '1';
                        notification.style.transform = 'translateY(0)';
                    }, 10);

                    // Geser table-container ke bawah
                    tableContainer.style.marginTop = '60px';

                    // Sembunyikan notifikasi dan kembalikan table-container setelah 5 detik
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateY(-10px)';
                        setTimeout(() => {
                            notification.style.display = 'none';
                            tableContainer.style.marginTop = '0';
                        }, 300);
                    }, 5000);
                }
            });
        });
        window.addEventListener('DOMContentLoaded', function () {
            setupVerifButtons();
        });
    </script>
    <!-- dokumen-mahasiswa -->
    <script>
        const dokumenMahasiswa = [
            { dokumen: "Laporan Tugas Akhir/Skripsi" },
            { dokumen: "Program/Aplikasi TA/Skripsi" },
            { dokumen: "Surat Pertanyaan Publikasi" },
            { dokumen: "Tanda Terima Laporan PKL" },
            { dokumen: "Surat Bebas Kompen" },
            { dokumen: "Scan TOEIC" },

        ];

        function displayDokumenData() {
            const tableBodyDok = document.getElementById("table-body-dok");
            tableBodyDok.innerHTML = ""; // Reset tabel

            dokumenMahasiswa.forEach((data) => {
                const row = `
                    <tr>
                        <td>${data.dokumen}</td>
                        <td><button class="btn-success" style="width: 100px; height: 45px">
                        <i class="bi bi-check-lg"></i>
                        </button></td>
                        <td><button class="btn-danger" style="width: 100px; height: 45px">
                        <i class="bi bi-x-lg"></i>
                        </button></td>
                        <td><button class="btn-primary" style="width: 100px; height: 45px">
                        <i class="bi bi-box-arrow-up-right"></i>
                        </button></td>
                    </tr>
                `;
                tableBodyDok.innerHTML += row;
            });
        }

        // Panggil fungsi ini setelah data mahasiswa ditampilkan
        displayDokumenData();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Ambil semua tombol dengan data-target
            const buttons = document.querySelectorAll('button[data-target]');

            // Loop melalui tombol-tombol tersebut
            buttons.forEach(function (button) {
                // Setiap tombol mendapatkan event listener click
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Ambil ID target yang sesuai dengan data-target dari tombol
                    const targetId = button.getAttribute('data-target');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        // Sembunyikan semua kontainer verifikasi lainnya
                        document.querySelectorAll('.verif-container').forEach(function (el) {
                            el.style.display = 'none'; // Menyembunyikan kontainer lainnya
                        });

                        // Tampilkan kontainer verifikasi yang sesuai
                        targetElement.style.display = 'block';

                        // Scroll otomatis ke kontainer yang baru ditampilkan
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

    </script>
</body>

</html>