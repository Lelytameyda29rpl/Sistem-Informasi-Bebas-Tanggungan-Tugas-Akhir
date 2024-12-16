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
        document.addEventListener('DOMContentLoaded', function () {
            const rows = Array.from(document.querySelectorAll('#table-body tr'));
            const paginationContainer = document.getElementById('pagination');
            const searchInput = document.getElementById('search-input');
            const filterAngkatan = document.getElementById('filter-angkatan');
            const filterProdi = document.getElementById('filter-prodi');
            const filterKelas = document.getElementById('filter-kelas');

            let currentPage = 1;
            const rowsPerPage = 10;

            function displayRows(filteredRows) {
                const startIndex = (currentPage - 1) * rowsPerPage;
                const endIndex = startIndex + rowsPerPage;
                rows.forEach(row => row.style.display = 'none');
                filteredRows.slice(startIndex, endIndex).forEach(row => row.style.display = 'table-row');

                if (filteredRows.length === 0) {
                    const noDataRow = document.createElement('tr');
                    noDataRow.innerHTML = '<td colspan="9" class="text-center table-secondary">Data tidak ditemukan.</td>';
                    document.getElementById('table-body').appendChild(noDataRow);
                }
            }

            function updatePagination(filteredRows) {
                const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
                paginationContainer.innerHTML = '';

                if (totalPages > 1) {
                    if (currentPage > 1) {
                        const prev = document.createElement('li');
                        prev.className = 'page-item';
                        prev.innerHTML = '<a class="page-link" href="#">&laquo;</a>';
                        prev.addEventListener('click', () => {
                            currentPage -= 1;
                            displayRows(filteredRows);
                            updatePagination(filteredRows);
                        });
                        paginationContainer.appendChild(prev);
                    }

                    for (let i = 1; i <= totalPages; i++) {
                        const pageItem = document.createElement('li');
                        pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
                        pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                        pageItem.addEventListener('click', () => {
                            currentPage = i;
                            displayRows(filteredRows);
                            updatePagination(filteredRows);
                        });
                        paginationContainer.appendChild(pageItem);
                    }

                    if (currentPage < totalPages) {
                        const next = document.createElement('li');
                        next.className = 'page-item';
                        next.innerHTML = '<a class="page-link" href="#">&raquo;</a>';
                        next.addEventListener('click', () => {
                            currentPage += 1;
                            displayRows(filteredRows);
                            updatePagination(filteredRows);
                        });
                        paginationContainer.appendChild(next);
                    }
                }
            }

            function searchTable() {
                const query = searchInput.value.toLowerCase();
                const filteredRows = rows.filter(row => {
                    const nim = row.cells[0].textContent.toLowerCase();
                    const nama = row.cells[1].textContent.toLowerCase();
                    return nim.includes(query) || nama.includes(query);
                });
                clearNoDataMessage();
                currentPage = 1;
                displayRows(filteredRows);
                updatePagination(filteredRows);
            }

            function filterTable() {
                const angkatanValue = filterAngkatan.value;
                const prodiValue = filterProdi.value;
                const kelasValue = filterKelas.value;

                const filteredRows = rows.filter(row => {
                    const angkatan = row.cells[4].textContent;
                    const prodi = row.cells[2].textContent;
                    const kelas = row.cells[5].textContent;

                    return (
                        (angkatanValue === '' || angkatan === angkatanValue) &&
                        (prodiValue === '' || prodi === prodiValue) &&
                        (kelasValue === '' || kelas === kelasValue)
                    );
                });
                clearNoDataMessage();
                currentPage = 1;
                displayRows(filteredRows);
                updatePagination(filteredRows);
            }

            function populateKelasOptions() {
                const prodiValue = filterProdi.value;
                const kelasOptions = new Set();

                rows.forEach(row => {
                    if (row.cells[2].textContent === prodiValue || prodiValue === '') {
                        kelasOptions.add(row.cells[5].textContent);
                    }
                });

                filterKelas.innerHTML = '<option value="">Pilih Kelas</option>';
                kelasOptions.forEach(kelas => {
                    const option = document.createElement('option');
                    option.value = kelas;
                    option.textContent = kelas;
                    filterKelas.appendChild(option);
                });

                filterKelas.disabled = kelasOptions.size === 0;
            }

            function clearNoDataMessage() {
                const noDataRow = document.querySelector('#table-body tr td.text-center');
                if (noDataRow && noDataRow.textContent === 'Data tidak ditemukan.') {
                    noDataRow.parentElement.remove();
                }
            }

            searchInput.addEventListener('input', searchTable);
            filterAngkatan.addEventListener('change', filterTable);
            filterProdi.addEventListener('change', () => {
                populateKelasOptions();
                filterTable();
            });
            filterKelas.addEventListener('change', filterTable);

            // Initial display
            displayRows(rows);
            updatePagination(rows);
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
        document.addEventListener("DOMContentLoaded", function () {
            // Ambil semua tombol "Lihat Berkas"
            const buttons = document.querySelectorAll(".lihat-berkas");

            buttons.forEach(button => {
                button.addEventListener("click", function () {
                    const nim = this.getAttribute("data-nim");
                    console.log("NIM yang dikirim:", nim); // Cetak ke console

                    // Kirim NIM melalui POST menggunakan Fetch API
                    fetch("index.php?controller=adminJurusan&action=dashboard", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ nim: nim }) // Kirim NIM sebagai JSON
                    })
                        .then(response => response.json()) // Parse respons JSON
                        .then(data => {
                            console.log("Data Dokumen:", data);

                            // Tampilkan div dokumen-mahasiswa
                            const dokumenContainer = document.querySelector(".dokumen-mahasiswa");
                            dokumenContainer.style.display = "block";

                            // Isi tabel dokumen dengan data dari server
                            const tableBodyDok = document.getElementById("table-body-dok");
                            tableBodyDok.innerHTML = ""; // Reset isi tabel

                            if (data.length > 0) {
                                data.forEach(dokumen => {
                                    tableBodyDok.innerHTML += `
                                    <tr>
                                        <td>${dokumen.nama_dokumen}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" onclick="approveDocument(this)"
                                            style="font-weight: 500;">
                                            Setujui
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                            data-nama-dokumen="${dokumen.nama_dokumen}"
                                            onclick="openCatatanModal(this)" 
                                            style="font-weight: 500;">
                                            Tolak
                                            </button>
                                        </td>
                                        <td>
                                            <a href="../app/Views/Mahasiswa/${dokumen.path}" 
                                            class="btn btn-primary btn-sm" target="_blank"
                                            style="font-weight: 500; background-color: navy;">
                                            <i class="bi bi-box-arrow-up-right" style="margin-right: 5px;"></i>Lihat
                                            </a>
                                        </td>
                                    </tr>
                                `;
                                });
                            } else {
                                tableBodyDok.innerHTML = `
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada dokumen.</td>
                                </tr>
                            `;
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        });

        // Function untuk "Setujui"
        function approveDocument(button) {
            const row = button.closest('tr');
            row.classList.add('table-success');
            row.classList.remove('table-danger');
        }

        // Function untuk "Tolak"
        function openCatatanModal(button) {
            const row = button.closest('tr');
            row.classList.add('table-danger');
            row.classList.remove('table-success');
            const dokumenNama = button.getAttribute('data-nama-dokumen');
            document.getElementById('dokumen-nama').textContent = dokumenNama;
            document.getElementById('catatan-container').style.display = 'flex';
        }

        function closeCatatanModal() {
            var catatanTextarea = document.getElementById('catatan-textarea');
            if (catatanTextarea.value.trim() !== '') {
                catatanTextarea.value = '';
            }
            document.getElementById('catatan-container').style.display = 'none';
        }


        function submitCatatan() {
            var catatan = document.getElementById('catatan-textarea').value;
            if (catatan.trim() === '') {
                alert('Catatan tidak boleh kosong!');
                return;
            }

            console.log('Catatan dikirim:', catatan);
            closeCatatanModal();
        }

        document.querySelectorAll('.btn-danger').forEach(function (button) {
            button.addEventListener('click', function () {
                openCatatanModal(button);
            });
        });
    </script>
</body>

</html>