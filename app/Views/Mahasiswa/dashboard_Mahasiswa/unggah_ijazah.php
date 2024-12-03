    <!-- Unggah Berkas Ijazah -->
    <div class="tab-content" id="unggah-ijazah">
        <div class="welcome">
            <h1>Unggah Berkas Ijazah</h1>
        </div>

        <div class="cards mx-1 d-flex flex-column mb-5">
            <div class="card text-start ">
                <form>
                    <p class="fw-bold">Berkas Pengajuan Ijazah</p>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="berkas2">Surat Bebas Tanggungan Jurusan:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i class="bi bi-box-arrow-up-right"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Surat Bebas Tanggungan Akademik Pusat:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i class="bi bi-box-arrow-up-right"></i></button>
                            <a href="" class="btn btn-warning" target="_blank">Ajukan</a>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Surat Bebas Pustaka Perpustakaan Polinema:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i class="bi bi-box-arrow-up-right"></i></button>
                            <a href="" class="btn btn-warning" target="_blank">Ajukan</a>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Surat Kebenaran Data Diri:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i class="bi bi-box-arrow-up-right"></i></button>
                            <a href="https://siakad.polinema.ac.id/" class="btn btn-warning" target="_blank">SIAKAD</a>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Bukti Pengisian Kuisioner Kantor Jaminan Mutu:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i class="bi bi-box-arrow-up-right"></i></button>
                            <a href="https://wa.link/ujcmlw" class="btn btn-warning" target="_blank">Kontak</a>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas2">Bukti Pengisian SKPI:</label>
                        <div class="d-flex align-items-center">
                            <input type="file" id="berkas1" class="form-control" onchange="handleFileChange(event)">
                            <button class="btn btn-danger" style="border-radius: 0;" onclick="removeFile()"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-info me-2" style="border-radius: 0;" onclick="previewFile()"><i class="bi bi-box-arrow-up-right"></i></button>
                            <button class="btn btn-light" style="border-radius: 0;" onclick="downloadTemplate()"><i class="bi bi-download"></i></button>
                        </div>
                        <label class="form-text">Format PDF, Maksimal 10 MB</label>
                    </div>
                    <br>


                    <button type="submit" class="btn btn-success mt-3"><i class="bi bi-floppy2 me-2"></i>Simpan</button>
                </form>
            </div>
        </div>

    </div>