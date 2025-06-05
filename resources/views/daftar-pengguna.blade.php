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
                            class="flex items-center text-gray-700 hover:text-[#075e54] transition ">
                            <i class="fa-solid fa-house w-6 text-lg text-center md:mx-auto lg:mr-3"></i>
                            <span class="inline md:hidden lg:inline-block">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/daftar-pengguna"
                            class="flex items-center text-black font-semibold hover:text-[#075e54] transition">
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
                    Daftar Pengguna
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
                <!--Isi Konten -->
                <div class="space-y-6">
                    <!-- Judul & Info Jumlah User -->
                    <div class="flex items-center justify-between w-full">
                        <!-- Sebelah Kiri: Teks All users 782 -->
                        <div class="flex-none">
                            <p class="text-xl md:text-2xl lg:text-3xl text-black">
                                All users <span class="font-semibold text-slate-400">{{ $jumlahPengguna }}</span>
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

                                <!-- Root container: pastikan punya x-data -->
                                <div x-data="{ showAddUserModal: false }" class="relative">

                                    <!-- Tombol “Add Users” -->
                                    <button @click="showAddUserModal = true"
                                        class="box-border border-t-1 border-l-1 border-r-4 border-b-4 border-black
                                        drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm p-2
                                        bg-[#00DFA2] flex items-center gap-2 text-sm text-black
                                        hover:bg-slate-600 transition-transform duration-200 hover:scale-105 cursor-pointer">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>Add Users</span>
                                    </button>

                                    <!-- Modal Overlay + Content -->
                                    <div x-show="showAddUserModal" x-cloak x-transition.opacity
                                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                                        <!-- Klik di overlay untuk tutup -->
                                        <div @click="showAddUserModal = false" class="absolute inset-0"></div>

                                        <!-- Modal Box -->
                                        <div @click.stop class="relative w-full max-w-lg bg-[#629584] p-6 rounded-sm border-2 border-black
                                            drop-shadow-[4px_4px_0_rgba(0,0,0,1)] text-white">
                                            <!-- Judul -->
                                            <h2 class="text-2xl font-extrabold text-center mb-6">
                                                Tambah Pengguna
                                            </h2>

                                            <!-- Form (dummy action) -->
                                            <form>
                                                <div class="mb-4">
                                                    <label class="block mb-1">Email</label>
                                                    <input type="email" placeholder="Enter email"
                                                        class="w-full p-3 bg-white text-black border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm focus:outline-none">
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block mb-1">Name</label>
                                                    <input type="text" placeholder="Enter name"
                                                        class="w-full p-3 bg-white text-black border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm focus:outline-none">
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block mb-1">Phone number</label>
                                                    <input type="text" placeholder="Enter phone number"
                                                        class="w-full p-3 bg-white text-black border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm focus:outline-none">
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block mb-1">Password</label>
                                                    <input type="password" placeholder="Enter password"
                                                        class="w-full p-3 bg-white text-black border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm focus:outline-none">
                                                </div>

                                                <!-- Role field styled like the others -->
                                                <div class="mb-4">
                                                    <label for="role" class="block mb-1">Role</label>
                                                    <div class="relative">
                                                        <select id="role" name="role" required
                                                            class="w-full p-3 bg-white text-black border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm appearance-none focus:outline-none">
                                                            <option>User</option>
                                                            <option>Admin</option>
                                                            <option>Super Admin</option>
                                                        </select>
                                                        <i
                                                            class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                                                    </div>
                                                </div>

                                                <!-- Buttons aligned right -->
                                                <div class="flex justify-end gap-4">
                                                    <button type="submit"
                                                        class="px-6 py-2 bg-blue-600 text-white font-semibold border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-blue-500 transition">
                                                        Save
                                                    </button>
                                                    <button type="button" @click="showAddUserModal = false"
                                                        class="px-6 py-2 bg-red-500 text-white font-semibold border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-red-700 transition">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Root container dengan Alpine state -->
                    <div x-data="{ showDeleteModal: false, showEditModal: false }" class="relative">
                        <!-- Tabel Daftar Pengguna -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-fixed border-separate border-spacing-y-4">
                                <!-- Definisi lebar kolom -->
                                <colgroup>
                                    <!-- No: cukup kecil -->
                                    <col class="w-12">
                                    <!-- Username: 30% -->
                                    <col class="w-[30%]">
                                    <!-- Access: 15% -->
                                    <col class="w-[15%]">
                                    <!-- Phone Number: 15% -->
                                    <col class="w-[15%]">
                                    <!-- Date add: 20% -->
                                    <col class="w-[20%]">
                                    <!-- Action: sisa -->
                                    <col>
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-[#ACA6A6] text-center font-semibold">No</th>
                                        <th class="px-4 py-3 text-[#ACA6A6] text-left font-semibold">Username</th>
                                        <th class="px-4 py-3 text-[#ACA6A6] text-center font-semibold">Access</th>
                                        <th class="px-4 py-3 text-[#ACA6A6] text-center font-semibold">Phone Number
                                        </th>
                                        <th class="px-4 py-3 text-[#ACA6A6] text-center font-semibold">Date add</th>
                                        <th class="px-4 py-3 text-[#ACA6A6] text-center font-semibold">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-gray-700">
                                    @foreach ($users as $index => $user)
                                    <tr class="{{ $loop->odd ? 'bg-[#629584]' : 'bg-[#E2F1E5]' }} hover:shadow-lg transition-shadow duration-200">

                                        <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3 overflow-hidden">
                                                <img src="{{ asset('storage/' . $user->photo) }}" alt="Avatar"
                                                    class="w-10 h-10 rounded-full object-cover">
                                                <div class="truncate">
                                                    <p class="text-sm font-semibold text-black truncate">
                                                        {{ $user->name }}</p>
                                                    <p class="text-xs text-black truncate">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if ($user->role === 'superadmin')
                                            <span
                                                class="inline-block whitespace-nowrap bg-white text-red-500 border border-red-500 px-3 py-1 text-xs font-semibold rounded-full">
                                                Super Admin
                                            </span>
                                            @elseif ($user->role === 'admin')
                                            <span
                                                class="inline-block whitespace-nowrap bg-white text-blue-500 border border-blue-500 px-3 py-1 text-xs font-semibold rounded-full">
                                                Admin
                                            </span>
                                            @else
                                            <span
                                                class="inline-block whitespace-nowrap bg-white text-emerald-500 border border-emerald-500 px-3 py-1 text-xs font-semibold rounded-full">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <p class="text-sm text-black">{{ $user->no_hp }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <p class="text-sm text-black">{{ $user->created_at->format('M d Y') }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-3">
                                                <div class="px-2 py-1 bg-white border border-black">
                                                    <button @click="window.location.href='/user-details'"
                                                    class="text-blue-600 hover:text-blue-800">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                </div>
                                                <div class="px-2 py-1 bg-white border border-black">
                                                    <button @click="showEditModal = true"
                                                    class="text-amber-300 hover:text-amber-800">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                </div>
                                                <div class="px-2 py-1 bg-white border border-black">
                                                    <button @click="showDeleteModal = true"
                                                    class="text-red-500 hover:text-red-800">
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


                        <!-- Modal Konfirmasi Hapus (dengan fade-down) -->
                        <div x-show="showDeleteModal" x-cloak x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-5"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-5"
                            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                            <!-- Background overlay -->
                            <div @click="showDeleteModal = false" class="absolute inset-0"></div>

                            <!-- Isi Modal -->
                            <div @click.stop class="relative bg-[#629584] rounded-sm border-2 border-black
           drop-shadow-[4px_4px_0_rgba(0,0,0,1)]
           px-6 py-4 max-w-sm w-full text-center text-white">
                                <p class="text-lg mb-6">Apakah anda yakin ingin menghapus?</p>
                                <div class="flex justify-center items-center gap-4">
                                    <button type="button" @click="showDeleteModal = false" class="px-6 py-2 bg-blue-600 text-white font-semibold
               border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
               rounded-sm hover:bg-blue-500 transition">
                                        Yes
                                    </button>
                                    <button type="button" @click="showDeleteModal = false" class="px-6 py-2 bg-red-500 text-white font-semibold
               border-2 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
               rounded-sm hover:bg-red-400 transition">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit Akun -->
                        <div x-show="showEditModal" x-cloak x-transition.opacity
                            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                            <div @click="showEditModal = false" class="absolute inset-0"></div>
                            <div @click.stop class="relative w-full max-w-lg bg-[#629584] p-6 rounded-sm border-2 border-black
                                drop-shadow-[4px_4px_0_rgba(0,0,0,1)] text-white">

                                <!-- Judul -->
                                <h2 class="text-2xl font-extrabold text-center mb-6">
                                    Edit Akun
                                </h2>

                                <!-- Form Edit (dummy action) -->
                                <form>
                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label class="block mb-1">Email</label>
                                        <input type="email"
                                            class="w-full p-3 bg-white text-black border-2 border-black rounded-sm focus:outline-none"
                                            value="matchalatte@gmail.com">
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="mb-4">
                                        <label class="block mb-1">Phone Number</label>
                                        <input type="text"
                                            class="w-full p-3 bg-white text-black border-2 border-black rounded-sm focus:outline-none"
                                            value="+62812345678">
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label class="block mb-1">Password</label>
                                        <input type="password"
                                            class="w-full p-3 bg-white text-black border-2 border-black rounded-sm focus:outline-none"
                                            placeholder="Enter new password">
                                    </div>

                                    <!-- Role -->
                                    <div class="mb-4">
                                        <label for="role-edit" class="block mb-1">Role</label>
                                        <div class="relative">
                                            <select id="role-edit"
                                                class="w-full p-3 bg-white text-black border-2 border-black rounded-sm appearance-none focus:outline-none">
                                                <option>Admin</option>
                                                <option>User</option>
                                                <option>Super Admin</option>
                                            </select>
                                            <i
                                                class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-black pointer-events-none"></i>
                                        </div>
                                    </div>

                                    <!-- Buttons aligned right -->
                                    <div class="flex justify-end gap-4">
                                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold border-2 border-black
                                        drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-blue-800 transition">
                                            Save
                                        </button>
                                        <button type="button" @click="showEditModal = false" class="px-6 py-2 bg-red-500 text-white font-semibold border-2 border-black
                                        drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-red-700 transition">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
