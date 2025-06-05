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
    <div x-data="{ open: false, showDeleteModal: false, showEditModal: false, showDetailKendaraanModal: false }"
        class="flex         min-h-screen relative">
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
                            class="flex items-center text-black font-semibold hover:text-[#075e54] transition">
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
                    Data Kendaraan
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

            <!-- Isi Konten -->
            <div class="p-6">
                <!-- Judul & Info Jumlah User -->
                <div class="flex items-center justify-between w-full">
                    <!-- Sebelah Kiri: Teks Data Kendaraan 700 -->
                    <div class="flex-none">
                        <p class="text-xl md:text-2xl lg:text-3xl text-black">
                            Data Kendaraan <span class="font-semibold text-slate-400">{{ $jumlahkendaraan }}</span>
                        </p>
                    </div>

                    <!-- Sebelah Kanan: Search Bar + Tombol Filters & Add Users -->
                    <div class="flex items-center gap-4">
                        <!-- Search Bar -->
                        <div
                            class="relative box-border border-t-1 border-l-1 border-r-4 border-b-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm">
                            <input type="text" placeholder="Search user"
                                class="w-full pl-10 pr-4 py-2 bg-[#E2F1E5] border-none focus:outline-none" />
                            <!-- Icon Search -->
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-500"></i>
                        </div>

                        <!-- Tombol Filters & Add Users -->
                        <div class="flex items-center gap-2">
                            <!-- Filter Button -->
                            <button
                                class="box-border border-t-1 border-l-1 border-r-4 border-b-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm p-2 bg-[#E2F1E7] flex  items-center gap-1 text-sm text-black hover:bg-slate-600 transition-transform duration-200 hover:scale-105 cursor-pointer">
                                <i class="fa-solid fa-filter"></i>
                                <span>Filters</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Bungkus tabel dengan Alpine scope -->
                <div x-data class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border-separate [border-spacing:0_0.5rem]">
                        <thead class="text-gray-700">
                            <tr class="text-sm">
                                <!-- Kolom No. -->
                                <th class="w-10 px-4 py-3">No.</th>
                                <th class="px-4 py-3">No. Kendaraan</th>
                                <th class="px-4 py-3">Jenis</th>
                                <th class="px-4 py-3">Merk</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody x-ref="body">
                            @foreach ($kendaraan as $index => $item)
                            <tr class="{{ $loop->even ? 'bg-[#E2F1E7]' : 'bg-[#629584]' }} border border-black">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $item->no_kendaraan }}</td>
                                <td class="px-4 py-3">{{ $item->model }}</td>
                                <td class="px-4 py-3">{{ $item->brand }}</td>
                                <td class="px-4 py-3">{{ $item->status }}</td>
                                <td class="px-4 py-3 text-center space-x-3">
                                    <div class="flex justify-center gap-3">
                                        <div class="px-2 py-1 bg-white border border-black">
                                            <button @click="showDetailKendaraanModal = true"
                                                class="text-blue-600 hover:text-blue-800 cursor-pointer">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="px-2 py-1 bg-white border border-black">
                                            <button @click="showDeleteModal = true"
                                                class="text-red-500 hover:text-red-800 cursor-pointer">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Konfirmasi Hapus (sama seperti sebelumnya) -->
            <div x-show="showDeleteModal" x-cloak x-transition.opacity
                class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                <div @click="showDeleteModal = false" class="absolute inset-0"></div>
                <div @click.stop class="relative bg-[#629584] rounded-sm border-2 border-black
                        drop-shadow-[4px_4px_0_rgba(0,0,0,1)]
                        px-6 py-4 max-w-sm w-full text-center text-white">
                    <p class="text-lg mb-6">Apakah anda yakin ingin menghapus!</p>
                    <div class="flex justify-end items-center gap-4">
                        <button type="button" @click="showDeleteModal = false" class="px-6 py-2 bg-blue-600 text-white font-semibold
                        border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                        rounded-sm hover:bg-blue-500 transition cursor-pointer">Yes</button>
                        <button type="button" @click="showDeleteModal = false" class="px-6 py-2 bg-red-500 text-white font-semibold
                        border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                        rounded-sm hover:bg-red-400 transition cursor-pointer">Cancel</button>
                    </div>
                </div>
            </div>
            <!-- Modal Detail Kendaraan Akun -->
            <div x-data="{ editing: false, newImageUrl: null }" x-show="showDetailKendaraanModal" x-cloak
                x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                <div @click="showDetailKendaraanModal = false" class="absolute inset-0"></div>

                <div @click.stop class="relative w-full max-w-lg bg-[#629584] p-6 rounded-sm border-2 border-black
                    drop-shadow-[4px_4px_0_rgba(0,0,0,1)] text-white">

                    <!-- Judul -->
                    <h2 class="text-2xl font-extrabold text-center mb-4">
                        Detail Kendaraan
                    </h2>

                    <!-- Gambar Kendaraan + tombol Ubah Gambar -->
                    <div class="text-center mb-6">
                        <!-- selalu pakai fallback ke default jika newImageUrl falsy -->
                        <img :src="newImageUrl || 'img/mobil.png'" alt="Mobil"
                            class="w-56 h-auto mx-auto rounded-sm border-2 border-black mb-2" />
                        <template x-if="editing">
                            <div>
                                <input type="file" x-ref="fileInput" class="hidden" @change="
                                    const file = $event.target.files[0];
                                    if (!file) return;
                                    const reader = new FileReader();
                                    reader.onload = e => newImageUrl = e.target.result;
                                    reader.readAsDataURL(file);
                                    ">
                                <button @click="$refs.fileInput.click()"
                                    class="px-3 py-1 text-white font-semibold border-2 border-black rounded-sm  transition cursor-pointer">
                                    Ubah
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Form -->
                    <form class="space-y-4">
                        <template x-for="(value, label) in {
                                'Email': 'matchalatte@gmail.com',
                                'No. Kendaraan': 'BP 1234 AB',
                                'Jenis': 'Mobil',
                                'Merk': 'Toyota',
                                'Status': 'Aktif'
                            }" :key="label">
                            <div>
                                <label class="block mb-1" x-text="label"></label>
                                <input :placeholder="label" :value="value" :disabled="!editing" class="w-full p-3 bg-white text-black rounded-sm border-2 border-black
                                    focus:outline-none disabled:opacity-50" />
                            </div>
                        </template>


                        <!-- Buttons aligned right -->
                        <div class="flex justify-end gap-4 mt-4">
                            <button @click.prevent="editing = !editing" type="button"
                                class="px-6 py-2 bg-[#FFCC00] text-black font-semibold border-2 border-black
                                drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-[#e6b800] transition cursor-pointer">
                                <span x-text="editing ? 'Save' : 'Edit'"></span>
                            </button>
                            <button type="button" @click="editing = false; showDetailKendaraanModal = false"
                                class="px-6 py-2 bg-red-500 text-white font-semibold border-2 border-black
                                drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-red-700 transition cursor-pointer">
                                Cancel
                            </button>

                        </div>
                    </form>
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
