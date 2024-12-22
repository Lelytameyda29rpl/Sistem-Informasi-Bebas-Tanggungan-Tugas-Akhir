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
          <?php if (!empty($mhsDokumenLengkap)): ?>
            <?php foreach ($mhsDokumenLengkap as $mhs): ?>
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
                  <button type="button" class="btn btn-success btn-sm lihat-berkas"
                    data-nim="<?= htmlspecialchars($mhs['nim']) ?>">
                    Lihat Berkas
                  </button>
                </td>


              </tr>
            <?php endforeach; ?>
          <?php else: ?>
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
  <div class="verif-container" id="verif-container" style="display: none;">
    <h3>Dokumen Tanggungan TA Mahasiswa</h3>
    <div id="student-info" class="student-info">
      <!-- Informasi mahasiswa akan diisi oleh JavaScript -->
    </div>
    <div class="dokumen-mahasiswa">
      <div class="table-responsive" id="tresp1">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nama Dokumen</th>
              <th>Setujui</th>
              <th>Tolak</th>
              <th>Lihat Dokumen</th>
            </tr>
          </thead>
          <tbody id="table-body-dok">
            <!-- Dokumen mahasiswa akan diisi oleh JavaScript -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="catatan-container" id="catatan-container" style="display: none;">
    <div class="overlay"></div>
    <div class="modal-catatan">
        <h3 style="margin-bottom: 10px;">Catatan</h3>
        <textarea id="catatan-textarea" class="form-control" rows="9"
            placeholder="Masukkan catatan di sini..."></textarea>
        <p style="margin-top: 10px;">Jenis Dokumen: <span id="dokumen-nama"></span></p>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-secondary" onclick="closeCatatanModal()">Batal</button>
            <button class="btn btn-warning ms-2" onclick="submitCatatan()">
                <i class="bi bi-send" style="margin-right: 5px;"></i>Kirim
            </button>
        </div>
    </div>
  </div>

<!-- izin stylenya tak masukin kesini soalnya content_ver.css e gakenek (soale kene desain kebanyakan gae bootstrap. dadi edit style ndek pinggir class div e) -->
<style>
  .catatan-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1050;
  }

  .modal-catatan {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 800px;
    height: auto;
    max-width: 90%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }

  .modal-catatan p{
    font-weight: 500;
    font-size: 16px;
  }

  .modal-catatan span{
    font-weight: 100;
  }

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: -1;
  }
</style>