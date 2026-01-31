<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Siperpus - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi ini bisa dipanggil kapan saja dari tombol hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin mau dihapus?',
                text: "Data anggota ini akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-xl',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Gunakan window.onload agar script pengecekan session/error jalan otomatis setelah page load
        window.onload = function() {
            // 1. Tampilkan Pop-up Berhasil
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            // 2. Tampilkan Pop-up Error Validasi
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `
                <ul style="text-align: left; list-style-type: disc; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                `,
                    confirmButtonColor: '#3085d6',
                });
            @endif
        };
    </script>


    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00426D',
                        accent1: '#F15C67',
                        accent2: '#00AEB6',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 font-sans">

    <aside class="w-64 min-h-screen bg-primary text-white fixed left-0 top-0 flex flex-col z-50">
        <div class="px-6 py-5 border-b border-white/20">
            <h1 class="text-lg font-bold tracking-wide">Perpustakaan LP3I</h1>
        </div>

        <div class="px-6 py-4 border-b border-white/10">
            <p class="text-sm font-semibold text-white">Admin Perpustakaan</p>
            <p class="text-xs text-white/70">admin@lp3i.com</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">
                <span class="w-2 h-2 rounded-full bg-accent2"></span> Dashboard
            </a>

            <div x-data="{ open: {{ request()->is('kategori*') || request()->is('buku*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/10 transition">
                    <div class="flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-accent1"></span> Data Master
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition class="mt-2 ml-6 space-y-1">
                    <a href="{{ route('anggota.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-white/10">Anggota</a>
                    <a href="{{ route('buku.index') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10">Buku</a>
                    <a href="{{ route('kategori.index') }}"
                        class="block px-4 py-2 rounded-lg hover:bg-white/10 {{ request()->is('kategori*') ? 'text-accent2 font-bold' : '' }}">
                        Kategori Buku
                    </a>
                </div>
            </div>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
                <span class="w-2 h-2 rounded-full bg-accent2"></span> Peminjaman
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 transition">
                <span class="w-2 h-2 rounded-full bg-accent2"></span> Log Activity
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <a href="{{ url('/') }}"
                class="flex items-center justify-center gap-2 w-full py-2 bg-accent1 hover:bg-red-600 rounded-xl transition text-xs font-bold text-white">
                Logout
            </a>
        </div>
    </aside>

    <div class="ml-64 flex flex-col min-h-screen">
        <header
            class="bg-white/80 backdrop-blur-md sticky top-0 border-b border-slate-200 px-8 py-4 flex justify-between items-center z-40">
            <div>
                <h2 class="text-xl font-bold text-primary">@yield('title')</h2>
                <p class="text-xs text-slate-500">Sistem Informasi Perpustakaan</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-slate-600">Halo, esapermana! 👋</span>
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin mau dihapus?',
                text: "Data kategori ini akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Warna biru Tailwind
                cancelButtonColor: '#d33', // Warna merah Tailwind
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-xl', // Supaya serasi dengan Tailwind rounded
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Panggil form hapus kamu di sini
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    </script>
</body>

</html>
