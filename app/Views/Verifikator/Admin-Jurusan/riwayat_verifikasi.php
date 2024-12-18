<div class="tab-content" id="riwayat">
    <div class="welcome">
        <h1>Riwayat Verifikasi Mahasiswa</h1>
    </div>
    <div class="table-container table-responsive">
        <div class="table-header">
            <h2>Riwayat Verifikasi Dokumen Mahasiswa</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Kelas</th>
                    <th>No.Telepon</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
            <?php if (!empty($riwayatVerifJurusan)): ?>
            <?php foreach ($riwayatVerifJurusan as $riwayat): ?>
              <tr>
                <td><?= htmlspecialchars($riwayat['nim']) ?></td>
                <td><?= htmlspecialchars($riwayat['nama']) ?></td>
                <td><?= htmlspecialchars($riwayat['role_prodi']) ?></td>
                <td><?= htmlspecialchars($riwayat['role_jurusan']) ?></td>
                <td><?= htmlspecialchars($riwayat['role_angkatan']) ?></td>
                <td><?= htmlspecialchars($riwayat['kelas']) ?></td>
                <td><?= htmlspecialchars($riwayat['no_telp']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="text-center">Tidak ada data mahasiswa.</td>
            </tr>
          <?php endif; ?>
            </tbody>
        </table>

        <div class="search-filter-container d-flex justify-content-between align-items-center">
            <input type="text" class="search-input form-control" style="width: 400px"
                placeholder="Cari Nama Mahasiswa...">
            <div class="filter-container d-flex align-items-center">
                <select id="filterAngkatan" class="form-select me-2">
                    <option value="">Pilih Angkatan</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                </select>
                <select id="filterProdi" class="form-select me-2" onchange="updateKelasOptions()">
                    <option value="">Pilih Prodi</option>
                    <option value="D-IV Teknik Informatika">D-IV Teknik Informatika</option>
                    <option value="D-IV Sistem Informasi Bisnis">D-IV Sistem Informasi Bisnis</option>
                </select>
                <select id="filterKelas" class="form-select">
                    <option value="">Pilih Kelas</option>
                </select>
            </div>
        </div>
        <div class="pagination justify-content-end mt-3">
            <ul class="pagination-rwt" id="pagination-rwt"></ul>
        </div>
    </div>
</div>

<style>

</style>