<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Security</title>

    <link rel="stylesheet" href="{{ asset('build/assets/app-DFj-i_GL.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="flex bg-dashboard-admin">
    <!-- Sidebar -->
    <aside class="w-56 bg-dashboard-security min-h-screen">
        <div class="mb-8 flex justify-center p-5">
            <img src="img/logo.png" alt="Logo ParkinTime">
        </div>
        <nav>
            <ul>
                <li class="bg-copyright mb-4 flex items-center">
                    <img src="img/dashboard.png" alt="Dashboard" class="w-6 h-6 mr-2">
                    <a href="#" class="text-[#075e54] font-semibold">Dashboard</a>
                </li>
                <li class="bg-sidebar-security mb-4 flex items-center">
                    <img src="img/daftar-pengguna.png" alt="Daftar Pengguna" class="w-6 h-6 mr-2">
                    <a href="#" class="text-gray-700 hover:text-[#075e54]">Daftar Pengguna</a>
                </li>
                <li class="bg-sidebar-security mb-4 flex items-center">
                    <img src="img/data-lahan-parkir.png" alt="Data Lahan Parkir" class="w-6 h-6 mr-2">
                    <a href="#" class="text-gray-700 hover:text-[#075e54]">Data Lahan Parkir</a>
                </li>
                <li class="bg-sidebar-security mb-4 flex items-center">
                    <img src="img/data-kendaraan.png" alt="Data Kendaraan" class="w-6 h-6 mr-2">
                    <a href="#" class="text-gray-700 hover:text-[#075e54]">Data Kendaraan</a>
                </li>
                <li class="bg-sidebar-security mb-4 flex items-center">
                    <img src="img/riwayat-tiket-online.png" alt="Riwayat Tiket Online" class="w-6 h-6 mr-2">
                    <a href="#" class="text-gray-700 hover:text-[#075e54]">Riwayat Tiket Online</a>
                </li>
                <li class="bg-sidebar-security mb-4 flex items-center">
                    <img src="img/pengaturan.png" alt="Pengaturan" class="w-6 h-6 mr-2">
                    <a href="#" class="text-gray-700 hover:text-[#075e54]">Pengaturan</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Header / Navbar -->
        <header class="w-full bg-dashboard-security px-6 py-4 mb-2 flex justify-between items-center">
            <!-- Logo atau Judul -->
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <!-- Navigasi / Tombol -->
            <nav>
                <ul class="flex items-center space-x-4">
                    <li>
                        <button
                            class="flex items-center text-white px-4 py-2 rounded hover:bg-[#4e7c70] transition-colors">
                            <img src="img/logout.png" alt="Logout" class="w-5 h-5 mr-2">
                            Logout
                        </button>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Stats Cards -->
        <section class="flex flex-wrap justify-between gap-6 mb-8 p-6">
            <!-- Card 1 -->
            <div
                class="relative h-24 p-4 border rounded-lg shadow transition-transform duration-300 hover:scale-105 bg-box-menu w-full sm:w-[calc(50%-1.5rem)] md:w-[calc(25%-1.5rem)]">
                <!-- Icon Detail (kanan atas) -->
                <img src="img/detail.png" alt="Detail Jumlah Pengguna" class="w-4 h-4 absolute top-2 right-2">
                <!-- Icon Utama (kiri) -->
                <img src="img/jumlah-pengguna.png" alt="Jumlah Pengguna"
                    class="w-12 h-12 absolute left-4 top-1/2 transform -translate-y-1/2">
                <!-- Container Teks yang centered -->
                <div class="absolute inset-0 flex justify-center items-center">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white" style="-webkit-text-stroke: 1px black;">782</h3>
                        <p class="text-xl text-black">Jumlah Pengguna</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="relative h-24 p-4 border rounded-lg shadow transition-transform duration-300 hover:scale-105 bg-box-menu w-full sm:w-[calc(50%-1.5rem)] md:w-[calc(25%-1.5rem)]">
                <img src="img/detail.png" alt="Detail Jumlah Lahan Parkir" class="w-4 h-4 absolute top-2 right-2">
                <img src="img/jumlah-lahan-parkir.png" alt="Jumlah Lahan Parkir"
                    class="w-12 h-12 absolute left-4 top-1/2 transform -translate-y-1/2">
                <div class="absolute inset-0 flex justify-center items-center">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white" style="-webkit-text-stroke: 1px black;">57</h3>
                        <p class="text-xl text-black">Jumlah Lahan Parkir</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="relative h-24 p-4 border rounded-lg shadow transition-transform duration-300 hover:scale-105 bg-box-menu w-full sm:w-[calc(50%-1.5rem)] md:w-[calc(25%-1.5rem)]">
                <img src="img/detail.png" alt="Detail Jumlah Kendaraan" class="w-4 h-4 absolute top-2 right-2">
                <img src="img/jumlah-kendaraan.png" alt="Jumlah Kendaraan"
                    class="w-12 h-12 absolute left-4 top-1/2 transform -translate-y-1/2">
                <div class="absolute inset-0 flex justify-center items-center">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white" style="-webkit-text-stroke: 1px black;">821</h3>
                        <p class="text-xl text-black">Jumlah Kendaraan</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div
                class="relative h-24 p-4 border rounded-lg shadow transition-transform duration-300 hover:scale-105 bg-box-menu w-full sm:w-[calc(50%-1.5rem)] md:w-[calc(25%-1.5rem)]">
                <img src="img/detail.png" alt="Detail Jumlah Tiket" class="w-4 h-4 absolute top-2 right-2">
                <img src="img/jumlah-tiket.png" alt="Jumlah Tiket"
                    class="w-12 h-12 absolute left-4 top-1/2 transform -translate-y-1/2">
                <div class="absolute inset-0 flex justify-center items-center">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-white" style="-webkit-text-stroke: 1px black;">1564</h3>
                        <p class="text-xl text-black">Jumlah Tiket</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Charts Section -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6">
            <div
                class="bg-[#FCD6B5] rounded-full shadow-xl p-6 max-w-[600px] mx-auto aspect-[4/3] flex items-center justify-between relative">
                <!-- Kiri: Icon di atas, Judul di bawah -->
                <div class="flex flex-col items-start pl-4 space-y-4">
                    <div class="flex flex-col items-center gap-2">
                        <img src="img/lock.png" alt="Lock" class="w-10 h-10">
                        <h2 class="text-xl font-semibold text-black text-center">Vip Spot <br> Percentage</h2>
                    </div>
                </div>

                <!-- Kanan: Chart -->
                <div class="w-80 h-80">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
            <div class="relative bg-box-statistik rounded-lg shadow-xl p-6">
                <!-- Gambar detail di pojok kanan atas -->
                <img src="img/detail.png" alt="Detail Tiket Parkir" class="w-4 h-4 absolute top-2 right-2">
                <!-- Judul -->
                <div class="flex items-center mb-4">
                    <h2 class="text-xl font-semibold text-black">
                        Statistik Tiket Parkir
                    </h2>
                </div>
                <!-- Chart -->
                <canvas id="barChart" class="w-full h-48"></canvas>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div class="relative bg-box-statistik rounded-lg p-6 shadow-xl">
                <!-- Gambar detail di pojok kanan atas -->
                <img src="img/detail.png" alt="Detail Waktu Parkir" class="w-4 h-4 absolute top-2 right-2">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-black">
                        Jangka Waktu Parkir
                    </h2>
                </div>
                <canvas id="lineChart" class="w-full h-64"></canvas>
            </div>
            <div class="relative bg-box-statistik rounded-lg p-6 shadow-xl">
                <!-- Gambar detail di pojok kanan atas -->
                <img src="img/detail.png" alt="Detail Lahan Parkir" class="w-4 h-4 absolute top-2 right-2">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-black">
                        Statistik Lahan Parkir
                    </h2>
                </div>
                <canvas id="lineChart2" class="w-full h-64"></canvas>
            </div>
        </section>
    </main>

    <!-- JavaScript untuk Chart.js -->
    <script>
        // Pie/Donut Chart
        // Ambil elemen canvas
        const vipValue = 25;
        const totalSpot = 8132;
        const ctxPie = document.getElementById("pieChart").getContext("2d");
        new Chart(ctxPie, {
            type: "doughnut",
            data: {
                labels: ["VIP Spot", "Regular Spot"],
                datasets: [{
                    data: [vipValue, 100 - vipValue],
                    backgroundColor: ["#FAF0B3", "#5F88FA"],
                    borderWidth: 0,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "45%", // Lubang tengah lebih kecil
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
            plugins: [{
                id: "centerTextPlugin",
                afterDatasetsDraw(chart) {
                    const {
                        ctx,
                        chartArea
                    } = chart;
                    const meta = chart.getDatasetMeta(0);
                    const vipArc = meta.data[0];

                    const centerAngle = (vipArc.startAngle + vipArc.endAngle) / 2;
                    const r = (vipArc.outerRadius + vipArc.innerRadius) / 2;

                    // --- Untuk 25% ---
                    // MAU LEBIH OFFSIDE => JARAK R DIBESARKAN
                    const offsideDistance = 40; // tambah jarak biar lebih keluar
                    const vipTextX = vipArc.x + (r + offsideDistance) * Math.cos(centerAngle);
                    const vipTextY = vipArc.y + (r + offsideDistance) * Math.sin(centerAngle);

                    ctx.save();

                    // Teks 25%
                    ctx.font = "bold 40px sans-serif"; // Ukuran diperbesar
                    ctx.fillStyle = "#000";
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillText(`${vipValue}%`, vipTextX, vipTextY);

                    // --- Untuk teks di tengah donut (Total Spot) ---
                    const centerX = chartArea.left + chartArea.width / 2;
                    const centerY = chartArea.top + chartArea.height / 2;

                    // Teks "Total Spot"
                    ctx.font = "bold 20px sans-serif";
                    ctx.fillText("Total Spot", centerX, centerY - 10); // geser dikit ke atas biar rapi

                    // Teks angka total
                    ctx.font = "bold 26px sans-serif"; // lebih besar
                    ctx.fillText(`${totalSpot}`, centerX, centerY + 20);

                    ctx.restore();
                }
            }],
        });

        // Bar Chart
        const ctxBar = document.getElementById("barChart").getContext("2d");
        new Chart(ctxBar, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
                datasets: [{
                    label: "Tiket Parkir",
                    data: [50, 75, 60, 90, 120, 80],
                    backgroundColor: "#4caf50",
                }, ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        // Line Chart (Jumlah Pengguna)
        const ctxLine = document.getElementById("lineChart").getContext("2d");
        new Chart(ctxLine, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
                datasets: [{
                    label: "Jumlah Pengguna",
                    data: [100, 200, 250, 400, 550, 700],
                    borderColor: "#075e54",
                    backgroundColor: "rgba(7,94,84,0.2)",
                    fill: true,
                    tension: 0.3,
                }, ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        // Line Chart (Statistik Lahan Parkir)
        const ctxLine2 = document.getElementById("lineChart2").getContext("2d");
        new Chart(ctxLine2, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
                datasets: [{
                    label: "Lahan Parkir",
                    data: [30, 35, 40, 50, 55, 60],
                    borderColor: "#ffa000",
                    backgroundColor: "rgba(255,160,0,0.2)",
                    fill: true,
                    tension: 0.3,
                }, ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
</body>


</html>
