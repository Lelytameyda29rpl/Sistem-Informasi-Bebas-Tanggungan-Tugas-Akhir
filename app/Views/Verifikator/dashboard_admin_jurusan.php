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
                        <?= htmlspecialchars($terverifikasiCount22 ?? 0)?>, 
                        <?= htmlspecialchars($terverifikasiCount23 ?? 0)?>, 
                        <?= htmlspecialchars($terverifikasiCount24 ?? 0)?>
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
                        <?= htmlspecialchars($belumDiverifikasiCount22 ?? 0)?>, 
                        <?= htmlspecialchars($belumDiverifikasiCount23 ?? 0)?>, 
                        <?= htmlspecialchars($belumDiverifikasiCount24 ?? 0)?>
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
                        <?= htmlspecialchars($mahasiswaCount22 ?? 0)?>, 
                        <?= htmlspecialchars($mahasiswaCount23 ?? 0)?>, 
                        <?= htmlspecialchars($mahasiswaCount24 ?? 0)?>
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
        // Data kelas untuk setiap prodi
        const kelasByProdi = {
            "D-IV Teknik Informatika": ["TI-4A", "TI-4B", "TI-4C", "TI-4D", "TI-4E", "TI-4F", "TI-4G", "TI-4H", "TI-4I"],
            "D-IV Sistem Informasi Bisnis": ["SIB-4A", "SIB-4B", "SIB-4C", "SIB-4D", "SIB-4E", "SIB-4F", "SIB-4G"]
        };

        // Data mahasiswa
        const dataMahasiswa = [
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720068", nama: "Jiha Ramdhan", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4B", telp: "085752897356", tanggal: "2024-02-20" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-3D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720078", nama: "Octrian Adiluhung Tito Putra", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4D", telp: "085771220364", tanggal: "2024-04-05" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Baskara", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2024", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720124", nama: "Lelyta Meyda", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2023", kelas: "TI-4A", telp: "081252295353", tanggal: "2024-01-15" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },
            { nim: "2341720113", nama: "M. Fatih Al Ghifary", prodi: "D-IV Teknik Informatika", jurusan: "Teknologi Informasi", angkatan: "2022", kelas: "TI-4C", telp: "085847139712", tanggal: "2024-03-10" },

            // Tambahkan data lainnya di sini
        ];

        const rowsPerPage = 10; // Jumlah data per halaman
        let currentPage = 1; // Halaman saat ini

        // Fungsi untuk mengisi opsi kelas berdasarkan prodi
        function populateKelasOptions() {
            const prodi = document.getElementById("filter-prodi").value;
            const kelasSelect = document.getElementById("filter-kelas");
            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>'; // Reset opsi kelas

            if (kelasByProdi[prodi]) {
                kelasByProdi[prodi].forEach((kelas) => {
                    const option = document.createElement("option");
                    option.value = kelas;
                    option.textContent = kelas;
                    kelasSelect.appendChild(option);
                });
                kelasSelect.disabled = false; // Aktifkan dropdown kelas
            } else {
                kelasSelect.disabled = true; // Nonaktifkan jika prodi tidak dipilih
            }
        }

        // Fungsi untuk menampilkan data pada tabel
        function displayTableData(page) {
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = page * rowsPerPage;
            const tableBody = document.getElementById("table-body");
            tableBody.innerHTML = ""; // Reset tabel

            const paginatedData = dataMahasiswa.slice(startIndex, endIndex);
            paginatedData.forEach((data) => {
                const row = `
            <tr>
                <td>${data.nim}</td>
                <td>${data.nama}</td>
                <td>${data.prodi}</td>
                <td>${data.jurusan}</td>
                <td>${data.angkatan}</td>
                <td>${data.kelas}</td>
                <td>${data.telp}</td>
                <td>${data.tanggal}</td>
                <td><button class="btn btn-success btn-sm">Verif</button></td>
            </tr>
        `;
                tableBody.innerHTML += row;
            });
        }

        // Fungsi untuk membuat pagination
        function setupPagination() {
            const totalPages = Math.ceil(dataMahasiswa.length / rowsPerPage);
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = ""; // Reset pagination

            // Tampilkan tombol Previous jika bukan halaman pertama
            if (currentPage > 1) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">&lt;</a>
            </li>
        `;
            }

            // Menentukan halaman yang akan ditampilkan
            const pagesToShow = [];
            let startPage = currentPage - 1;
            let endPage = currentPage + 1;

            if (currentPage === 1) {
                endPage = Math.min(3, totalPages);
            } else if (currentPage === totalPages) {
                startPage = Math.max(totalPages - 2, 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i > 0 && i <= totalPages) {
                    pagesToShow.push(i);
                }
            }

            // Tampilkan "..." jika ada halaman lebih banyak sebelum atau setelah range yang ditampilkan
            if (pagesToShow[0] > 1) {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        `;
            }

            // Tampilkan tombol halaman
            pagesToShow.forEach((page) => {
                pagination.innerHTML += `
            <li class="page-item ${page === currentPage ? "active" : ""}">
                <a class="page-link" href="#" onclick="changePage(${page})">${page}</a>
            </li>
        `;
            });

            if (pagesToShow[pagesToShow.length - 1] < totalPages) {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
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

        // Fungsi pencarian data berdasarkan Nama atau NIM
        // Variabel global untuk menyimpan hasil pencarian
        let filteredResults = [];

        // Fungsi pencarian
        function searchTable() {
            const searchInput = document.getElementById("search-input").value.toLowerCase();
            const tableBody = document.getElementById("table-body");
            tableBody.innerHTML = ""; // Reset tabel

            // Filter data berdasarkan nama atau nim
            filteredResults = dataMahasiswa.filter((data) => {
                return (
                    data.nama.toLowerCase().includes(searchInput) ||
                    data.nim.toLowerCase().includes(searchInput)
                );
            });

            // Jika input pencarian kosong, tampilkan kembali data dengan paginasi
            if (searchInput === "") {
                filteredResults = dataMahasiswa; // Kembali ke semua data
                currentPage = 1; // Reset ke halaman pertama
                displayTableData(currentPage);
                setupPagination();
                return;
            }

            // Menampilkan data hasil pencarian dengan paginasi
            const paginatedData = filteredResults.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage);

            paginatedData.forEach((data) => {
                const row = `
            <tr>
                <td>${data.nim}</td>
                <td>${data.nama}</td>
                <td>${data.prodi}</td>
                <td>${data.jurusan}</td>
                <td>${data.angkatan}</td>
                <td>${data.kelas}</td>
                <td>${data.telp}</td>
                <td>${data.tanggal}</td>
                <td><button class="btn btn-success btn-sm">Verif</button></td>
            </tr>
        `;
                tableBody.innerHTML += row;
            });

            // Jika tidak ada data yang cocok
            if (filteredResults.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="9" class="text-center">Data tidak ditemukan</td></tr>`;
            }

            // Setup ulang paginasi untuk hasil pencarian
            setupPaginationForSearch();
        }

        // Fungsi untuk setup paginasi hasil pencarian
        function setupPaginationForSearch() {
            const totalPages = Math.ceil(filteredResults.length / rowsPerPage);
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = ""; // Reset pagination

            // Tampilkan tombol Previous jika bukan halaman pertama
            if (currentPage > 1) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changeSearchPage(${currentPage - 1})">&lt;</a>
            </li>
        `;
            }

            // Menentukan halaman yang akan ditampilkan
            const pagesToShow = [];
            let startPage = currentPage - 1;
            let endPage = currentPage + 1;

            if (currentPage === 1) {
                endPage = Math.min(3, totalPages);
            } else if (currentPage === totalPages) {
                startPage = Math.max(totalPages - 2, 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i > 0 && i <= totalPages) {
                    pagesToShow.push(i);
                }
            }

            // Tampilkan "..." jika ada halaman lebih banyak sebelum atau setelah range yang ditampilkan
            if (pagesToShow[0] > 1) {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        `;
            }

            pagesToShow.forEach((page) => {
                pagination.innerHTML += `
            <li class="page-item ${page === currentPage ? "active" : ""}">
                <a class="page-link" href="#" onclick="changeSearchPage(${page})">${page}</a>
            </li>
        `;
            });

            if (pagesToShow[pagesToShow.length - 1] < totalPages) {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        `;
            }

            // Tampilkan tombol Next jika bukan halaman terakhir
            if (currentPage < totalPages) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changeSearchPage(${currentPage + 1})">&gt;</a>
            </li>
        `;
            }
        }

        // Fungsi untuk mengubah halaman pada hasil pencarian
        function changeSearchPage(page) {
            currentPage = page;
            const tableBody = document.getElementById("table-body");
            tableBody.innerHTML = ""; // Reset tabel

            const paginatedData = filteredResults.slice((currentPage - 1) * rowsPerPage, currentPage * rowsPerPage);

            paginatedData.forEach((data) => {
                const row = `
            <tr>
                <td>${data.nim}</td>
                <td>${data.nama}</td>
                <td>${data.prodi}</td>
                <td>${data.jurusan}</td>
                <td>${data.angkatan}</td>
                <td>${data.kelas}</td>
                <td>${data.telp}</td>
                <td>${data.tanggal}</td>
                <td><button class="btn btn-success btn-sm">Verif</button></td>
            </tr>
        `;
                tableBody.innerHTML += row;
            });

            setupPaginationForSearch();
        }


        const searchInput = document.getElementById("search-input").value.toLowerCase();
        const tableBody = document.getElementById("table-body");
        tableBody.innerHTML = ""; // Reset tabel

        // Filter data berdasarkan nama atau nim
        const filteredData = dataMahasiswa.filter((data) => {
            return (
                data.nama.toLowerCase().includes(searchInput) ||
                data.nim.toLowerCase().includes(searchInput)
            );
        });

        // Menampilkan data yang sesuai hasil pencarian
        filteredData.forEach((data) => {
            const row = `
                    <tr>
                        <td>${data.nim}</td>
                        <td>${data.nama}</td>
                        <td>${data.prodi}</td>
                        <td>${data.jurusan}</td>
                        <td>${data.angkatan}</td>
                        <td>${data.kelas}</td>
                        <td>${data.telp}</td>
                        <td>${data.tanggal}</td>
                        <td><button class="btn btn-success btn-sm">Verif</button></td>
                    </tr>
                `;
            tableBody.innerHTML += row;
        });

        // Jika tidak ada data yang cocok
        if (filteredData.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="9" class="text-center">Data tidak ditemukan</td></tr>`;
        }

        // Jika input pencarian kosong, tampilkan kembali data dengan paginasi
        if (searchInput === "") {
            currentPage = 1; // Reset ke halaman pertama
            displayTableData(currentPage);
            setupPagination();
        }


        // Fungsi filter data berdasarkan Nama, NIM, Angkatan, Prodi, dan Kelas
        function filterTable() {
            const searchInput = document.getElementById("search-input").value.toLowerCase();
            const angkatan = document.getElementById("filter-angkatan").value;
            const prodi = document.getElementById("filter-prodi").value;
            const kelas = document.getElementById("filter-kelas").value;
            const tableBody = document.getElementById("table-body");
            tableBody.innerHTML = ""; // Reset tabel

            // Filter data mahasiswa berdasarkan semua kriteria
            const filteredData = dataMahasiswa.filter((data) => {
                const matchesSearch = data.nama.toLowerCase().includes(searchInput) || data.nim.toLowerCase().includes(searchInput);
                const matchesAngkatan = angkatan === "" || data.angkatan === angkatan;
                const matchesProdi = prodi === "" || data.prodi === prodi;
                const matchesKelas = kelas === "" || data.kelas === kelas;
                return matchesSearch && matchesAngkatan && matchesProdi && matchesKelas;
            });

            // Jika input pencarian kosong dan tidak ada filter, tampilkan kembali data dengan paginasi
            if (searchInput === "" && angkatan === "" && prodi === "" && kelas === "") {
                currentPage = 1; // Reset ke halaman pertama
                displayTableData(currentPage);
                setupPagination();
                return;
            }

            // Pagination untuk data yang difilter
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = currentPage * rowsPerPage;
            const paginatedData = filteredData.slice(startIndex, endIndex);

            // Tampilkan data yang sesuai filter dan paginasi
            paginatedData.forEach((data) => {
                const row = `
            <tr>
                <td>${data.nim}</td>
                <td>${data.nama}</td>
                <td>${data.prodi}</td>
                <td>${data.jurusan}</td>
                <td>${data.angkatan}</td>
                <td>${data.kelas}</td>
                <td>${data.telp}</td>
                <td>${data.tanggal}</td>
                <td><button class="btn btn-success btn-sm">Verif</button></td>
            </tr>
        `;
                tableBody.innerHTML += row;
            });

            // Tampilkan pesan jika tidak ada data yang sesuai
            if (filteredData.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="9" class="text-center">Data tidak ditemukan</td></tr>`;
            }

            // Setup pagination untuk data yang difilter
            setupFilteredPagination(totalPages);
        }

        function setupFilteredPagination(totalPages) {
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = ""; // Reset pagination

            // Tampilkan tombol Previous jika bukan halaman pertama
            if (currentPage > 1) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changeFilteredPage(${currentPage - 1})">&lt;</a>
            </li>
        `;
            }

            // Menentukan halaman yang akan ditampilkan
            const pagesToShow = [];
            let startPage = currentPage - 1;
            let endPage = currentPage + 1;

            if (currentPage === 1) {
                endPage = Math.min(3, totalPages);
            } else if (currentPage === totalPages) {
                startPage = Math.max(totalPages - 2, 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i > 0 && i <= totalPages) {
                    pagesToShow.push(i);
                }
            }

            // Tampilkan "..." jika ada halaman lebih banyak sebelum atau setelah range yang ditampilkan
            if (pagesToShow[0] > 1) {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        `;
            }

            // Tampilkan tombol halaman
            pagesToShow.forEach((page) => {
                pagination.innerHTML += `
            <li class="page-item ${page === currentPage ? "active" : ""}">
                <a class="page-link" href="#" onclick="changeFilteredPage(${page})">${page}</a>
            </li>
        `;
            });

            if (pagesToShow[pagesToShow.length - 1] < totalPages) {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        `;
            }

            if (currentPage < totalPages) {
                pagination.innerHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="changeFilteredPage(${currentPage + 1})">&gt;</a>
            </li>
        `;
            }
        }

        function changeFilteredPage(page) {
            currentPage = page;
            filterTable();
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
        function showStudentInfo(nim, nama, prodi, jurusan, angkatan, kelas) {
            document.getElementById('info-nim').innerText = nim;
            document.getElementById('info-nama').innerText = nama;
            document.getElementById('info-prodi').innerText = prodi;
            document.getElementById('info-jurusan').innerText = jurusan;
            document.getElementById('info-angkatan').innerText = angkatan;
            document.getElementById('info-kelas').innerText = kelas;

            // Tampilkan informasi mahasiswa
            document.getElementById('student-info').style.display = 'block';
        }

        // Tambahkan event listener pada setiap baris tabel
        document.addEventListener('DOMContentLoaded', function () {
            const tableBody = document.getElementById('table-body');

            tableBody.addEventListener('click', function (event) {
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
                }
            });
        });

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
</body>

</html>