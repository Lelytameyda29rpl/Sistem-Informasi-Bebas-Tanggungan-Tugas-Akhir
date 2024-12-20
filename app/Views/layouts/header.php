<?php
if (!isset($_SESSION['username'])) {
    // Jika tidak ada session, redirect ke login
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['nama'] ?? 'Guest'; // Nama dari session
$role = $_SESSION['role_user'] ?? 'Unknown'; // Role dari session
$nim = $_SESSION['nim'] ?? 'Unknown';   // NIM dari session
?>

<link rel="stylesheet" href="../public/css/header.css">

<div class="header">
        <div class="toggle-sidebar ">
            <i class="fas fa-bars pe-auto" style="font-size: 16px;"></i>
            <div class="title fw-bold " style="font-size: 14px; margin-left: 15px;"></div>
        </div>
        <div class="user-info d-flex me-2">
            <img alt="User profile picture" height="40" width="40"
                src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"/>
            <div class="name">
                <div class="fw-bold" style="font-size: 14px;"><?= htmlspecialchars($name) ?></div>
                <?php if ($role === 'mahasiswa' && !empty($nim)): ?>
                    <div class="role fw-normal" style="font-size: 12px;"><?= htmlspecialchars($role) ?> / <?= htmlspecialchars($nim) ?></div>
                <?php else: ?>
                    <div class="role fw-normal" style="font-size: 12px;"><?= htmlspecialchars($role) ?></div>
            <?php endif; ?>
            </div>
        </div>
</div>