

<!-- Beranda -->
    <div class="tab-content" id="beranda">
        <div class="welcome">
            <h1>Selamat Datang,  <?php echo $_SESSION['nama']; ?></h1>
            <p>Anda berada di halaman pengajuan bebas tanggungan</p>
        </div>
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle"></i> Lengkapi Berkas!
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
                <?php if ( $pusat < 7): ?>
                    <i class="bi bi-exclamation-circle-fill text-danger me-2"></i> <?= htmlspecialchars($pusat ?? 0); ?> / 7 dokumen
                    <?php else: ?>
                        <i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($pusat ?? 0); ?> / 7 dokumen
                <?php endif; ?>
                </h2>
                <p>Berkas Persyaratan Ijazah</p>
                <a href="#" class="btn btn-success">Lengkapi Berkas</a>
            </div>
        </div>
        <div class="steps mb-5">
            <h3>Langkah-langkah Pengajuan Bebas Tanggungan:</h3>
            <ol>
                <li>Unggah semua berkas yang diperlukan di bagian "Unggah Berkas".</li>
                <li>Pantau status tanggungan secara berkala di bagian "Status Tanggungan".</li>
                <li>Jika status sudah terverifikasi semua, ajukan Surat Bebas Tanggungan.</li>
                <li>Cetak secara berkala pada bagian "Status Pengajuan", untuk Cetak Surat Bebas Tanggungan.</li>
                <li>Hubungi verifikator jika ada kendala.</li>
            </ol>
        </div>
    </div>