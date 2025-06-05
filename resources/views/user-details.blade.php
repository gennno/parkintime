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
                    User Details
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
                <!-- Section User Details Cards -->
                <div x-data="{
                    isEditing: false,
                    showPreview: false,
                    photoUrl: 'img/matcha.png',
                    previewSrc: '',
                    form: {
                        email: 'matchalatte@gmail.com',
                        name: 'Matcha',
                        phone: '081212341234',
                        address: 'Batu Ampar',
                        role: 'User'
                    },
                    original: {},
                    fields: [
                        { name: 'email', label: 'Email', type: 'email' },
                        { name: 'name', label: 'Name', type: 'text' },
                        { name: 'phone', label: 'Phone Number', type: 'text' },
                        { name: 'address', label: 'Address', type: 'text' }
                    ],
                    showBalance: true,
                    startEdit() {
                        this.isEditing = true;
                        this.original = { ...this.form, photoUrl: this.photoUrl };
                    },
                    saveChanges() {
                        if (this.previewSrc) {
                            this.photoUrl = this.previewSrc;
                            this.previewSrc = '';
                        }
                        // kirim perubahan ke server di sini…
                        this.isEditing = false;
                    },
                    cancelEdit() {
                        this.form = { ...this.original };
                        this.photoUrl = this.original.photoUrl;
                        this.previewSrc = '';
                        this.isEditing = false;
                    },
                    onFileChange(e) {
                        const file = e.target.files[0];
                        if (!file) return;
                        const reader = new FileReader();
                        reader.onload = ev => this.previewSrc = ev.target.result;
                        reader.readAsDataURL(file);
                    }
                }" class="flex flex-col lg:flex-row gap-6 mb-8 items-stretch">
                    <!-- Card 1: Profile & Edit Form -->
                    <div
                        class="flex-1 h-full bg-[#629584] border-t-2 border-l-2 border-r-4 border-b-4 border-black rounded-sm drop-shadow-[4px_4px_0_rgba(0,0,0,1)] p-6 text-white flex flex-col">
                        <!-- Avatar -->
                        <div class="relative mx-auto mb-6">
                            <template x-if="isEditing">
                                <label for="photo-upload" class="cursor-pointer">
                                    <img :src="previewSrc || photoUrl" alt="Profile"
                                        class="w-32 h-32 rounded-full border-4 border-black drop-shadow-[4px_4px_0_rgba(0,0,0,1)]" />
                                    <input id="photo-upload" type="file" accept="image/*" @change="onFileChange"
                                        class="absolute inset-0 w-full h-full opacity-0" />
                                </label>
                            </template>
                            <template x-if="!isEditing">
                                <img @click="showPreview = true" :src="photoUrl" alt="Profile"
                                    class="w-32 h-32 rounded-full cursor-pointer border-4 border-black drop-shadow-[4px_4px_0_rgba(0,0,0,1)]" />
                            </template>
                        </div>

                        <!-- Form Fields -->
                        <form class="space-y-4 flex-1">
                            <template x-for="field in fields" :key="field.name">
                                <div>
                                    <label class="block mb-1" x-text="field.label"></label>
                                    <input :type="field.type" :readonly="!isEditing" x-model="form[field.name]"
                                        class="w-full p-3 bg-white text-black border-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm focus:outline-none" />
                                </div>
                            </template>
                            <div>
                                <label class="block mb-1">Role</label>
                                <div class="relative">
                                    <select :disabled="!isEditing" x-model="form.role"
                                        class="w-full p-3 bg-white text-black border-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm appearance-none focus:outline-none">
                                        <option>User</option>
                                        <option>Admin</option>
                                        <option>Super Admin</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2"></i>
                                </div>
                            </div>
                        </form>

                        <!-- Action Buttons -->
                        <div class="flex justify-center mt-4 space-x-4">
                            <button x-show="!isEditing" @click="startEdit"
                                class="bg-[#FFCC00] text-black font-bold px-6 py-2 border-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-[#e6b800] transition cursor-pointer">Edit</button>
                            <button x-show="isEditing" @click="saveChanges"
                                class="bg-blue-600 text-white font-bold px-6 py-2 border-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-blue-800 transition cursor-pointer">Save</button>
                            <button x-show="isEditing" @click="cancelEdit"
                                class="bg-red-500 text-white font-bold px-6 py-2 border-4 border-black drop-shadow-[3px_3px_0_rgba(0,0,0,1)] rounded-sm hover:bg-red-600 transition cursor-pointer">Cancel</button>
                        </div>
                    </div>

                    <!-- Right Column: Card 2 & 3 -->
                    <div class="flex flex-col gap-6 lg:w-1/3 flex-1">
                        <!-- Card 2: Dompet Pengguna -->
                        <div
                            class="flex-1 bg-[#629584]
                            border-t-2 border-l-2 border-r-4 border-b-4 border-black
                            rounded-sm drop-shadow-[4px_4px_0_rgba(0,0,0,1)]
                            p-4 flex flex-col justify-between">
                            <h3 class="text-2xl text-black font-bold mb-2">
                                Dompet Pengguna
                            </h3>

                            <div
                                class="bg-[#E2F1E5] text-black border border-[#ACA6A6] rounded-sm px-6 py-3 flex flex-col gap-4">
                                <span class="text-xl font-semibold">Active</span>
                                <div class="flex items-center justify-between">
                                    <span x-text="showBalance ? 'IDR 50.000,00' : 'IDR ******'"
                                        class="text-2xl font-extrabold"></span>
                                    <button @click="showBalance = !showBalance" class="text-2xl">
                                        <i class="fa-solid fa-eye-slash text-blue-600 cursor-pointer"
                                            x-show="showBalance" x-cloak></i>
                                        <i class="fa-solid fa-eye text-blue-600 cursor-pointer" x-show="!showBalance"
                                            x-cloak></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Data Kendaraan -->
                        <div x-data="{ carImages: ['img/mobil.png', 'img/mobil2.png', 'img/mobil3.png'], currentIndex: 0 }"
                            class="flex-1 bg-[#629584]
                            border-t-2 border-l-2 border-r-4 border-b-4 border-black
                            rounded-sm drop-shadow-[4px_4px_0_rgba(0,0,0,1)]
                            p-4 text-black flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-bold mb-4">
                                    Data Kendaraan
                                </h3>

                                <!-- Carousel -->
                                <div class="flex items-center justify-center mb-4 space-x-2">
                                    <button @click="currentIndex=(currentIndex-1+carImages.length)%carImages.length"
                                        class="p-2">
                                        <i
                                            class="fa-solid fa-arrow-left text-2xl text-white drop-shadow-[3px_3px_0_rgba(0,0,0,1)] cursor-pointer"></i>
                                    </button>
                                    <div class="w-full max-w-sm h-48 overflow-hidden rounded-sm border-4 border-black">
                                        <template x-for="(img,i) in carImages" :key="i">
                                            <img x-show="currentIndex===i" :src="img"
                                                class="w-full h-full object-cover" alt="Kendaraan" />
                                        </template>
                                    </div>
                                    <button @click="currentIndex=(currentIndex+1)%carImages.length" class="p-2">
                                        <i
                                            class="fa-solid fa-arrow-right text-2xl text-white drop-shadow-[3px_3px_0_rgba(0,0,0,1)] cursor-pointer"></i>
                                    </button>
                                </div>

                                <!-- Vehicle Details -->
                                <div class="space-y-2 mb-2">
                                    <div
                                        class="bg-[#E2F1E7] text-black font-bold border border-black rounded-sm drop-shadow-[3px_3px_0_rgba(0,0,0,1)] p-2">
                                        <p><span>No. Kendaraan:</span> AB 123 CD</p>
                                    </div>
                                    <div
                                        class="bg-[#E2F1E7] text-black font-bold border border-black rounded-sm drop-shadow-[3px_3px_0_rgba(0,0,0,1)] p-2">
                                        <p><span>Brand:</span> Toyota</p>
                                    </div>
                                    <div
                                        class="bg-[#E2F1E7] text-black font-bold border border-black rounded-sm drop-shadow-[3px_3px_0_rgba(0,0,0,1)] p-2">
                                        <p><span>Model:</span> Avanza</p>
                                    </div>
                                    <!-- Tahun & Warna sejajar -->
                                    <div class="flex gap-4">
                                        <div
                                            class="bg-[#E2F1E7] text-black font-bold border border-black rounded-sm drop-shadow-[3px_3px_0_rgba(0,0,0,1)] p-2 flex-1">
                                            <p><span>Tahun:</span> 2020</p>
                                        </div>
                                        <div
                                            class="bg-[#E2F1E7] text-black font-bold border border-black rounded-sm drop-shadow-[3px_3px_0_rgba(0,0,0,1)] p-2 flex-1">
                                            <p><span>Warna:</span> Hitam</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit & Delete Buttons -->
                            <div class="flex justify-end gap-4">
                                <button
                                    class="px-4 py-2 bg-[#FFCC00] text-black font-bold
                                    border-t-2 border-l-2 border-r-4 border-b-4 border-black
                                    drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                                    rounded-sm hover:bg-[#e6b800] transition cursor-pointer">Edit</button>
                                <button
                                    class="px-4 py-2 bg-red-500 text-white font-bold
                                border-t-2 border-l-2 border-r-4 border-b-4 border-black
                                drop-shadow-[3px_3px_0_rgba(0,0,0,1)]
                                rounded-sm hover:bg-red-400 transition cursor-pointer">Delete</button>
                            </div>
                        </div>
                    </div>
                    <!-- Image Preview Modal (ukurannya dikurangi jadi 80% viewport) -->
                    <div x-show="showPreview" x-cloak x-transition.opacity
                        class="fixed inset-0 bg-black/75 flex items-center justify-center z-50 p-4">
                        <!-- backdrop klik tutup -->
                        <div @click="showPreview = false" class="absolute inset-0"></div>

                        <!-- gambar preview -->
                        <div class="relative z-10">
                            <img :src="previewSrc" alt="Preview"
                                class="rounded-sm border-4 border-white shadow-xl
                                w-[80vw] 
                                h-auto
                                max-h-[80vh]" />
                        </div>
                    </div>
                </div>
            </div>
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
