

<!-- Beranda -->
    <div class="tab-content" id="beranda">
        <div class="welcome">
            <h1>Selamat Datang,  <?php echo $_SESSION['nama']; ?></h1>
            <p>Anda berada di halaman pengajuan bebas tanggungan</p>
        </div>
    <!-- Alert -->
    <div class="alert <?= ($jurusan == 7 && $pusat == 6) ? 'alert-success' : 'alert-warning'; ?> alert-dismissible fade show mt-3" role="alert">
        <i class="fas <?= ($jurusan == 7 && $pusat == 6) ? 'fa-check-circle' : 'fa-exclamation-triangle'; ?>"></i> 
        <?= ($jurusan == 7 && $pusat == 6) ? 'Berkas Lengkap!' : 'Lengkapi Berkas!'; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

        <div class="cards">
            <div class="card">
                <h2>
                <?php if ( $jurusan < 7): ?>
                    <i class="bi bi-exclamation-circle-fill text-danger me-2"></i> <?= htmlspecialchars($jurusan ?? 0); ?> / 7 dokumen
                    <?php else: ?>
                        <i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($jurusan ?? 0); ?> / 7 dokumen
                <?php endif; ?>
                </h2>
                <p>Berkas Tanggungan Jurusan</p>
                <a href="#unggah-jurusan" onclick="showTab('unggah-jurusan')" class="btn btn-success">Lengkapi Berkas</a>
            </div>
            <div class="card">
                <h2>
                <?php if ( $pusat < 6): ?>
                    <i class="bi bi-exclamation-circle-fill text-danger me-2"></i> <?= htmlspecialchars($pusat ?? 0); ?> / 6 dokumen
                    <?php else: ?>
                        <i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($pusat ?? 0); ?> / 6 dokumen
                <?php endif; ?>
                </h2>
                <p>Berkas Persyaratan Ijazah</p>
                <a href="#unggah-ijazah" onclick="showTab('unggah-ijazah')" class="btn btn-success">Lengkapi Berkas</a>
            </div>
        </div>
        <div class="steps mb-5">
            <h3>Langkah-langkah Pengajuan Bebas Tanggungan:</h3>
            <ol>
                <li>Unggah semua berkas yang diperlukan di bagian "Unggah Berkas".</li>
                <li>Pantau status tanggungan Jurusan secara berkala di bagian "Status Tanggungan".</li>
                <li>Pantau status tanggungan Pusat secara berkala di bagian "Pengajuan Ijazah".</li>
                <li>Jika status sudah terverifikasi semua, Maka akan muncul peringatan untuk mengambil Surat Bebas Tanggungan. begitu juga untuk Ijazah</li>
                <li>Cetak secara berkala pada bagian "Status Tanggungan" dan "Pengajuan Ijazah", untuk mendapatkan Surat Bebas Tanggungan dan Ijazah.</li>
                <li>Hubungi verifikator jika ada kendala.</li>
            </ol>
        </div>
    </div>