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
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition">
                            <i class="fa-solid fa-house w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/daftar-pengguna"
                            class="flex items-center text-gray-700  hover:text-[#075e54] transition">
                            <i class="fa-solid fa-users w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Daftar Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="/data-lahan-parkir"
                            class="flex items-center text-black font-semibold hover:text-[#075e54] transition">
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
                    Data Lahan Parkir
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

            <!-- Konten Utama wrapper -->
            <div x-data="{ open: false, showAddModal: false }" class="p-6 flex-1 overflow-auto w-full">
                <!-- Judul & Controls -->
                <div class="flex items-center justify-between w-full mb-6">
                    <p class="text-3xl text-black">All Lahan <span class="font-semibold text-slate-400">{{ $jumlahlahan }}</span></p>
                    <div class="flex items-center gap-4">
                        <!-- Search Bar -->
                        <div
                            class="relative box-border border-t-2 border-l-2 border-r-4 border-b-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm">
                            <input type="text" placeholder="Search for..."
                                class="w-full pl-10 pr-4 py-2 bg-[#E2F1E5] border-none focus:outline-none" />
                            <!-- Icon Search -->
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-black"></i>
                        </div>
                        <button @click="showAddModal = true"
                            class="box-border border-t-2 border-l-2 border-r-4 border-b-4 border-black                               drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm p-2                               bg-[#00DFA2] flex items-center gap-2 text-sm text-black                               hover:bg-slate-600 transition-transform duration-200 hover:scale-105 cursor-pointer">
                            <i class="fa-solid fa-plus text-base"></i>
                            <span>Tambah Lahan</span>
                        </button>
                    </div>
                    <!-- Modal Tambah Lahan -->
                    <div x-show="showAddModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                        <div @click.outside="showAddModal = false" class="bg-[#629584] rounded-sm p-6 w-full max-w-3xl
         border-2 border-black drop-shadow-[5px_5px_0_rgba(0,0,0,1)] text-white">

                            <!-- Header -->
                            <h2 class="text-3xl font-extrabold text-center mb-6">
                                Tambah Lahan
                            </h2>

                            <!-- Form: single‐column -->
                            <form>
                                <div class="mb-4">
                                    <label class="block mb-1 font-semibold">Nama Lokasi Lahan</label>
                                    <input type="text" placeholder="Masukkan lokasi" class="w-full p-3 bg-white text-black rounded-sm
                 border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                 focus:outline-none" />
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-1 font-semibold">Nama Lahan Parkir</label>
                                    <input type="text" placeholder="Masukkan nama lahan" class="w-full p-3 bg-white text-black rounded-sm
                 border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                 focus:outline-none" />
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-1 font-semibold">Biaya Parkir per Jam</label>
                                    <input type="number" placeholder="Rp …" class="w-full p-3 bg-white text-black rounded-sm
                 border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                 focus:outline-none" />
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-1 font-semibold">Deskripsi</label>
                                    <input type="text" placeholder="Masukkan deskripsi" class="w-full p-3 bg-white text-black rounded-sm
                 border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                 focus:outline-none" />
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="block mb-1 font-semibold">Status</label>
                                    <div class="relative">
                                        <select id="status" name="status" required class="w-full p-3 bg-white text-black rounded-sm
                    border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                    appearance-none focus:outline-none">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                        <i
                                            class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                                    </div>
                                </div>
                            </form>

                            <!-- Tombol Save / Cancel -->
                            <div class="mt-6 flex justify-end gap-4">
                                <button @click.prevent="showAddModal = false" class="px-6 py-2 bg-[#0079FF] text-white font-semibold
                border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                rounded-sm hover:bg-blue-600 transition">
                                    Save
                                </button>
                                <button @click.prevent="showAddModal = false" class="px-6 py-2 bg-red-500 text-white font-semibold
                border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                rounded-sm hover:bg-red-600 transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Wrapper grid dengan padding kiri/kanan agar sejajar judul -->
                <div class="w-full px-2">

                    <!-- Grid dua kolom di md ke atas, gap sama 2rem -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach ($lahanParkir as $lahan)
        <div class="w-full
             bg-[#E2F1E5] border-t-2 border-l-2 border-r-4 border-b-4 border-black
             rounded-sm drop-shadow-[4px_4px_0_rgba(0,0,0,1)] overflow-hidden">
            <div class="relative w-full h-60">
                @if($lahan->foto)
                    <img src="{{ asset('storage/' . $lahan->foto) }}" class="w-full h-full object-cover" alt="Foto Lahan">
                @else
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode($lahan->nama_lokasi) }}&output=embed"
                        class="w-full h-full"
                        style="border:0;" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                @endif
            </div>
            <div class="p-4 flex border-t-2 border-black items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-red-500"></i>
                    <span class="font-semibold text-gray-800">{{ $lahan->nama_lokasi }}</span>
                </div>
                <a href="{{ route('detail.lahan', $lahan->id) }}">
                    <button class="px-4 py-2 bg-[#0079FF] text-white text-sm rounded-sm
                         border-t-2 border-l-2 border-r-4 border-b-4 border-black
                         drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                         hover:bg-slate-500 transition-colors cursor-pointer">
                        Cek Detail
                    </button>
                </a>
            </div>
        </div>
    @endforeach
</div>
                </div>
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
