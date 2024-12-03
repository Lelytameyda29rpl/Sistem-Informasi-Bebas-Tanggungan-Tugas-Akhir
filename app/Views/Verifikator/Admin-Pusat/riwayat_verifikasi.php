<div class="tab-content" id="riwayat">
        <div class="welcome">
            <h1>Riwayat Verifikasi Mahasiswa</h1>
        </div>
        <div class="table-container">
            <div class="table-header">
                <h2>Riwayat Verifikasi Dokumen Mahasiswa</h2>
                <div class="search-filter-container">
                    <input type="text" class="search-input" placeholder="Cari Nama Mahasiswa...">
                    <div class="filter-dropdown-container">
                        <button class="filter-btn" onclick="toggleFilterModal()">
                            <i class="bi bi-filter"></i>
                        </button>
                        <div class="filter-modal" id="filterModal">
                            <div class="filter-modal-header">
                                <h5 class="mb-0">Filter Data</h5>
                                <button type="button" class="filter-modal-close" onclick="toggleFilterModal()">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="p-3">
                                <select id="filterAngkatan" class="w-full mb-2 p-2 border border-gray-200 rounded-lg">
                                    <option value="">Pilih Angkatan</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                </select>
                                <select id="filterProdi" class="w-full mb-2 p-2 border border-gray-200 rounded-lg"
                                    onchange="updateKelasOptions()">
                                    <option value="">Pilih Prodi</option>
                                    <option value="D-IV Teknik Informatika">D-IV Teknik Informatika</option>
                                    <option value="D-IV Sistem Informasi Bisnis">D-IV Sistem Informasi Bisnis</option>
                                </select>
                                <select id="filterKelas" class="w-full mb-2 p-2 border border-gray-200 rounded-lg">
                                    <option value="">Pilih Kelas</option>
                                </select>
                                <button class="bg-gray-900 text-white p-2 rounded-lg w-full"
                                    onclick="applyFilters()">Terapkan Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Kelas</th>
                        <th>No.Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <tr>
                        <td>2341720124</td>
                        <td>Lelyta Meyda</td>
                        <td>D-IV Teknik Informatika</td>
                        <td>Teknologi Informasi</td>
                        <td>2023</td>
                        <td>TI-4A</td>
                        <td>081252295353</td>
                        <td>
                            <button class="btn btn-edit" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2341720068</td>
                        <td>Jiha Ramdhan</td>
                        <td>D-IV Teknik Informatika</td>
                        <td>Teknologi Informasi</td>
                        <td>2023</td>
                        <td>TI-4B</td>
                        <td>085752897356</td>
                        <td>
                            <button class="btn btn-edit" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2341720113</td>
                        <td>M. Fatih Al Ghifary</td>
                        <td>D-IV Teknik Informatika</td>
                        <td>Teknologi Informasi</td>
                        <td>2022</td>
                        <td>TI-4C</td>
                        <td>085847139712</td>
                        <td>
                            <button class="btn btn-edit" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2341720078</td>
                        <td>Octrian Adiluhung Tito Putra</td>
                        <td>D-IV Teknik Informatika</td>
                        <td>Teknologi Informasi</td>
                        <td>2022</td>
                        <td>TI-4D</td>
                        <td>085771220364</td>
                        <td>
                            <button class="btn btn-edit" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>