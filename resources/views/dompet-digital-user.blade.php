<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dompet Digital User</title>

    <link rel="stylesheet" href="{{ asset('build/assets/app-DFj-i_GL.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="flex bg-dashboard-admin">
    <!-- Sidebar -->
    <aside class="w-56 bg-dashboard-admin min-h-screen p-5">
        <div class="mb-8 flex justify-center">
            <img src="img/logo.png" alt="Logo ParkinTime">
        </div>
        <nav>
            <ul class="space-y-4">
                <li>
                    <a href="#"
                        class="flex items-center text-[#075e54] font-semibold hover:text-[#075e54] transition-colors duration-200">
                        <i class="fa-solid fa-house w-6 text-lg mr-3 text-center"></i>
                        <span class="text-start">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center text-gray-700 hover:text-[#075e54] transition-colors duration-200">
                        <i class="fa-solid fa-users w-6 text-lg mr-3 text-center"></i>
                        <span class="text-start">Daftar Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center text-gray-700 hover:text-[#075e54] transition-colors duration-200">
                        <i class="fa-solid fa-square-parking w-6 text-lg mr-3 text-center"></i>
                        <span class="text-start">Data Lahan Parkir</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center text-gray-700 hover:text-[#075e54] transition-colors duration-200">
                        <i class="fa-solid fa-car-on w-6 text-lg mr-3 text-center"></i>
                        <span class="text-start">Data Kendaraan</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center text-gray-700 hover:text-[#075e54] transition-colors duration-200">
                        <i class="fa-solid fa-ticket-simple w-6 text-lg mr-3 text-center"></i>
                        <span class="text-start">Riwayat Tiket Online</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center text-gray-700 hover:text-[#075e54] transition-colors duration-200">
                        <i class="fa-solid fa-gear w-6 text-lg mr-3 text-center"></i>
                        <span class="text-start">Pengaturan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Header / Navbar -->
        <header class="w-full bg-dashboard-admin px-6 py-4 mb-2 flex justify-between items-center">
            <!-- Logo atau Judul -->
            <h1 class="text-3xl font-bold text-black">Dompet Digital User</h1>
            <!-- Navigasi / Tombol -->
            <nav>
                <ul class="flex items-center space-x-4">
                    <li>
                        <button
                            class="flex items-center text-black px-4 py-2 rounded-lg hover:bg-slate-500 transition-colors">
                            <i class="fa-solid fa-right-from-bracket text-3xl mr-2"></i>
                            Logout
                        </button>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Isi Konten -->
        <section class="p-6 rounded-lg">
            <!-- Area Menu Atas (Filter & Tombol Tambah Dompet) -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <!-- Bagian Kiri: Search, Filter Status, & Filter Nominal -->
                    <div class="flex flex-wrap items-center gap-4">
                        <!-- Search Bar -->
                        <div>
                            <input type="text" placeholder="Search for ..."
                                class="border border-[#757575] rounded-md p-2 w-48 md:w-60 focus:outline-none focus:ring focus:border-[#4e7c70]">
                        </div>
                        <!-- Dropdown Filter Status -->
                        <div>
                            <select
                                class="border border-[#757575] rounded-md p-2 w-36 focus:outline-none focus:ring focus:border-[#4e7c70]">
                                <option value="">Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-Aktif</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <!-- Dropdown Filter Nominal -->
                        <div>
                            <select
                                class="border border-[#757575] rounded-md p-2 w-36 focus:outline-none focus:ring focus:border-[#4e7c70]">
                                <option value="">Nominal</option>
                                <option value=">10K">&gt; 10K</option>
                                <option value="+10K">+ 10K</option>
                            </select>
                        </div>
                    </div>
                    <!-- Bagian Kanan: Tombol Tambah Dompet -->
                    <div class="mt-4 md:mt-0">
                        <button
                            class="flex items-center bg-[#244BF4] text-white px-5 py-2 rounded-md hover:bg-slate-500 transition-colors">
                            <i class="fa-solid fa-plus text-base mr-2"></i>
                            <span>Tambah Dompet</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Dompet Digital -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse divide-y divide-gray-300">
                    <thead class="bg-[#ABE09F]">
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Nama User</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Saldo (Rp)</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Transaksi Terakhir</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#CEEDC7] divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2 flex items-center space-x-2">
                                <span>Matcha</span>
                            </td>
                            <td class="px-4 py-2">matchalatte@gmail.com</td>
                            <td class="px-4 py-2">25.000</td>
                            <td class="px-4 py-2">
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                            </td>
                            <td class="px-4 py-2">17 Jun 2024</td>
                            <td class="px-4 py-2">
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700 ml-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Baris tambahan -->
                    </tbody>
                </table>

            </div>
        </section>




    </main>

</body>

</html>
