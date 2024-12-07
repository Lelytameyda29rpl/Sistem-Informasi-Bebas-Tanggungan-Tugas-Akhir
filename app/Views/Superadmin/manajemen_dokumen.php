<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['username']) || $_SESSION['role_user'] !== 'superadmin') {
    header("Location: ../Views/login.php");
    exit();
}

// Ambil username dari session
$username = $_SESSION['username'] ?? 'Pengguna';
$nama = $_SESSION['nama'] ?? 'Pengguna';
$role_user = $_SESSION['role_user'] ?? 'Tidak diketahui';

?>

<html>
 <head>
  <title>
   Dashboard Admin - Beranda
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
   body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f5f5f5;
            color: #1E1E1E;
        }
        .header {
            background-color: #fff;
            color: #1E1E1E;
            box-shadow: 0px -4px 25.1px 0px rgba(0, 0, 0, 0.25);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            width: 100%;
            height: 76px;
            z-index: 1000;
        }
        .header .toggle-sidebar {
            display: flex;
            align-items: center;
        }
        .header .toggle-sidebar i {
            margin-right: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700; /* Inter Bold */
        }
        .header .title {
            font-size: 14px;
            font-weight: 700; /* Inter Bold */
            margin-left: 10px;
        }
        .header .user-info {
            display: flex;
            align-items: center;
        }
        .header .user-info img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .header .user-info .name {
            font-size: 14px;
        }

        .header .user-info .role {
            font-size: 12px;
        }

        .header .user-info .name div:first-child {
            font-weight: 700; /* Inter Bold */
        }
        .header .user-info .name div:last-child {
            font-weight: 400; /* Inter Regular */
        }
        .sidebar {
            height: 100vh;
            width: 300px;
            margin-top: 10px;
            background-color: #fff;
            position: fixed;
            top: 50px;
            bottom: 0;
            border-right: 1px solid #ddd;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            z-index: 999;
            box-shadow: 0px -4px 25.1px 0px rgba(0, 0, 0, 0.25);
            transform: translateX(0);
        }
        .sidebar.hidden {
            transform: translateX(-100%);
        }
        .sidebar .menu-item {
            padding: 15px 20px;
            color: #333;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            border-radius: 10px;
            margin: 0 14px;
        }
        .sidebar .menu-item:hover, .sidebar .menu-item.active {
            background-color: #FFAF01;
            color: #1E1E1E;
        }
        .sidebar .menu-item i {
            margin-right: 10px; 
            font-size: 20px;
            display: inline-block;
        }
        .sidebar .menu-item.logout {
            color: #DC3545;
            margin-top: auto;
            margin-bottom: 70px;
        }
        .content {
            margin-left: 300px;
            transition: margin-left 0.3s;
            padding-top: 70px;
        }
        .content .welcome {
            background-color: #1E1E1E;;
            color: #fff;
            padding: 20px;
            border-radius: 0px 0px 20px 20px;;
            margin-bottom: 20px;
            height: 110px;
            width: 100%;
        }
        .content .welcome h1 {
            margin: 10px;
            font-size: 30px;
            font-style: bold;
        }
        .table-container {
            margin: 20px 50px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        }
        .table-header {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            margin-bottom: 20px;
        }
        .table-header h2 {
            margin: 0; 
            font-size: 1.5rem; 
            color: #333; 
        }
        .table-header .btn {
            margin-top: 10px; 
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: left;
        }
        .user-table th,
        .user-table td {
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        .user-table th {
            background-color: #f7f7f7;
            font-weight: 700;
            color: #555;
        }
        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .user-table .status {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            color: #fff;
            display: inline-block;
            text-align: center;
        }
        .user-table .status-approved {
            background-color: #28a745;
        }
        .user-table .status-rejected {
            background-color: #dc3545;
        }
        .modal-header {
            font-weight: bold;
        }
        .modal-hapus .modal-header {
            background-color: #dc3545;
            color: white;
        }
        .modal-footer .btn {
            padding: 10px 15px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            width: calc(100% - 250px);
            left: 250px;
            transition: width 0.3s, left 0.3s;
        }
        .toggle-sidebar {
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                display: none;
            }
            .content {
                margin-left: 0;
            }
            .footer {
                width: 100%;
                left: 0;
            }
        }
  </style>
 </head>
 <body>
  <div class="header">
   <div class="toggle-sidebar">
    <i class="fas fa-list">
    </i>
    <div class="title">
     SISTEM BEBAS TANGGUNGAN TA
    </div>
   </div>
   <div class="user-info">
    <img alt="User profile picture" height="40" src="https://storage.googleapis.com/a1aa/image/AW0PXsLkpnZ8DNB4clVvuVaJnwXJMkA3KDoEGtUoITZtlc9E.jpg" width="40"/>
    <div class="name">
     <div>
     <?= htmlspecialchars($nama); ?> <!-- Nama diambil dari session -->
     </div>
     <div class="role">
     <?= htmlspecialchars($role_user); ?> <!-- Role diambil dari session -->
     </div>
    </div>
   </div>
  </div>
  <div class="sidebar">
   <a class="menu-item" href="http://localhost/Sistem-Informasi-Bebas-Tanggungan-Tugas-Akhir/app/Controllers/SuperAdminController.php?action=dashboard">
    <i class="bi bi-house"></i>
    Beranda
   </a>
   <a class="menu-item" href="http://localhost/Sistem-Informasi-Bebas-Tanggungan-Tugas-Akhir/app/Controllers/SuperAdminController.php?action=manageUsers">
    <i class="fas fa-users"></i>
    </i>
    Manajemen Pengguna
   </a>
   <a class="menu-item active" href="http://localhost/Sistem-Informasi-Bebas-Tanggungan-Tugas-Akhir/app/Controllers/SuperAdminController.php?action=manageDocuments">
    <i class="fas fa-folder"></i>
    Manajemen Dokumen
   </a>
   <a class="menu-item logout" href="http://localhost/Sistem-Informasi-Bebas-Tanggungan-Tugas-Akhir/app/Views/logout.php">
    <i class="bi bi-power"></i>
    Keluar
   </a>
  </div>
  <div class="content">
    <div class="welcome">
        <h1>Manajemen Dokumen</h1>
    </div>
    <div class="table-container">
    <div class="table-header">
        <h2>Data Riwayat Verifikasi</h2>
    </div>
    <table class="user-table">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Unggah</th>
                <th>Status</th>
                <th>Nama Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($documents)): ?>
                        <?php foreach ($documents as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc['nama_mahasiswa']); ?></td>
                                <td><?= htmlspecialchars($doc['tgl_upload']); ?></td>
                                <td>
                                    <span class="status <?= $doc['status_verifikasi'] === 'Sudah Diunggah' ? 'status-approved' : 'status-rejected'; ?>"><?= htmlspecialchars($doc['status_verifikasi']); ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($doc['nama_dokumen']); ?></td>
                                <td>
                                <button class="btn btn-delete" data-toggle="modal" data-target="#modalHapus">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">Tidak ada data dokumen</td></tr>
                    <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- Modal Hapus -->
<div class="modal fade modal-hapus" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">Hapus Data Riwayat Verifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data riwayat mahasiswa ini?</p>
                <p><strong>Nama:</strong> <span id="hapusNama"><?= htmlspecialchars($doc['nama_mahasiswa']); ?></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmHapus">Hapus</button>
            </div>
        </div>
    </div>
</div>
  <div class="footer">
   ©2024 Jurusan Teknologi Informasi
  </div>
  <script>
   document.querySelector('.toggle-sidebar i').addEventListener('click', function() {
            var sidebar = document.querySelector('.sidebar');
            var content = document.querySelector('.content');
            var footer = document.querySelector('.footer');
            if (sidebar.style.display === 'none' || sidebar.style.display === '') {
                sidebar.style.display = 'block';
                content.style.marginLeft = '250px';
                footer.style.width = 'calc(100% - 250px)';
                footer.style.left = '250px';
            } else {
                sidebar.style.display = 'none';
                content.style.marginLeft = '0';
                footer.style.width = '100%';
                footer.style.left = '0';
            }
        });
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
 </body>
</html>