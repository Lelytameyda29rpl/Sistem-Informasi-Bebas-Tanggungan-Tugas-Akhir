<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

echo "<h1>Welcome to Admin Pusat Dashboard</h1>";
echo "<p>Welcome, " . $_SESSION['username'] . "!</p>";
echo "<p>Role: " . $_SESSION['role'] . "</p>";

// Optionally, add a logout button
echo "<a href='logout.php'>Logout</a>";
?>

<html>
<head>
    <title>
        Dashboard Mahasiswa - Beranda
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js">
    </script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
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
            font-weight: 700;
        }

        .header .title {
            font-size: 14px;
            font-weight: 700;
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
            font-weight: 700;
        }

        .header .user-info .name div:last-child {
            font-weight: 400;
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

        .sidebar .menu-item:hover,
        .sidebar .menu-item.active {
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
            background-color: #1E1E1E;
            color: #fff;
            padding: 20px;
            border-radius: 0px 0px 20px 20px;
            margin-bottom: 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .content .welcome h1 {
            margin-left: 30px;
            font-size: 40px;
            font-weight: 700;
        }

        .content .welcome p {
            margin-left: 30px;
            font-size: 16px;
            font-style: medium;
        }

        .content .chart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 75%;
            margin: 20px auto;
            margin-bottom: 70px;
        }

        .content .chart-title {
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            width: calc(100% - 300px);
            left: 300px;
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
            <img alt="User profile picture" height="40"
                src="https://storage.googleapis.com/a1aa/image/uSIQrHKRrjq2KZy41LVF8qdzktgdnEUAzyxCHtiwfT5q086JA.jpg"
                width="40" />
            <div class="name">
                <div>
                    Jiha Ramdhan
                </div>
                <div class="role">
                    Admin Pusat
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar">
        <a class="menu-item active" href="#">
            <i class="bi bi-house">
            </i>
            Beranda
        </a>
        <a class="menu-item" href="#">
            <i class="bi bi-patch-check">
            </i>
            Verifikasi Tanggungan
        </a>
        <a class="menu-item" href="riwayat_verifikasi.html">
            <i class="bi bi-clock-history">
            </i>
            Riwayat Verifikasi
        </a>
        <a class="menu-item logout" href="#">
            <i class="bi bi-power"></i>
            Keluar
        </a>
    </div>
    <div class="content">
        <div class="welcome">
            <h1>
                Selamat Datang, Jiha
            </h1>
            <p>
                Anda berada di halaman pengajuan bebas tanggungan
            </p>
        </div>
        <div class="chart-container">
            <div class="chart-title">
                Status Proses Verifikasi
            </div>
            <canvas id="chartjs-bar">
            </canvas>
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
                    content.style.marginLeft = '300px';
                    footer.style.width = 'calc(100% - 300px)';
                    footer.style.left = '300px';
                } else {
                    sidebar.style.display = 'none';
                    content.style.marginLeft = '0';
                    footer.style.width = '100%';
                    footer.style.left = '0';
                }
            });

        new Chart(document.getElementById("chartjs-bar"), {
            type: "bar",
            data: {
                labels: ["2020", "2021", "2022", "2023", "2024"],
                datasets: [{
                    label: "Terverifikasi",
                    backgroundColor: "#007bff",
                    borderColor: "#007bff",
                    hoverBackgroundColor: "#007bff",
                    hoverBorderColor: "#007bff",
                    data: [1200, 1500, 1800, 2000, 2200],
                    barPercentage: .75,
                    categoryPercentage: .5,
                    borderWidth: 1,
                    borderRadius: 5,
                    font: {
                        size: 16
                    }
                }, {
                    label: "Belum Terverifikasi",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [800, 700, 600, 500, 400],
                    barPercentage: .75,
                    categoryPercentage: .5,
                    borderWidth: 1,
                    borderRadius: 5,
                    font: {
                        size: 16
                    }
                }, {
                    label: "Total Mahasiswa",
                    backgroundColor: "#ffcc00",
                    borderColor: "#ffcc00",
                    hoverBackgroundColor: "#ffcc00",
                    hoverBorderColor: "#ffcc00",
                    data: [2000, 2200, 2400, 2500, 2600],
                    barPercentage: .75,
                    categoryPercentage: .5,
                    borderWidth: 1,
                    borderRadius: 5,
                    font: {
                        size: 16
                    }
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 3000,
                        ticks: {
                            font: {
                                size: 16
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 16
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>