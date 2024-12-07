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
                            <input type="file" name="dokumen_file[]" id="file1" class="form-control" onchange="handleFileChange(event)" required>
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="1">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file2">Program/Aplikasi Tugas Akhir/Skripsi:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" name="dokumen_file[]"id="file2" class="form-control" onchange="handleFileChange(event)" required>
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="2">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file3">Surat Pernyataan Pubikasi Jurnal/Paper/Conference/Seminar/HAKI:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" name="dokumen_file[]" id="file3" class="form-control" onchange="handleFileChange(event)" required>
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
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
                            <input type="file" name="dokumen_file[]" id="file4" class="form-control" onchange="handleFileChange(event)" required>
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="4">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file5">Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" name="dokumen_file[]" id="file5" class="form-control" onchange="handleFileChange(event)" required>
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="5">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file6">Surat Bebas Kompen:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" name="dokumen_file[]" id="file6" class="form-control" onchange="handleFileChange(event)" required> 
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                        <input type="hidden" name="id_dokumen[]" value="6">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file7">Scan Toeic dengan Skor minimal 450:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" name="dokumen_file[]" id="file7" class="form-control" onchange="handleFileChange(event)" required>
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
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