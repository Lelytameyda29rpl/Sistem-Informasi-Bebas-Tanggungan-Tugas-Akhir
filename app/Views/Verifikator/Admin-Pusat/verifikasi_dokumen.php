<div class="tab-content" id="verifikasi">
    <div class="welcome">
      <h1>Verifikasi Dokumen Tanggungan TA Mahasiswa</h1>
    </div>
    <div class="notification" style="display: none;">
      <i class="bi bi-bell-fill" style="margin-right: 10px;"></i>
      <span>Scroll kebawah untuk melihat dokumen tanggungan TA mahasiswa</span>
    </div>
    <div class="table-container">
      <div class="table-header">
        <h2>Tabel Verifikasi Dokumen Mahasiswa</h2>
      </div>
      <div class="table-responsive" id="tresp1">
        <table class="table table-striped table-hover" id="data-table">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama Mahasiswa</th>
              <th>Prodi</th>
              <th>Jurusan</th>
              <th>Angkatan</th>
              <th>Kelas</th>
              <th>No.Telepon</th>
              <th>Tanggal Unggah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="table-body">
          <?php if (!empty($mhsDokumenLengkap)) : ?>
                    <?php foreach ($mhsDokumenLengkap as $mhs) : ?>
                        <tr>
                            <td><?= htmlspecialchars($mhs['nim']) ?></td>
                            <td><?= htmlspecialchars($mhs['nama']) ?></td>
                            <td><?= htmlspecialchars($mhs['role_prodi']) ?></td>
                            <td><?= htmlspecialchars($mhs['role_jurusan']) ?></td>
                            <td><?= htmlspecialchars($mhs['role_angkatan']) ?></td>
                            <td><?= htmlspecialchars($mhs['kelas']) ?></td>
                            <td><?= htmlspecialchars($mhs['no_telp']) ?></td>
                            <td><?= htmlspecialchars($mhs['tgl_upload']) ?></td>
                            <td>
                                <form action="index.php?controller=adminJurusan&action=dashboard" method="POST" class="d-inline">
                                    <input type="hidden" name="nim" value="<?= htmlspecialchars($mahasiswa['nim']) ?>">
                                    <button type="submit" class="btn btn-primary btn-sm" data-target="#modalVerif<?= htmlspecialchars($mahasiswa['nim']) ?>">Verif</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data mahasiswa.</td>
                    </tr>
                <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <!-- Search Bar -->
        <div class="search-bar">
          <input type="text" id="search-input" class="form-control" placeholder="Cari..." onkeyup="searchTable()">
        </div>
        <!-- Filter Bar -->
        <div class="filter-bar d-flex align-items-center">
          <select id="filter-angkatan" class="form-select me-2" onchange="filterTable()">
            <option value="">Pilih Angkatan</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
          </select>

          <select id="filter-prodi" class="form-select me-2" onchange="populateKelasOptions(); filterTable();">
            <option value="">Pilih Prodi</option>
            <option value="D-IV Teknik Informatika">D-IV Teknik Informatika</option>
            <option value="D-IV Sistem Informasi Bisnis">D-IV Sistem Informasi Bisnis</option>
          </select>

          <select id="filter-kelas" class="form-select" onchange="filterTable()" disabled>
            <option value="">Pilih Kelas</option>
          </select>
        </div>
        <nav>
          <ul class="pagination justify-content-center mb-0" id="pagination">
            <!-- Pagination akan diisi secara dinamis -->
          </ul>
        </nav>
      </div>
    </div>
    <div class="verif-container" id="modalVerif<?= htmlspecialchars($mahasiswa['nim']) ?>" style="display: none;">
      <h3>Dokumen Tanggungan TA Mahasiswa</h3>
      <div id="student-info" class="student-info">
        <p><span class="label">NIM</span>: <?= htmlspecialchars($mahasiswa['nim']) ?> <span id="info-nim"></span></p>
        <p><span class="label">Nama Mahasiswa</span>: <?= htmlspecialchars($mahasiswa['nama']) ?> <span id="info-nama"></span></p>
        <p><span class="label">Prodi</span>: <?= htmlspecialchars($mhs['role_prodi']) ?> <span id="info-prodi"></span></p>
        <p><span class="label">Jurusan</span>: <?= htmlspecialchars($mhs['role_jurusan']) ?> <span id="info-jurusan"></span></p>
        <p><span class="label">Angkatan</span>: <?= htmlspecialchars($mhs['role_angkatan']) ?> <span id="info-angkatan"></span></p>
        <p><span class="label">Kelas</span>: <?= htmlspecialchars($mhs['kelas']) ?> <span id="info-kelas"></span></p>
      </div>
      <div cla="dokumen-mahasiswa">
        <div class="table-responsive" id="tresp1">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nama Dokumen</th>
                <th>Setujui</th>
                <th>Tolak</th>
                <th>Lihat Berkas</th>
              </tr>
            </thead>
            <tbody id="table-body-dok">
              <tr>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>