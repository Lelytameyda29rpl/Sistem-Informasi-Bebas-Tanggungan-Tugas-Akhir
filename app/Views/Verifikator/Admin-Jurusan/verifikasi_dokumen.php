<div class="tab-content" id="verifikasi">
  <div class="welcome">
    <h1>Verifikasi Dokumen Tanggungan TA Mahasiswa</h1>
  </div>
  <div class="table-container">
    <div class="table-header">
      <h2>Tabel Verifikasi Dokumen Mahasiswa</h2>
    </div>
    <div class="table-responsive">
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
          <!-- Data akan diisi secara dinamis -->
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
</div>