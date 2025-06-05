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
    <!-- Wrapper -->
    <div x-data="{ open: false }" class="flex min-h-screen relative">
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
                            class="flex items-center text-black font-semibold hover:text-[#075e54] transition">
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
                    Riwayat Tiket Online
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

            <div x-data="{ showDeleteModal: false, showEditModal: false }">
                <!-- Isi Konten -->
                <div class="p-6">
                    <!-- Informasi Ringkas dengan separator gantung dan gap antar icon-teks -->
                    <div
                        class="flex w-full bg-[#E2F1E7] text-black rounded-sm py-3 border-2 drop-shadow-[4px_4px_0_rgba(0,0,0,1)]">
                        <div x-data="{ open: false, date: '5-10-2023' }" x-cloak
                            class="relative flex-1 flex items-center justify-center gap-6 px-3 py-2">
                            <i class="fa-solid fa-calendar-days text-cyan-300 text-2xl"></i>
                            <div class="flex flex-col items-start">
                                <span class="text-base">Date</span>
                                <span class="font-semibold" x-text="date"></span>
                            </div>
                            <i @click="open = !open" class="fa-solid fa-chevron-down text-xs cursor-pointer"></i>

                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute top-full mt-1 left-1/2 -translate-x-1/2 bg-white border shadow-md p-2 rounded-md z-10">
                                <input type="date" x-model="date"
                                    @input="
                                  let [y,m,d] = date.split('-');
                                  date = `${d}-${m}-${y}`;
                                  open = false;
                                "
                                    class="border px-2 py-1 rounded" />
                            </div>
                        </div>

                        <!-- Separator -->
                        <div class="h-14 w-[3px] bg-gray-400 rounded"></div>

                        <!-- TICKETS BOOKED -->
                        <div class="flex-1 flex items-center justify-center gap-6 px-3 py-2">
                            <i class="fa-solid fa-ticket text-blue-500 text-2xl"></i>
                            <div class="flex flex-col items-start">
                                <span class="text-base">Tickets Booked</span>
                                <span class="font-semibold">40</span>
                            </div>
                        </div>

                        <!-- Separator -->
                        <div class="h-14 w-[3px] bg-gray-400 rounded"></div>

                        <!-- TICKET PRICE -->
                        <div class="flex-1 flex items-center justify-center gap-6 px-3 py-2">
                            <i class="fa-solid fa-dollar-sign text-yellow-600 text-2xl"></i>
                            <div class="flex flex-col items-start">
                                <span class="text-base">Ticket Price</span>
                                <span class="font-semibold">5.000</span>
                            </div>
                        </div>

                        <!-- Separator -->
                        <div class="h-14 w-[3px] bg-gray-400 rounded"></div>

                        <!-- LOCATION -->
                        <div x-data="{ open: false, location: 'One Batam Mall', options: ['Grand Batam Mall', 'Megamall', 'MB2', 'Panbil'] }" x-cloak
                            class="relative flex-1 flex items-center justify-center gap-6 px-3 py-2">
                            <i class="fa-solid fa-location-dot text-red-500 text-2xl"></i>
                            <div class="flex flex-col items-start">
                                <span class="text-base">Location</span>
                                <span class="font-semibold" x-text="location"></span>
                            </div>
                            <i @click="open = !open" class="fa-solid fa-chevron-down text-xs cursor-pointer"></i>

                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute top-full mt-1 left-1/2 -translate-x-1/2 bg-white border shadow-md p-2 rounded-md z-10">
                                <template x-for="opt in options" :key="opt">
                                    <div @click="location = opt; open = false"
                                        class="px-3 py-1 cursor-pointer hover:bg-gray-100" x-text="opt"></div>
                                </template>
                            </div>
                        </div>

                    </div>

                    <!-- Tabel Riwayat Tiket -->
                    <div class="rounded-sm overflow-x-auto">
                        <table class="min-w-full text-sm text-left border-separate [border-spacing:0_0.75rem]">
                            <thead class="text-gray-700">
                                <tr class="text-sm">
                                    <th class="w-12 px-4 py-3">No.</th>
                                    <th class="px-4 py-3 flex items-center">
                                        No. Ticket <i class="fa-solid fa-sort ml-1 text-xs text-gray-500"></i>
                                    </th>
                                    <th class="px-4 py-3">ID User</th>
                                    <th class="px-4 py-3">Time</th>
                                    <th class="px-4 py-3">Lokasi</th>
                                    <th class="px-4 py-3">Spot</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody x-ref="ticketBody">
                                <!-- Data Row 1 -->
                                <tr class="bg-[#629584] rounded-sm overflow-hidden border border-black">
                                    <td class="px-4 py-3">1</td>
                                    <td class="px-4 py-3">B-123</td>
                                    <td class="px-4 py-3">Matcha.</td>
                                    <td class="px-4 py-3">05.00</td>
                                    <td class="px-4 py-3">MB2</td>
                                    <td class="px-4 py-3">16</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-3">
                                            <div @click="showEditModal = true"
                                                class="px-2 py-1 bg-white border border-black">
                                                <button class="text-blue-600 hover:text-blue-800 cursor-pointer">
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
                                <!-- Data Row 2 -->
                                <tr class="bg-[#E2F1E7] rounded-sm overflow-hidden border border-black">
                                    <td class="px-4 py-3">2</td>
                                    <td class="px-4 py-3">B-124</td>
                                    <td class="px-4 py-3">Latte.</td>
                                    <td class="px-4 py-3">06.00</td>
                                    <td class="px-4 py-3">MB3</td>
                                    <td class="px-4 py-3">17</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-3">
                                            <div class="px-2 py-1 bg-white border border-black">    
                                                <button @click="showEditModal = true"
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
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Konfirmasi Hapus (sama seperti sebelumnya) -->
                    <div x-show="showDeleteModal" x-cloak x-transition.opacity
                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                        <div @click="showDeleteModal = false" class="absolute inset-0"></div>
                        <div @click.stop
                            class="relative bg-[#629584] rounded-sm border-2 border-black
                                drop-shadow-[4px_4px_0_rgba(0,0,0,1)]
                                px-6 py-4 max-w-sm w-full text-center text-white">
                            <p class="text-lg mb-6">Apakah anda yakin ingin menghapus!</p>
                            <div class="flex justify-end items-center gap-4">
                                <button type="button" @click="showDeleteModal = false"
                                    class="px-6 py-2 bg-blue-600 text-white font-semibold
                                border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                                rounded-sm hover:bg-blue-500 transition cursor-pointer">Yes</button>
                                <button type="button" @click="showDeleteModal = false"
                                    class="px-6 py-2 bg-red-500 text-white font-semibold
                                border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                                rounded-sm hover:bg-red-400 transition cursor-pointer">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail Pembelian Tiket -->
                    <div x-data="{
                        editing: false,
                        ticket: {
                            userId: 'Matcha',
                            email: 'matchalatte@gmail.com',
                            ticketNo: 'B-123',
                            time: '05.00',
                            lokasi: 'MB2',
                            spot: '16'
                        }
                    }" x-show="showEditModal" x-cloak x-transition.opacity
                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                        <!-- backdrop -->
                        <div @click="showEditModal = false; editing = false" class="absolute inset-0"></div>

                        <!-- modal box -->
                        <div @click.stop
                            class="relative bg-[#629584] rounded-sm border-2 border-black
                        drop-shadow-[4px_4px_0_rgba(0,0,0,1)] p-6 max-w-lg w-full text-white">
                            <h2 class="text-2xl font-extrabold text-center mb-4">
                                Detail Pembelian Tiket
                            </h2>

                            <form class="space-y-4">
                                <!-- ID User -->
                                <div>
                                    <label class="block mb-1">ID User</label>
                                    <template x-if="!editing">
                                        <p class="p-3 bg-white text-black rounded-sm border-2 border-black">
                                            <span x-text="ticket.userId"></span>
                                        </p>
                                    </template>
                                    <template x-if="editing">
                                        <input type="text" x-model="ticket.userId"
                                            class="w-full p-3 bg-white text-black rounded-sm border-2 border-black focus:outline-none" />
                                    </template>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block mb-1">Email</label>
                                    <template x-if="!editing">
                                        <p class="p-3 bg-white text-black rounded-sm border-2 border-black">
                                            <span x-text="ticket.email"></span>
                                        </p>
                                    </template>
                                    <template x-if="editing">
                                        <input type="email" x-model="ticket.email"
                                            class="w-full p-3 bg-white text-black rounded-sm border-2 border-black focus:outline-none" />
                                    </template>
                                </div>

                                <!-- No. Ticket -->
                                <div>
                                    <label class="block mb-1">No. Ticket</label>
                                    <template x-if="!editing">
                                        <p class="p-3 bg-white text-black rounded-sm border-2 border-black">
                                            <span x-text="ticket.ticketNo"></span>
                                        </p>
                                    </template>
                                    <template x-if="editing">
                                        <input type="text" x-model="ticket.ticketNo"
                                            class="w-full p-3 bg-white text-black rounded-sm border-2 border-black focus:outline-none" />
                                    </template>
                                </div>

                                <!-- Waktu -->
                                <div>
                                    <label class="block mb-1">Waktu</label>
                                    <template x-if="!editing">
                                        <p class="p-3 bg-white text-black rounded-sm border-2 border-black">
                                            <span x-text="ticket.time"></span>
                                        </p>
                                    </template>
                                    <template x-if="editing">
                                        <input type="text" x-model="ticket.time"
                                            class="w-full p-3 bg-white text-black rounded-sm border-2 border-black focus:outline-none" />
                                    </template>
                                </div>

                                <!-- Lokasi -->
                                <div>
                                    <label class="block mb-1">Lokasi</label>
                                    <template x-if="!editing">
                                        <p class="p-3 bg-white text-black rounded-sm border-2 border-black">
                                            <span x-text="ticket.lokasi"></span>
                                        </p>
                                    </template>
                                    <template x-if="editing">
                                        <input type="text" x-model="ticket.lokasi"
                                            class="w-full p-3 bg-white text-black rounded-sm border-2 border-black focus:outline-none" />
                                    </template>
                                </div>

                                <!-- Spot -->
                                <div>
                                    <label class="block mb-1">Spot</label>
                                    <template x-if="!editing">
                                        <p class="p-3 bg-white text-black rounded-sm border-2 border-black">
                                            <span x-text="ticket.spot"></span>
                                        </p>
                                    </template>
                                    <template x-if="editing">
                                        <input type="text" x-model="ticket.spot"
                                            class="w-full p-3 bg-white text-black rounded-sm border-2 border-black focus:outline-none" />
                                    </template>
                                </div>

                                <!-- Tombol Edit / Save & Cancel -->
                                <div class="flex justify-end gap-4 mt-4">
                                    <!-- Toggle Edit/Save dengan dynamic class -->
                                    <button type="button" @click.prevent="editing = !editing"
                                        :class="editing
                                            ?
                                            'px-6 py-2 bg-blue-600 text-white font-semibold border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-blue-500 transition cursor-pointer' :
                                            'px-6 py-2 bg-[#FFCC00] text-black font-semibold border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-[#e6b800] transition cursor-pointer'">
                                        <span x-text="editing ? 'Save' : 'Edit'"></span>
                                    </button>

                                    <!-- Cancel -->
                                    <button type="button" @click="showEditModal = false; editing = false"
                                        class="px-6 py-2 bg-red-500 text-white font-semibold border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-red-700 transition cursor-pointer">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </main>
    </div>
    <!-- Tombol ke Atas -->
    <a href="#" x-data="{ showButton: false }" x-init="window.addEventListener('scroll', () => showButton = window.scrollY > 50)" x-show="showButton" x-transition
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
