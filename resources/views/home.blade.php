<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100 scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo-tablet.png">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DFj-i_GL.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="js/script.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>ParkinTime</title>
</head>

<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-navbar" x-data="{ isOpen: false }">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">

                    <!-- Logo kiri -->
                    <div class="flex-shrink-0">
                        <img class="w-32 lg:w-48 object-contain" src="img/logo.png" alt="Logo ParkinTime">
                    </div>

                    <!-- Menu kanan (tampil dari tablet sampai layar besar) -->
                    <div class="hidden sm:flex lg:flex items-center space-x-4">
                        <a href="#home"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">HOME</a>
                        <a href="#feature"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">FEATURES</a>
                        <a href="#how-it-works"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">HOW
                            IT WORKS?</a>
                        <a href="#benefits"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">BENEFITS</a>
                        <a href="#areas"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">AREAS</a>
                        <a href="#download-app"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">DOWNLOAD
                            APP</a>
                        <a href="#contact-us"
                            class="px-3 py-2 text-[9px] md:text-[10px] lg:text-[12px] xl:px-4 xl:py-3 xl:text-lg font-medium text-white hover:bg-gray-700 rounded-sm">CONTACT
                            US</a>
                    </div>



                    <!-- Hamburger Button (hanya di mobile: <640px) -->
                    <div class="sm:hidden flex items-center">
                        <button @click="isOpen = !isOpen" type="button"
                            class="text-gray-400 p-2 rounded-sm hover:text-white hover:bg-gray-700 focus:ring-2 focus:ring-white focus:outline-none">
                            <!-- Icon open -->
                            <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon close -->
                            <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Mobile & Tablet Menu (tampil di layar < lg) -->
            <div x-show="isOpen" class="lg:hidden px-4 pt-2 pb-3 space-y-1">
                <a href="#home" class="block px-3 py-2 rounded-sm text-base font-medium text-white bg-gray-900">HOME</a>
                <a href="#feature"
                    class="block px-3 py-2 rounded-sm text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">FEATURES</a>
                <a href="#how-it-works"
                    class="block px-3 py-2 rounded-sm text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">HOW
                    IT WORKS?</a>
                <a href="#benefits"
                    class="block px-3 py-2 rounded-sm text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">BENEFITS</a>
                <a href="#areas"
                    class="block px-3 py-2 rounded-sm text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">AREAS</a>
                <a href="#download-app"
                    class="block px-3 py-2 rounded-sm text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">DOWNLOAD
                    APP</a>
                <a href="#contact-us"
                    class="block px-3 py-2 rounded-sm text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">CONTACT
                    US</a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home"
            class="min-h-[60vh] flex flex-col justify-center relative bg-white pt-8 pb-24 overflow-visible">
            <div class="container mx-auto px-4 py-2 flex flex-col md:flex-row items-center relative">
                <!-- Kolom Kiri: Teks dan CTA -->
                <div class="md:w-1/2 w-full" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-6xl leading-tight font-bold">
                        <span class="block bg-gradient-to-r from-[#0B340B] to-[#757575] bg-clip-text text-transparent">
                            Kini Hadir, Solusi
                        </span>
                        <span class="block bg-gradient-to-r from-[#0B340B] to-[#757575] bg-clip-text text-transparent">
                            Parkir Tanpa Ribet
                        </span>
                        <span class="block bg-gradient-to-r from-[#0B340B] to-[#757575] bg-clip-text text-transparent">
                            Cari Tempat Parkir
                        </span>
                        <span class="block bg-gradient-to-r from-[#0B340B] to-[#757575] bg-clip-text text-transparent">
                            Kosong!
                        </span>
                    </h1>

                    <p class="mt-4 sm:mt-6 text-base sm:text-lg md:text-xl text-black max-w-2xl">
                        ParkinTime adalah aplikasi mobile yang dirancang untuk memungkinkan pengguna melakukan pemesanan
                        tempat parkir serta pembayaran tiket secara online.
                    </p>
                </div>

                <!-- Kolom Kanan: Gambar sejajar di tablet dan laptop biasa -->
                <div
                    class="md:w-1/2 w-full hidden md:flex justify-center md:justify-end md:pr-8 lg:hidden mt-8 md:mt-0">
                    <img src="img/hp-3d.png" alt="App Mockup" loading="lazy"
                        class="w-[240px] sm:w-[320px] md:w-[400px] drop-shadow-2xl">
                </div>
            </div>

            <!-- Gambar HP untuk Mobile (di bawah teks) -->
            <div class="md:hidden mt-8 flex justify-center">
                <img src="img/hp-3d.png" alt="App Mockup" loading="lazy" class="w-[240px] sm:w-[320px] drop-shadow-2xl">
            </div>

            <!-- Gambar HP untuk Laptop L ke atas (absolute kanan bawah) -->
            <div class="hidden lg:block absolute right-16 -bottom-16 z-30">
                <img src="img/hp-3d.png" alt="App Mockup" loading="lazy" class="w-[480px] xl:w-[640px] drop-shadow-2xl">
            </div>
        </section>

        <!-- Features Section -->
        <section id="feature"
            class="min-h-[60vh] flex flex-col justify-center relative py-16 bg-cover bg-center bg-no-repeat"
            style="background-color: #E2F1E7; background-image: url('{{ asset('img/bg.png') }}');">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl leading-tight font-bold">
                    <span class="bg-gradient-to-r from-[#2CBE2C] to-[#666666] bg-clip-text text-transparent"
                        data-aos="fade-up" data-aos-duration="1000">
                        Features
                    </span>
                </h1>

                <!-- Grid Container -->
                <div class="mt-12 flex justify-center lg:justify-between items-center flex-wrap gap-6">
                    <!-- Feature Box 1 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature1.png" alt="Real-time Monitoring" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Monitoring <br> parkir real-time</h3>
                    </div>
                    <!-- Feature Box 2 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature2.png" alt="Pemesanan Online" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Pemesanan slot <br> parkir melalui <br> aplikasi
                        </h3>
                    </div>
                    <!-- Feature Box 3 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature3.png" alt="Laporan & Analisis" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Laporan dan <br> analisis data <br> parkir</h3>
                    </div>
                    <!-- Feature Box 4 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature3.png" alt="Laporan & Analisis" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Laporan dan <br> analisis data <br> parkir</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="min-h-[60vh] flex flex-col justify-center bg-gray-50 py-16">
            <div class="container mx-auto px-4 relative">
                <h2 class="text-5xl font-bold text-left text-gray-800 mb-12 relative -top-10" data-aos="fade-right"
                    data-aos-duration="1000">
                    How It Works ?
                </h2>
                <div class="relative grid grid-cols-4 gap-8 text-center mt-4">
                    <!-- Garis horizontal -->
                    <div class="absolute left-[12.5%] w-[75%] h-1 bg-gray-800 z-0" style="top: 64px;"
                        data-aos="fade-right" data-aos-duration="500"></div>
                    <!-- Step 1 -->
                    <div class="relative z-10 flex flex-col items-center" data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/cpu.png" alt="Sistem"
                            class="h-32 object-cover rounded-full transition-transform duration-300 hover:scale-125">
                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            Sensor ultrasonik &amp;<br>CCTV mendeteksi <br> kendaraan
                        </h3>
                    </div>
                    <!-- Step 2 -->
                    <div class="relative z-10 flex flex-col items-center" data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/data.png" alt="Database"
                            class="h-32 object-cover rounded-full transition-transform duration-300 hover:scale-125">
                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            Data dikirim ke <br> sistem
                        </h3>
                    </div>
                    <!-- Step 3 -->
                    <div class="relative z-10 flex flex-col items-center" data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/mobile.png" alt="Handphone"
                            class="h-32 object-cover rounded-full transition-transform duration-300 hover:scale-125">
                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            Status parkir <br> diperbarui di monitor <br> &amp; aplikasi
                        </h3>
                    </div>
                    <!-- Step 4 -->
                    <div class="relative z-10 flex flex-col items-center" data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/location.png" alt="Location"
                            class="h-32 object-cover rounded-full transition-transform duration-300 hover:scale-125">
                        <h3 class="mt-4 text-lg font-bold text-gray-800">
                            Pengguna dapat <br> melihat dan memesan <br> slot parkir
                        </h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section id="benefits"
            class="min-h-[60vh] flex flex-col justify-center py-16 relative bg-cover bg-center bg-no-repeat"
            style="background-color: #E2F1E7; background-image: url('{{ asset('img/bg.png') }}');">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl leading-tight font-bold">
                    <span data-aos="fade-in" data-aos-duration="1000"
                        class="bg-gradient-to-r from-[#2CBE2C] to-[#666666] bg-clip-text text-transparent">
                        Benefits
                    </span>
                </h1>
                <!-- Grid Container -->
                <div class="mt-12 flex justify-center lg:justify-between items-center flex-wrap gap-6">
                    <!-- Feature Box 1 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature1.png" alt="Real-time Monitoring" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Monitoring <br> parkir real-time</h3>
                    </div>
                    <!-- Feature Box 2 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature2.png" alt="Pemesanan Online" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Pemesanan slot <br> parkir melalui <br> aplikasi
                        </h3>
                    </div>
                    <!-- Feature Box 3 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature3.png" alt="Laporan & Analisis" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Laporan dan <br> analisis data <br> parkir</h3>
                    </div>
                    <!-- Feature Box 4 -->
                    <div class="w-72 h-80 flex flex-col items-center justify-center rounded-sm shadow-xl bg-white p-6"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <img src="img/feature3.png" alt="Laporan & Analisis" loading="lazy" class="h-16 w-auto mb-4">
                        <h3 class="text-xl font-semibold text-center">Laporan dan <br> analisis data <br> parkir</h3>
                    </div>
                </div>

            </div>
        </section>

        <!-- Areas Section -->
        <section id="areas" class="min-h-[60vh] flex flex-col justify-center py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-5xl font-bold text-left text-gray-800" data-aos="fade-right" data-aos-duration="1000">
                    Areas</h2>
                <!-- Grid Layout -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Batam -->
                    <div class="p-4 border rounded-sm hover:shadow-lg transition bg-white" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4743.819249570217!2d104.0464411747848!3d1.1166625873900813!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sen!2sus!4v1742459900885!5m2!1sen!2sus"
                            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                        <h3 class="text-lg font-bold mt-4 text-gray-800">Batam, Indonesia</h3>
                        <p class="text-gray-600 text-sm">Kami berada di GRANDMALL di Batam!
                        </p>
                    </div>
                    <!-- Osaka -->
                    <div class="p-4 border rounded-sm hover:shadow-lg transition bg-white" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3288.334323456123!2d135.501393!3d34.693738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e64e5a9f1c3f%3A0x4037f7db6e79b60!2sOsaka!5e0!3m2!1sen!2sjp!4v1710892800000"
                            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                        <h3 class="text-lg font-bold mt-4 text-gray-800">Osaka, Japan</h3>
                        <p class="text-gray-600 text-sm">Hello Osaka! Kami selalu siap mengantar makanan terbaik untuk
                            Anda.</p>
                    </div>
                    <!-- Kyoto -->
                    <div class="p-4 border rounded-sm hover:shadow-lg transition bg-white" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3269.8569764489536!2d135.768149!3d35.011564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60010893ff7939c5%3A0x469b9e3c83eb8a0!2sKyoto!5e0!3m2!1sen!2sjp!4v1710892800000"
                            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                        <h3 class="text-lg font-bold mt-4 text-gray-800">Kyoto, Japan</h3>
                        <p class="text-gray-600 text-sm">Kami selalu siap mengantarkan makanan lezat untuk Anda di
                            Kyoto!</p>
                    </div>
                    <!-- Tokyo -->
                    <div class="p-4 border rounded-sm hover:shadow-lg transition bg-white" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3254.451537490222!2d139.691706!3d35.689487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188c2b6eccc68b%3A0xb3a17b56e0000000!2sTokyo!5e0!3m2!1sen!2sjp!4v1710892800000"
                            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                        <h3 class="text-lg font-bold mt-4 text-gray-800">Tokyo, Japan</h3>
                        <p class="text-gray-600 text-sm">Relax, kami masih bisa mengantarkan dalam radius 5-10 km di
                            Tokyo!</p>
                    </div>
                </div>
                <!-- See All Locations Button -->
                <div class="mt-8 text-center" data-aos="fade-right" data-aos-duration="1000">
                    <a href="/all-locations"
                        class="hover:bg-yellow-600 text-black font-semibold py-3 px-6 rounded-sm transition inline-flex items-center">
                        See All Locations <span class="ml-2">→</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Download App Section -->
        <section id="download-app"
            class="min-h-[60vh] flex flex-col justify-center py-16 relative bg-cover bg-center bg-no-repeat"
            style="background-color: #E2F1E7; background-image: url('img/bg.png');">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Kolom Kiri: Teks + Icon + Tombol -->
                    <div class="md:w-1/2 flex flex-col items-center md:items-start">
                        <!-- Judul Utama -->
                        <h1 data-aos="fade-right" data-aos-duration="1000"
                            class="text-4xl md:text-5xl font-bold leading-tight text-center md:text-left bg-gradient-to-r from-[#2CBE2C] to-[#666666] bg-clip-text text-transparent">
                            <span class="block md:hidden">
                                Kesel parkiran selalu penuh?<br />ParkinTime solusinya!
                            </span>
                            <span class="hidden md:block">
                                Kesel parkiran selalu penuh?
                                <br />
                                ParkinTime solusinya!
                            </span>
                        </h1>


                        <!-- Bagian Download -->
                        <div class="mt-28 flex flex-col items-center space-y-4" data-aos="zoom-in"
                            data-aos-duration="1000">
                            <a href="#">
                                <img src="img/download-app-play.png" alt="App & Playstore" class="h-20 w-auto">
                            </a>
                            <a href="https://polibatam.id/MVP-ParkInTime"
                                class="bg-download-container hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-sm transition inline-flex items-center">
                                DOWNLOAD NOW
                                <i class="fa-solid fa-download ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Gambar sejajar di tablet dan laptop biasa -->
                    <div
                        class="md:w-1/2 w-full hidden md:flex justify-center md:justify-end md:pr-8 lg:hidden mt-8 md:mt-0">
                        <img src="img/hp-3d.png" alt="App Mockup" loading="lazy"
                            class="w-[240px] sm:w-[320px] md:w-[400px] drop-shadow-2xl">
                    </div>
                </div>
                <!-- Gambar HP untuk Mobile (di bawah teks) -->
                <div class="md:hidden mt-8 flex justify-center">
                    <img src="img/hp-3d.png" alt="App Mockup" loading="lazy"
                        class="w-[240px] sm:w-[320px] drop-shadow-2xl">
                </div>

                <!-- Gambar HP untuk Laptop L ke atas (absolute kanan bawah) -->
                <div class="hidden lg:block absolute right-16 -bottom-16 z-30">
                    <img src="img/hp-3d.png" alt="App Mockup" loading="lazy"
                        class="w-[480px] xl:w-[640px] drop-shadow-2xl">
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="contact-us" class="min-h-[60vh] flex flex-col justify-center bg-footer relative pt-12 pb-12">
            <div class="container mx-auto px-4">
                <!-- Bagian Atas Footer: Logo & Contact -->
                <div
                    class="flex flex-col md:flex-row justify-center md:items-center space-y-10 md:space-y-0 md:space-x-20">
                    <!-- Kiri: Logo -->
                    <div class="flex items-center justify-center">
                        <img src="img/logo-tablet.png" alt="ParkinTime Logo" class="h-36 w-auto md:h-60" />
                    </div>

                    <!-- Kanan: Contact Us -->
                    <div>
                        <h3 class="text-4xl font-semibold text-black mb-3">Contact us</h3>
                        <!-- Baris alamat -->
                        <div class="flex items-start mb-3">
                            <i class="fa-solid fa-location-dot text-xl mt-1 mr-3"></i>
                            <p class="text-black text-lg leading-tight">
                                Kepulauan Riau, Batam, Kota Batam, Indonesia
                            </p>
                        </div>
                        <!-- Baris email -->
                        <div class="flex items-start">
                            <i class="fa-solid fa-envelope text-xl mt-1 mr-3"></i>
                            <p class="text-black text-lg leading-tight">
                                Email : parkintimeid@gmail.com
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Baris Ikon Media Sosial -->
                <div class="flex justify-center mt-10 space-x-8">
                    <a href="#" class="inline-block hover:opacity-80">
                        <i class="fa-brands fa-linkedin-in text-3xl"></i>
                    </a>
                    <a href="#" class="inline-block hover:opacity-80">
                        <i class="fa-brands fa-instagram text-3xl"></i>
                    </a>
                    <a href="#" class="inline-block hover:opacity-80">
                        <i class="fa-brands fa-facebook-f text-3xl"></i>
                    </a>
                    <a href="#" class="inline-block hover:opacity-80">
                        <i class="fa-brands fa-youtube text-3xl"></i>
                    </a>
                </div>

                <!-- Baris Copyright -->
                <div class="flex justify-center mt-10">
                    <div class="w-4/5 bg-copyright px-10 py-5 rounded-sm shadow-md flex items-center justify-between">
                        <!-- Lingkaran C -->
                        <div class="relative w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center">
                            <div
                                class="absolute w-6 h-6 bg-white rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            </div>
                            <span class="relative z-10 text-base font-bold text-black">C</span>
                        </div>

                        <!-- Teks Tengah -->
                        <div class="leading-tight text-center">
                            <p class="text-base font-semibold text-black">
                                Copyright © 2025 - All Rights Reserved
                            </p>
                            <p class="text-base font-semibold text-black">
                                Designed by ParkinTime
                            </p>
                        </div>

                        <!-- Ikon Login -->
                        <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center">
                            <a href="login">
                                <img src="img/login-admin.png" alt="Login" class="h-6 w-6" />
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tombol ke Atas -->
                <a href="#" x-data="{ showButton: false }"
                    x-init="window.addEventListener('scroll', () => showButton = window.scrollY > 50)"
                    x-show="showButton" x-transition
                    class="bg-green-700 hover:bg-green-900 text-white rounded-full shadow-lg transition flex items-center justify-center w-12 h-12 fixed right-8 bottom-8 z-50 overflow-hidden">
                    <img src="img/up.png" alt="Go To Top Website" class="w-full h-full object-cover">
                </a>
            </div>
        </footer>

    </div>
    <script type="module" src="{{ asset('build/assets/app-DspuE8pW.js') }}"></script>
    <!-- Tambahkan sebelum </body> -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

    </script>
</body>

</html>
