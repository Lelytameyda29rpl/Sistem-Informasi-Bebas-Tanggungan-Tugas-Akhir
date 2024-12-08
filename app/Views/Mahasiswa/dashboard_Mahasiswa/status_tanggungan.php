<?php
// Cek apakah semua dokumen sudah diverifikasi
$allVerified = true;
foreach ($statusJurusan as $row) {
    if ($row['status_verifikasi'] !== 'Sudah Diverifikasi') {
        $allVerified = false;
        break;
    }
}
?>

<!-- Status tanggungan -->
<div id="status" class="tab-content mb-5">
    <div class="welcome">
        <h1>Status Tanggungan</h1>
    </div>
    <div class="cards">
        <div class="card">
            <div class="h3 text-start">Tabel Riwayat Tanggungan</div>
            <hr>
            <table class="table mt-2 text-start table-borderless table-striped table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Nama Berkas</th>
                        <th scope="col">Tanggal Unggah</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($statusJurusan as $row): ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($row['nama_dokumen']) ?></th>
                            <td><?= $row['tgl_upload'] ? date('d-m-Y', strtotime($row['tgl_upload'])) : '-' ?></td>
                            <td>
                                <?php if ($row['status_verifikasi'] === 'Sudah Diverifikasi'): ?>
                                    <button class="btn btn-success" disabled>Sudah Diverifikasi</button>
                                <?php elseif ($row['status_verifikasi'] === 'Menunggu Diverifikasi'): ?>
                                    <button class="btn btn-warning" disabled>Menunggu</button>
                                <?php elseif ($row['status_verifikasi'] === 'Gagal Diverifikasi'): ?>
                                    <button class="btn btn-danger" disabled>Gagal</button>
                                    <p class="text-danger mt-2">
                                        <?= htmlspecialchars($row['catatan'] ?? 'Tidak ada catatan.') ?>
                                    </p>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>Belum Diunggah</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="btn btn-success mt-3" style="width: 250px;"
                <?= $allVerified ? '' : 'disabled' ?>>Ajukan Bebas Tanggungan</button>
        </div>
    </div>
    <p class="mt-3">Pastikan semua berkas Anda telah diverifikasi sebelum mengajukan Surat Bebas Tanggungan.</p>
</div>