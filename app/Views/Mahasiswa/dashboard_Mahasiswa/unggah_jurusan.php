<?php
// Array untuk menyimpan data file yang sudah diunggah
$filePaths = [];
foreach ($data as $file) {
    $filePaths[$file['id_dokumen']] = $file['path'];
}
?>

    <!-- Unggah Berkas Jurusan -->
    <div class="tab-content" id="unggah-jurusan">
        <div class="welcome">
            <h1>Unggah Berkas Jurusan</h1>
        </div>

        <div class="cards mx-1 d-flex flex-column mb-5">
            <div class="card text-start ">
                <form id="uploadForm" action="upload_dokumen.php" method="POST" enctype="multipart/form-data">
                <div id="messageArea"></div>
                    <p class="fw-bold">Berkas Bebas Tanggungan Jurusan</p>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="file1">Laporan Tugas Akhir Skripsi:</label>
                        <div class="d-flex align-items-center">
                                <?php if (!empty($filePaths[1])): ?>
                                    <!-- Tampilkan nama file dan tombol untuk melihat -->
                                    <span class="me-2"><?= basename($filePaths[1]) ?></span>
                                    <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[1]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                    <input type="file" name="dokumen_file[]" id="file1" class="form-control">
                                    <a href="" class="btn btn-light ms-2" download><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file1" class="form-control">
                                    <a href="" class="btn btn-light ms-2" download><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="1">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file2" class="fw-bold">Program/Aplikasi Tugas Akhir/Skripsi:</label>
                        <div class="d-flex align-items-center">
                                <?php if (!empty($filePaths[2])): ?>

                                        <!-- Tampilkan nama file dan tombol untuk melihat -->
                                        <span class="me-2"><?= basename($filePaths[2]) ?></span>
                                        <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[2]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                        <input type="file" name="dokumen_file[]" id="file2" class="form-control">
                                    
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file2" class="form-control">
                                   
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="2">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file3">Surat Pernyataan Pubikasi Jurnal/Paper/Conference/Seminar/HAKI:</label>
                        <div class="d-flex align-items-center">
                                <?php if (!empty($filePaths[3])): ?>
                                    <!-- Tampilkan nama file dan tombol untuk melihat -->
                                    <span class="me-2"><?= basename($filePaths[3]) ?></span>
                                    <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[3]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                    <input type="file" name="dokumen_file[]" id="file3" class="form-control">
                                    <a href="https://docs.google.com/document/d/1rI1ICHfW5Jn5N0olvofHHEx-jH2C51rb/edit" class="btn btn-light ms-2" download target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file3" class="form-control">
                                    <a href="https://docs.google.com/document/d/1rI1ICHfW5Jn5N0olvofHHEx-jH2C51rb/edit" class="btn btn-light ms-2" download target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="3">
                    </div>

                    <br>

                    <p class="fw-bold">Berkas Bebas Tanggungan Prodi</p>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="file4">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca:</label>
                        <div class="d-flex align-items-center">
                                <?php if (!empty($filePaths[4])): ?>
                                    <!-- Tampilkan nama file dan tombol untuk melihat -->
                                    <span class="me-2"><?= basename($filePaths[4]) ?></span>
                                    <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[3]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                    <input type="file" name="dokumen_file[]" id="file4" class="form-control">
                                    <a href="../templates/template_file1.pdf" class="btn btn-light ms-2" download><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file4" class="form-control">
                                    <a href="../templates/template_file1.pdf" class="btn btn-light ms-2" download><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="4">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file5">Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca:</label>
                        <div class="d-flex align-items-center">
                                <?php if (!empty($filePaths[5])): ?>
                                    <!-- Tampilkan nama file dan tombol untuk melihat -->
                                    <span class="me-2"><?= basename($filePaths[5]) ?></span>
                                    <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[3]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                    <input type="file" name="dokumen_file[]" id="file5" class="form-control">
                                    
                                    <a href="https://docs.google.com/document/d/1UueR3U1PcB6NkbHRKQBPpYwm0QgcLgKR/edit#heading=h.gjdgxs" class="btn btn-light ms-2" download target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file5" class="form-control">
                                    <a href="https://docs.google.com/document/d/1UueR3U1PcB6NkbHRKQBPpYwm0QgcLgKR/edit#heading=h.gjdgxs" class="btn btn-light ms-2" download target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="5">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file6">Surat Bebas Kompen:</label>
                        <div class="d-flex align-items-center">
                                <?php if (!empty($filePaths[6])): ?>
                                    <!-- Tampilkan nama file dan tombol untuk melihat -->
                                    <span class="me-2"><?= basename($filePaths[6]) ?></span>
                                    <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[3]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                    <input type="file" name="dokumen_file[]" id="file6" class="form-control">
                                    <a href="https://docs.google.com/document/d/1jywW6IWBx-Lt57shmVRP_b9HOGz5uJst/edit" class="btn btn-light ms-2" download target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file6" class="form-control">
                                    <a href="https://docs.google.com/document/d/1jywW6IWBx-Lt57shmVRP_b9HOGz5uJst/edit" class="btn btn-light ms-2" download target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i></a>
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="6">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file7">Scan Toeic dengan Skor minimal 450:</label>
                        <div class="d-flex align-items-center">
                            <?php if (!empty($filePaths[7])): ?>
                                    <!-- Tampilkan nama file dan tombol untuk melihat -->
                                    <span class="me-2"><?= basename($filePaths[7]) ?></span>
                                    <a href="../app/views/mahasiswa/<?= htmlspecialchars($filePaths[3]) ?>" target="_blank" class="btn btn-info me-2"><i class="bi bi-eye"></i></a>

                                    <input type="file" name="dokumen_file[]" id="file7" class="form-control">
                                <?php else: ?>
                                    <!-- Input file jika belum diunggah -->
                                    <input type="file" name="dokumen_file[]" id="file7" class="form-control">
                                <?php endif; ?>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="7">
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-floppy2 me-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#uploadForm'). submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Create a FormData object from the form

        $.ajax({
            url: '../app/views/Mahasiswa/upload_dokumen.php', // The URL to your PHP script
            type: 'POST',
            data: formData,
            contentType: false, // Tell jQuery not to set contentType
            processData: false, // Tell jQuery not to process the data
            success: function(response) {
                console.log("Raw response from server:", response);
                var result = JSON.parse(response); // Parse the JSON response
                var messageArea = $('#messageArea');
                messageArea.empty(); // Clear previous messages

                if (result.status === 'success') {
                    result.messages.forEach(function(message) {
                        messageArea.append('<div class="alert alert-success">' + message + '</div>');
                    });
                } else {
                    result.messages.forEach(function(message) {
                        messageArea.append('<div class="alert alert-danger">' + message + '</div>');
                    });
                }
            },
            error: function() {
                $('#messageArea').html('<div class="alert alert-danger">An error occurred while uploading the files.</div>');
                console.log("Error details:", textStatus, errorThrown);
            }
        });
    });
});
</script>