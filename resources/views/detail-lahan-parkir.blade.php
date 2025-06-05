<!DOCTYPE html>
<html lang="id">

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
    <div x-data="{ open: false, showEditModal: false, showSecondModal: false, showTambahModal: false }" class ="flex min-h-screen relative">
        <!-- Overlay mobile -->
        <div x-show="open" @click="open = false" class="fixed inset-0 backdrop-blur-sm bg-white/5 z-40 md:hidden">
        </div>
        <!-- Sidebar -->
        <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
            class="fixed top-0 left-0 z-50 min-h-full bg-[#E2F1E7] p-5 transform transition-transform duration-300
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
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition">
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
                        <a href="/data-lahan-parkir" class="flex items-center text-gray-700 hover:text-[#075e54] transition">
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
                <button @click="open = !open" class="md:hidden text-gray-800 rounded-sm p-2">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <!-- Logo atau Judul -->
                <h1 class="text-md md:text-2xl lg:text-3xl font-extrabold text-black">
                    Detail Lahan Parkir
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

            <!-- Konten Utama -->
            <div class="p-6">
                <div
                    class="bg-[#629584] border-t-2 border-l-2 border-r-4 border-b-4 border-black drop-shadow-[5px_5px_0_rgba(0,0,0,1)] rounded-sm p-6 mb-8">
                    <!-- Judul lokasi -->
                    <div class="flex items-center mb-8">
                        <i class="fa-solid fa-location-dot text-red-500 text-3xl mr-3"></i>
                        <h2 class="text-3xl font-bold text-white">Grand Batam Mall</h2>
                    </div>

                    <!-- Details grid: 2 kolom per baris, semua cell full width -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Deskripsi -->
                        <div class="w-full">
                            <p class="text-lg mb-2 font-semibold text-white">Deskripsi</p>
                            <div
                                class="w-full bg-white text-black border-2 border-black
               drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm
               px-5 py-3 text-xl">
                                Jl. Teuku Umar 37B-12A
                            </div>
                        </div>

                        <!-- Biaya -->
                        <div class="w-full">
                            <p class="text-lg mb-2 font-semibold text-white">Biaya Parkir / Jam</p>
                            <div
                                class="w-full bg-white text-black border-2 border-black
               drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm
               px-5 py-3 text-xl font-bold">
                                Rp. 5.000
                            </div>
                        </div>

                        <!-- Jumlah Slot Parkir -->
                        <div class="w-full">
                            <p class="text-lg mb-2 font-semibold text-white">Jumlah Slot Parkir</p>
                            <div
                                class="w-full bg-white text-black border-2 border-black
               drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm
               px-5 py-3 text-xl font-bold">
                                150
                            </div>
                        </div>

                        <!-- Status + Edit button -->
                        <div class="w-full">
                            <p class="text-lg mb-2 font-semibold text-white">Status</p>
                            <div class="flex items-center justify-between w-full">
                                <div
                                    class="w-full bg-white text-black border-2 border-black
                 drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm
                 px-5 py-3 text-xl font-semibold">
                                    Active
                                </div>
                                <button @click="showEditModal = true"
                                    class="ml-4 w-24 h-12 bg-yellow-400 text-black font-bold
                       border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                       rounded-sm hover:bg-yellow-300 transition cursor-pointer">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slot + Floor side by side, floor langsung di samping slot -->
                    <div class="flex items-start gap-6 mb-8">
                        <!-- Layout Slot Parkir -->
                        <div
                            class="bg-white border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
             rounded-sm overflow-hidden p-4 flex-shrink-0">
                            <!-- Baris 1: Slot 1-10 -->
                            <div class="flex">
                                <!-- Slot 1-10 -->
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-bold mb-1">1</span>
                                    <div class="border-l-2 border-b-2 border-r-2 border-black w-10 h-20 bg-red-400">
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-bold mb-1">2</span>
                                    <div class="border-l-2 border-b-2 border-r-2 border-black w-10 h-20 bg-green-400">
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-bold mb-1">3</span>
                                    <div class="border-l-2 border-b-2 border-r-2 border-black w-10 h-20 bg-yellow-400">
                                    </div>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-bold mb-1">4</span>
                                    <div class="border-l-2 border-b-2 border-r-2 border-black w-10 h-20 bg-green-400">
                                    </div>
                                </div>

                            </div>

                            <!-- Jarak antar baris -->
                            <div class="h-2"></div>

                            <!-- Baris 2: Slot 11-20 -->
                            <div class="flex">
                                <!-- Slot 11-20 -->
                                <div class="flex flex-col items-center">
                                    <div class="border-l-2 border-t-2 border-r-2 border-black w-10 h-20 bg-green-400">
                                    </div>
                                    <span class="text-lg font-bold mt-1">5</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="border-l-2 border-t-2 border-r-2 border-black w-10 h-20 bg-green-400">
                                    </div>
                                    <span class="text-lg font-bold mt-1">6</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="border-l-2 border-t-2 border-r-2 border-black w-10 h-20 bg-green-400">
                                    </div>
                                    <span class="text-lg font-bold mt-1">7</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="border-l-2 border-t-2 border-r-2 border-black w-10 h-20 bg-green-400">
                                    </div>
                                    <span class="text-lg font-bold mt-1">8</span>
                                </div>
                            </div>
                        </div>

                        <!-- Floor dropdown with chevron yang hilang saat fokus -->
                        <div x-data="{ focused: false }" class="relative w-32">
                            <!-- ikon di layer atas, 0.75rem dari kiri -->
                            <i x-show="!focused"
                                class="fa-solid fa-chevron-down absolute left-3 top-1/2 -translate-y-1/2
                                     text-black pointer-events-none z-10 transition-opacity duration-200"></i>

                            <!-- select dengan padding kiri ekstra agar teks tidak nabrak ikon -->
                            <select @focus="focused = true" @blur="focused = false"
                                class="w-full p-3 bg-white text-black border-2 border-black rounded-sm
                                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] appearance-none focus:outline-none
                                     pl-10 pr-3">
                                <option>Floor 1</option>
                                <option>Floor 2</option>
                                <option>Floor 3</option>
                            </select>
                        </div>

                    </div>

                    <!-- Legend & Tombol Aksi Bawah sejajar -->
                    <div class="flex items-center justify-between">
                        <!-- Legend -->
                        <div
                            class="bg-white
                            border-t-2 border-l-2 border-r-4 border-b-4 border-black
                            drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                            rounded-sm p-4 flex items-center gap-8">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-green-400 border-2 border-black rounded-sm"></span>
                                <span class="text-lg font-semibold text-black">Available</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-red-400 border-2 border-black rounded-sm"></span>
                                <span class="text-lg font-semibold text-black">Not Available</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 bg-yellow-400 border-2 border-black rounded-sm"></span>
                                <span class="text-lg font-semibold text-black">Reserved</span>
                            </div>
                        </div>

                        <!-- Tombol Aksi Bawah -->
                        <div class="flex items-center gap-6">
                            <button @click="showSecondModal = true"
                                class="bg-yellow-400 text-black font-bold
                            border-t-2 border-l-2 border-r-4 border-b-4 border-black
                            drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                            rounded-sm px-6 py-3 hover:bg-yellow-300 transition cursor-pointer">
                                Edit
                            </button>
                            <button @click="showTambahModal = true"
                                class="bg-[#00DFA2] text-black font-bold
                            border-t-2 border-l-2 border-r-4 border-b-4 border-black
                            drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                            rounded-sm px-6 py-3 hover:bg-green-400 transition cursor-pointer">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <template x-if="showEditModal">
                <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                    <div
                        class="bg-[#629584] p-8 rounded-sm border-2 border-black
               drop-shadow-[5px_5px_0_rgba(0,0,0,1)] w-full max-w-md">
                        <h2 class="text-center font-bold text-2xl mb-6 text-white">Edit Data</h2>

                        <!-- Form: one field per row -->
                        <form>
                            <!-- Nama Lahan Parkir -->
                            <div class="mb-4">
                                <label class="block text-white mb-1">Nama Lahan Parkir</label>
                                <input type="text"
                                    class="w-full p-3 bg-white text-black rounded-sm border-2 border-black
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none"
                                    placeholder="Masukkan nama lahan" />
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="block text-white mb-1">Status</label>
                                <input type="text"
                                    class="w-full p-3 bg-white text-black rounded-sm border-2 border-black
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none"
                                    placeholder="Active / Inactive" />
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-6">
                                <label class="block text-white mb-1">Deskripsi</label>
                                <input type="text"
                                    class="w-full p-3 bg-white text-black rounded-sm border-2 border-black
                                drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none"
                                    placeholder="Masukkan deskripsi" />
                            </div>

                            <!-- Biaya Parkir per jam -->
                            <div class="mb-4">
                                <label class="block text-white mb-1">Biaya Parkir per Jam</label>
                                <select
                                    class="w-full p-3 bg-white text-black rounded-sm border-2 border-black
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none appearance-none cursor-pointer">
                                    <option value="">Pilih Biaya</option>
                                    <option>Rp 5.000</option>
                                    <option>Rp 10.000</option>
                                </select>
                            </div>

                            <!-- Buttons aligned right -->
                            <div class="flex justify-center gap-4">
                                <button type="submit" @click.prevent="showEditModal = false"
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-sm
                     border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] cursor-pointer">
                                    Save
                                </button>
                                <button type="button" @click="showEditModal = false"
                                    class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-sm
                     border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] cursor-pointer">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>


            <!-- Modal Kedua -->
            <template x-if="showSecondModal">
                <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                    <div
                        class="bg-[#629584] p-8 rounded-lg border-t-2 border-l-2 border-r-4 border-b-4 border-black drop-shadow-[5px_5px_0_rgba(0,0,0,1)] w-full max-w-md">
                        <h2 class="text-center font-bold text-white text-2xl mb-6">Edit Data</h2>
                        <form class="space-y-4">
                            <!-- Type -->
                            <div>
                                <label class="block text-white mb-1">Type</label>
                                <input type="text"
                                    class="w-full p-2 bg-white border-2 border-black rounded-sm
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none" />
                            </div>
                            <!-- Slot -->
                            <div>
                                <label class="block text-white mb-1">Slot</label>
                                <input type="text"
                                    class="w-full p-2 bg-white border-2 border-black rounded-sm
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none" />
                            </div>
                            <!-- Status -->
                            <div>
                                <label class="block text-white mb-1">Status</label>
                                <input type="text"
                                    class="w-full p-2 bg-white border-2 border-black rounded-sm
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none" />
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-center gap-4 mt-6">
                                <button @click="showSecondModal = false" type="button"
                                    class="bg-blue-600 text-white font-bold px-6 py-2
        border-t-2 border-l-2 border-r-4 border-b-4 border-black
        drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
        rounded-sm hover:bg-blue-500 transition cursor-pointer">
                                    Save
                                </button>
                                <button @click="showSecondModal = false" type="button"
                                    class="bg-red-500 text-white font-bold px-6 py-2
        border-t-2 border-l-2 border-r-4 border-b-4 border-black
        drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
        rounded-sm hover:bg-red-400 transition cursor-pointer">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>

            <!-- Modal Ketiga -->
            <template x-if="showTambahModal">
                <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                    <div
                        class="bg-[#629584] p-8 rounded-lg border-t-2 border-l-2 border-r-4 border-b-4 border-black drop-shadow-[5px_5px_0_rgba(0,0,0,1)] w-full max-w-md">
                        <h2 class="text-center font-bold text-white text-2xl mb-6">Tambah Data</h2>
                        <form class="space-y-4">
                            <!-- Type -->
                            <div>
                                <label class="block text-white mb-1">Type</label>
                                <input type="text"
                                    class="w-full p-2 bg-white border-2 border-black rounded-sm
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none" />
                            </div>
                            <!-- Slot -->
                            <div>
                                <label class="block text-white mb-1">Slot</label>
                                <input type="text"
                                    class="w-full p-2 bg-white border-2 border-black rounded-sm
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none" />
                            </div>
                            <!-- Status -->
                            <div>
                                <label class="block text-white mb-1">Status</label>
                                <input type="text"
                                    class="w-full p-2 bg-white border-2 border-black rounded-sm
                     drop-shadow-[3px_3px_0_rgba(0,0,0,1)] focus:outline-none" />
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-center gap-4 mt-6">
                                <button @click="showTambahModal = false" type="button"
                                    class="bg-blue-600 text-white font-bold px-6 py-2
        border-t-2 border-l-2 border-r-4 border-b-4 border-black
        drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
        rounded-sm hover:bg-blue-500 transition cursor-pointer">
                                    Save
                                </button>
                                <button @click="showTambahModal = false" type="button"
                                    class="bg-red-500 text-white font-bold px-6 py-2
        border-t-2 border-l-2 border-r-4 border-b-4 border-black
        drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
        rounded-sm hover:bg-red-400 transition cursor-pointer">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </main>
    </div>
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
</body>

</html>
