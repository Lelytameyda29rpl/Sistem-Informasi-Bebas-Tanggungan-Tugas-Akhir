    <!-- Unggah Berkas Jurusan -->
    <div class="tab-content" id="unggah-jurusan">
        <div class="welcome">
            <h1>Unggah Berkas Jurusan</h1>
        </div>

        <div class="cards mx-1 d-flex flex-column mb-5">
            <div class="card text-start ">
                <form>
                    <p class="fw-bold">Berkas Bebas Tanggungan Jurusan</p>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="berkas2">Laporan Tugas Akhir Skripsi:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Program/Aplikasi Tugas Akhir/Skripsi:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Surat Pernyataan Pubikasi Jurnal/Paper/Conference/Seminar/HAKI:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>

                    <br>

                    <p class="fw-bold">Berkas Bebas Tanggungan Prodi</p>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="berkas2">Tanda Terima Penyerahan Laporan Tugas Akhir/Skripsi ke Ruang Baca:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Tanda Terima Penyerahan Laporan PKL/Magang ke Ruang Baca:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Surat Bebas Kompen:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Scan Toeic dengan Skor minimal 450:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i
                                    class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i
                                    class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i
                                    class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-floppy2 me-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>