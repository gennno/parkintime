<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ParkinTime</title>
    <link rel="icon" type="image/png" href="img/logo-tablet.png">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DFj-i_GL.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<body class="bg-white">
    <!-- Wrapper yang benar: flex untuk sidebar + content -->
    <div x-data="{ open: false }" class="flex min-h-screen relative">

        <!-- Overlay mobile -->
        <div x-show="open" @click="open = false" class="fixed inset-0 backdrop-blur-sm bg-white/5 z-40 md:hidden">
        </div>

        <!-- Sidebar -->
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 left-0 z-50 min-h-full bg-[#E2F1E7] p-5 transform transition-transform duration-300
            md:translate-x-0 md:static md:block overflow-y-auto w-56 md:w-20 lg:w-56">

            <!-- Logo -->
            <div class="mb-8 flex justify-center">
                <a href="#">
                    <img src="img/logo.png" alt="Logo ParkinTime" class="block md:hidden lg:block">
                    <img src="img/logo-tablet.png" alt="Logo Tablet" class="hidden md:block lg:hidden w-8 h-auto">
                </a>
            </div>

            <!-- Navigation -->
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="/dashboard-admin"
                            class="flex items-center text-black font-semibold hover:text-[#075e54] transition">
                            <i class="fa-solid fa-house w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/daftar-pengguna"
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition">
                            <i class="fa-solid fa-users w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Daftar Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="/data-lahan-parkir"
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition">
                            <i class="fa-solid fa-square-parking w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Data Lahan Parkir</span>
                        </a>
                    </li>
                    <li>
                        <a href="/data-kendaraan"
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition">
                            <i class="fa-solid fa-car-on w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Data Kendaraan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat-tiket-online"
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition">
                            <i class="fa-solid fa-ticket-simple w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Riwayat Tiket Online</span>
                        </a>
                    </li>
                    <li>
                        <a href="/pengaturan" class="flex items-center text-gray-700 hover:text-[#075e54] transition">
                            <i class="fa-solid fa-gear w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- Header / Navbar -->
            <header class="w-full bg-white px-6 py-4 mb-2 flex justify-between items-center">
                <!-- Hamburger (mobile only) -->
                <button @click="open = !open" class="md:hidden text-gray-800 rounded-md p-2">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <!-- Logo atau Judul -->
                <h1 class="text-md md:text-2xl lg:text-3xl font-extrabold text-black">
                    Dashboard
                </h1>

                <!-- Logout (sama di mobile & desktop) -->
                <div class="flex items-center space-x-4">
                    <button
                        class="flex items-center text-red-500 font-bold px-4 py-2 rounded-lg hover:bg-[#4e7c70] transition-colors cursor-pointer"
                        onclick="confirmLogout()">
                        <i class="text-lg md:text-2xl lg:text-3xl fa-solid fa-right-from-bracket mr-2"></i>
                        <span class="text-lg md:text-2xl lg:text-3xl">
                            Logout
                        </span>
                    </button>
                </div>
            </header>

            <div class="p-6">
                <!-- Stats Cards -->
                <section class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8 xl:gap-10 mb-8">
                    <!-- Card 1 -->
                    <div class="relative h-24 p-4 border-2 border-black border-t-2 border-l-2 border-r-4 border-b-4 rounded-sm shadow-[5px_5px_0_rgba(0,0,0,1)] 
                        transition-transform duration-300 hover:scale-105 bg-[#E2F1E7]">
                        <!-- Ellipsis icon -->
                        <i
                            class="fa-solid fa-ellipsis absolute top-2 right-2 text-[10px] md:text-xs lg:text-sm xl:text-base"></i>
                        <!-- Main icon -->
                        <i class="fa-solid fa-users absolute left-4 top-1/2 transform -translate-y-1/2 
                            text-xl md:text-2xl lg:text-3xl xl:text-4xl"></i>

                        <!-- Center content -->
                        <div class="absolute inset-0 flex flex-col justify-center items-center">
                            <h3 class="font-bold text-black text-base md:text-lg lg:text-xl xl:text-3xl">
                                {{ $jumlahPengguna }}
                            </h3>
                            <p class="text-xs md:text-sm lg:text-base xl:text-lg text-black leading-tight text-center">
                                <span class="block xl:inline">Jumlah</span>
                                <span class="block xl:inline">Pengguna</span>
                            </p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="relative h-24 p-4 border-2 border-black border-t-2 border-l-2 border-r-4 border-b-4 rounded-sm shadow-[5px_5px_0_rgba(0,0,0,1)] 
                        transition-transform duration-300 hover:scale-105 bg-[#E2F1E7]">
                        <i
                            class="fa-solid fa-ellipsis absolute top-2 right-2 text-[10px] md:text-xs lg:text-sm xl:text-base"></i>
                        <i class="fa-solid fa-map-location-dot absolute left-4 top-1/2 transform -translate-y-1/2 
                        text-xl md:text-2xl lg:text-3xl xl:text-4xl"></i>
                        <div class="absolute inset-0 flex flex-col justify-center items-center">
                            <h3 class="font-bold text-black text-base md:text-lg lg:text-xl xl:text-3xl">
                                {{ $jumlahlahan }}
                            </h3>
                            <p class="text-xs md:text-sm lg:text-base xl:text-lg text-black leading-tight text-center">
                                <span class="block xl:inline">Jumlah</span>
                                <span class="block xl:inline">Lahan Parkir</span>
                            </p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="relative h-24 p-4 border-2 border-black border-t-2 border-l-2 border-r-4 border-b-4 rounded-sm shadow-[5px_5px_0_rgba(0,0,0,1)] 
                        transition-transform duration-300 hover:scale-105 bg-[#E2F1E7]">
                        <i
                            class="fa-solid fa-ellipsis absolute top-2 right-2 text-[10px] md:text-xs lg:text-sm xl:text-base"></i>
                        <i class="fa-solid fa-car absolute left-4 top-1/2 transform -translate-y-1/2 
                            text-xl md:text-2xl lg:text-3xl xl:text-4xl">
                        </i>
                        <div class="absolute inset-0 flex flex-col justify-center items-center">
                            <h3 class="font-bold text-black text-base md:text-lg lg:text-xl xl:text-3xl">
                                {{ $jumlahkendaraan }}
                            </h3>
                            <p class="text-xs md:text-sm lg:text-base xl:text-lg text-black leading-tight text-center">
                                <span class="block xl:inline">Jumlah</span>
                                <span class="block xl:inline">Kendaraan</span>
                            </p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="relative h-24 p-4 border-2 border-black border-t-2 border-l-2 border-r-4 border-b-4 rounded-sm shadow-[5px_5px_0_rgba(0,0,0,1)] 
                        transition-transform duration-300 hover:scale-105 bg-[#E2F1E7]">
                        <i
                            class="fa-solid fa-ellipsis absolute top-2 right-2 text-[10px] md:text-xs lg:text-sm xl:text-base"></i>
                        <i class="fa-solid fa-ticket absolute left-4 top-1/2 transform -translate-y-1/2 
                            text-xl md:text-2xl lg:text-3xl xl:text-4xl"></i>
                        <div class="absolute inset-0 flex flex-col justify-center items-center">
                            <h3 class="font-bold text-black text-base md:text-lg lg:text-xl xl:text-3xl">
                                {{ $jumlahtiket }}
                            </h3>
                            <p class="text-xs md:text-sm lg:text-base xl:text-lg text-black leading-tight text-center">
                                <span class="block xl:inline">Jumlah</span>
                                <span class="block xl:inline">Tiket</span>
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Charts Section -->
                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- VIP Spot Percentage -->
                    <div class="relative bg-[#E2F1E5] border-2 border-black rounded-sm
                            p-2 sm:p-3 md:p-4 lg:p-6
                            flex flex-col lg:flex-row items-center w-full drop-shadow-[5px_5px_0_rgba(0,0,0,1)]">
                        <!-- Icon & Label -->
                        <div class="flex flex-col items-center gap-1 mb-1 lg:mb-0 lg:basis-1/3">
                            <i class="fa-solid fa-lock text-xl sm:text-2xl md:text-3xl lg:text-4xl"></i>
                            <h2
                                class="text-base sm:text-sm md:text-lg lg:text-xl xl:text-2xl font-extrabold text-black text-center">
                                Vip Spot Percentage
                            </h2>
                        </div>
                        <!-- Donut Chart -->
                        <div class="flex items-center justify-center w-full lg:basis-2/3">
                            <div class="aspect-square rounded-full p-1
                            w-3/4 sm:w-2/3 md:w-1/2 lg:w-4/5 xl:w-80">
                                <canvas id="pieChart" class="w-full h-full"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Tiket Parkir -->
                    <div x-data="{ openDropdown: false }" class="relative bg-box-statistik border-2 border-black rounded-sm
       p-4 sm:p-6 md:p-8 drop-shadow-[5px_5px_0_rgba(0,0,0,1)]
       w-full flex flex-col">

                        <!-- Icon -->
                        <i @click="openDropdown = !openDropdown"
                            class="fa-solid fa-ellipsis absolute top-2 right-2 text-xs sm:text-sm md:text-base lg:text-lg cursor-pointer"></i>

                        <!-- Dropdown Filter -->
                        <div x-show="openDropdown" @click.outside="openDropdown = false"
                            class="absolute top-8 right-2 bg-white border border-black rounded shadow-lg text-sm z-10">
                            <button class="block px-4 py-2 hover:bg-gray-200 w-full text-left">Per Month</button>
                            <button class="block px-4 py-2 hover:bg-gray-200 w-full text-left">Per Year</button>
                        </div>
                        <!-- Title -->
                        <h2
                            class="text-base sm:text-sm md:text-lg lg:text-xl xl:text-2xl font-extrabold text-black mb-4">
                            Statistik Tiket Parkir
                        </h2>
                        <!-- Bar Chart -->
                        <div class="w-full h-40 sm:h-48 md:h-56 lg:h-64">
                            <canvas id="barChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </section>

                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Jangka Waktu Parkir -->
                    <div class="relative bg-box-statistik box-border
                        border-t-2 border-l-2 border-r-4 border-b-4 border-black
                        rounded-sm p-6
                        drop-shadow-[5px_5px_0_rgba(0,0,0,1)]">
                        <i class="fa-solid fa-ellipsis w-4 h-4 absolute top-2 right-2"></i>
                        <div class="mb-4">
                            <h2
                                class="text-base sm:text-sm md:text-lg lg:text-xl xl:text-2xl font-extrabold text-black">
                                Rata-rata
                                Waktu Parkir</h2>
                        </div>
                        <canvas id="lineChart" class="w-full h-64"></canvas>
                    </div>

                    <!-- Statistik Lahan Parkir -->
                    <div x-data="{ open: false }" class="relative bg-box-statistik box-border
    border-t-2 border-l-2 border-r-4 border-b-4 border-black
    rounded-sm p-6
    drop-shadow-[5px_5px_0_rgba(0,0,0,1)]">

                        <!-- Dropdown Toggle -->
                        <button @click="open = !open" class="absolute top-2 right-2">
                            <i class="fa-solid fa-ellipsis w-4 h-4 cursor-pointer"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-2 top-8 z-10 bg-white border border-black rounded shadow p-2 text-sm">
                            <button class="block w-full text-left px-2 py-1 hover:bg-gray-100"
                                @click="open = false">Area A</button>
                            <button class="block w-full text-left px-2 py-1 hover:bg-gray-100"
                                @click="open = false">Area B</button>
                            <button class="block w-full text-left px-2 py-1 hover:bg-gray-100"
                                @click="open = false">Area C</button>
                        </div>

                        <!-- Title -->
                        <div class="mb-4">
                            <h2
                                class="text-base sm:text-sm md:text-lg lg:text-xl xl:text-2xl font-extrabold text-black">
                                Statistik Lahan Parkir
                            </h2>
                        </div>

                        <!-- Chart -->
                        <canvas id="lineChart2" class="w-full h-64"></canvas>
                    </div>

                </section>
            </div>
        </main>
    </div>
    <!-- Tombol ke Atas -->
    <a href="#" x-data="{ showButton: false }"
        x-init="window.addEventListener('scroll', () => showButton = window.scrollY > 50)" x-show="showButton"
        x-transition
        class="bg-green-700 hover:bg-green-900 text-white rounded-full shadow-lg transition flex items-center justify-center w-12 h-12 fixed right-8 bottom-8 z-50 overflow-hidden">
        <img src="img/up.png" alt="Go To Top Website" class="w-full h-full object-cover">
    </a>

    <!-- JavaScript untuk Chart.js -->
    <script>
        // Pie/Donut Chart
        const vipSpot = {{ $vipSpot }};
    const regularSpot = {{ $regularSpot }};
    const totalSpot = {{ $totalSpot }};

    const ctxPie = document.getElementById("pieChart").getContext("2d");

    new Chart(ctxPie, {
        type: "doughnut",
        data: {
            labels: [`VIP: ${vipSpot}`, `Regular: ${regularSpot}`],
            datasets: [{
                data: [vipSpot, regularSpot],
                backgroundColor: ["#FAF0B3", "#5F88FA"],
                borderWidth: 0,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: "45%",
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: "#000",
                        font: {
                            size: 14,
                        }
                    }
                },
            },
        },
        plugins: [{
            id: "centerTextPlugin",
            afterDatasetsDraw(chart) {
                const { ctx, chartArea } = chart;
                const width = chartArea.width;

                let percentFontSize, labelFontSize, valueFontSize;
                if (width >= 500) {
                    percentFontSize = 56;
                    labelFontSize = 20;
                    valueFontSize = 26;
                } else if (width >= 350) {
                    percentFontSize = 40;
                    labelFontSize = 16;
                    valueFontSize = 20;
                } else {
                    percentFontSize = 30;
                    labelFontSize = 12;
                    valueFontSize = 16;
                }

                // Hitung persentase VIP
                const vipPercentage = totalSpot > 0 ? Math.round((vipSpot / totalSpot) * 100) : 0;

                const meta = chart.getDatasetMeta(0);
                const vipArc = meta.data[0];
                const centerAngle = (vipArc.startAngle + vipArc.endAngle) / 2;
                const r = vipArc.innerRadius + 0.6 * (vipArc.outerRadius - vipArc.innerRadius);
                const vipTextX = vipArc.x + r * Math.cos(centerAngle);
                const vipTextY = vipArc.y + r * Math.sin(centerAngle);

                ctx.save();
                ctx.font = `bold ${percentFontSize}px sans-serif`;
                ctx.fillStyle = "#000";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(`${vipPercentage}%`, vipTextX, vipTextY);

                const centerX = chartArea.left + chartArea.width / 2;
                const centerY = chartArea.top + chartArea.height / 2;
                ctx.font = `bold ${labelFontSize}px sans-serif`;
                ctx.fillText("Total Spot", centerX, centerY - (valueFontSize / 2 + 4));
                ctx.font = `bold ${valueFontSize}px sans-serif`;
                ctx.fillText(`${totalSpot}`, centerX, centerY + (labelFontSize / 2 + 4));
                ctx.restore();
            }
        }],
    });


        // Bar Chart
          const ctxBar = document.getElementById("barChart").getContext("2d");
const dataBulanan = {!! json_encode(array_replace(array_fill(1, 12, 0), $jumlahTiketBulanan)) !!};

    new Chart(ctxBar, {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Tiket Parkir - {{ $tahunIni }}",
                data: Object.values(dataBulanan),
                backgroundColor: "#5F88FA",
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    grid: { drawBorder: false }
                }
            }
        }
    });

        // Line Chart (Rata-rata Jangka Waktu Parkir)
    const ctxLine = document.getElementById("lineChart").getContext("2d");

    const labels = {!! json_encode(array_keys($rataDurasiPerLahan->toArray())) !!};
    const data = {!! json_encode(array_values($rataDurasiPerLahan->toArray())) !!};

    new Chart(ctxLine, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Rata-rata Durasi Parkir (jam)",
                data: data,
                borderColor: "#5F88FA",
                backgroundColor: "rgba(7,94,84,0.2)",
                fill: true,
                tension: 0.3,
            }],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jam'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Lahan Parkir'
                    }
                }
            },
        },
    });
        // Line Chart (Statistik Lahan Parkir)
        const ctxLine2 = document.getElementById("lineChart2").getContext("2d");

    const labels2 = {!! json_encode(array_keys($spotPerLahan->toArray())) !!};
    const data2 = {!! json_encode(array_values($spotPerLahan->toArray())) !!};

    new Chart(ctxLine2, {
        type: "line",
        data: {
            labels: labels2,
            datasets: [{
                label: "Total Slot per Lahan",
                data: data2,
                borderColor: "#5F88FA",
                backgroundColor: "rgba(7,94,84,0.2)",
                fill: true,
                tension: 0.3,
            }],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Slot'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Lahan Parkir'
                    }
                }
            },
        },
    });

    </script>
    <script type="module" src="{{ asset('build/assets/app-DspuE8pW.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of your session.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#4e7c70',
                confirmButtonText: 'Yes, logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/logout';
                }
            });
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Login',
            text: '{{ session('
            success ') }}',
            confirmButtonColor: '#000',
        });

    </script>
    @endif

</body>


</html>
