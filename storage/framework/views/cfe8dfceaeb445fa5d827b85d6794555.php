<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Samudra Ina Pertiwi - Rekrutmen & Penempatan ABK</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo.png')); ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased scroll-smooth">

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 bg-slate-900/95 backdrop-blur border-b border-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-28">
                <div class="flex items-center">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo SIP" class="h-24 w-auto mr-4">
                    <div>
                        <span class="block font-bold text-xl tracking-wider">PT. SAMUDRA INA PERTIWI</span>
                        <span class="block text-[10px] text-slate-400 uppercase tracking-widest font-semibold">SIUKAK 134.19-R TAHUN 2025</span>
                    </div>
                </div>
                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="#profil" class="text-slate-300 hover:text-white transition">Tentang Kami</a>
                    <a href="#alur" class="text-slate-300 hover:text-white transition">Alur Rekrutmen</a>
                    <a href="#persyaratan" class="text-slate-300 hover:text-white transition">Persyaratan</a>
                    <a href="#faq" class="text-slate-300 hover:text-white transition">FAQ</a>
                    <a href="#kontak" class="text-slate-300 hover:text-white transition">Kontak</a>
                </nav>
                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-lg shadow-blue-600/35 transition">Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-slate-300 hover:text-white text-sm font-semibold transition">Masuk</a>
                        <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-lg shadow-blue-600/35 transition">Daftar Akun</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white py-24 sm:py-32 overflow-hidden">
        <!-- Abstract Ocean Wave Background -->
        <div class="absolute inset-0 opacity-15 mix-blend-overlay">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Ocean">
        </div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-120 h-120 bg-emerald-500/5 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-500/10 border border-blue-400/20 text-blue-400 text-xs font-semibold uppercase tracking-wider">
                        <i class="fa-solid fa-ship"></i> Peluang Karir Internasional Pelaut
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Wujudkan Karir Gemilang Sebagai <span class="text-blue-500">Anak Buah Kapal</span> Profesional
                    </h1>
                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        PT Samudra Ina Pertiwi (SIP) memiliki fokus utama dalam perekrutan dan penempatan Anak Buah Kapal (ABK) Indonesia untuk sektor perikanan di luar negeri. Sebagai perusahaan yang berkomitmen, PT Samudra Ina Pertiwi tidak hanya berperan sebagai mediator antara pencari kerja dan perusahaan kapal, tetapi juga mengutamakan kesejahteraan pekerja. Dengan menyediakan peluang kerja di luar negeri, perusahaan ini membantu masyarakat Indonesia yang ingin meningkatkan kualitas hidup mereka melalui pekerjaan yang lebih baik di sektor perikanan internasional.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-bold shadow-xl shadow-blue-600/30 transition text-center text-base">
                            Gabung Sekarang <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#alur" class="border border-slate-700 hover:border-slate-500 text-slate-200 hover:text-white px-8 py-4 rounded-xl font-semibold transition text-center text-base">
                            Lihat Alur Kerja
                        </a>
                    </div>
                </div>
                <!-- Team Image Mockup -->
                <div class="lg:col-span-5 relative hidden lg:block">
                    <div class="relative rounded-2xl overflow-hidden border-2 border-slate-700 shadow-[0_0_40px_rgba(59,130,246,0.3)] group hover:scale-[1.02] transition-transform duration-500">
                        <img src="<?php echo e(asset('images/hero.jpg')); ?>" class="w-full h-auto object-contain rounded-2xl group-hover:scale-105 transition-transform duration-700 bg-slate-800" alt="Tim PT Samudra Ina Pertiwi">
                        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h3 class="inline-block px-4 py-2 bg-blue-600/90 backdrop-blur text-white text-lg sm:text-2xl font-black uppercase tracking-widest rounded mb-2 shadow-lg drop-shadow-md">PT. SAMUDRA INA PERTIWI</h3>
                            <p class="text-sm font-medium text-slate-100 mt-1 drop-shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">Berkomitmen penuh menyalurkan tenaga kerja pelaut Indonesia ke kancah Internasional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Profile Section -->
    <section id="profil" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider">Profil Perusahaan</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900">PT. Samudra Ina Pertiwi</h3>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    Layanan yang ditawarkan oleh PT Samudra Ina Pertiwi mencakup perekrutan dan penempatan Awak Kapal Berlayar (ABK) Indonesia untuk bekerja di kapal perikanan yang beroperasi di luar negeri. SIP mengutamakan kesempatan bagi calon pekerja, baik yang sudah memiliki pengalaman di bidang tersebut maupun bagi mereka yang baru pertama kali ingin mencoba.
                </p>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed mt-4">
                    Hal menarik dari layanan ini adalah tidak adanya biaya yang dibebankan di awal proses perekrutan, sehingga mempermudah calon pekerja untuk bergabung tanpa harus memikirkan beban finansial di tahap awal. PT Samudra Ina Pertiwi berkomitmen untuk membantu para ABK dalam mencapai peluang kerja di industri perikanan internasional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 space-y-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-xl font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900">Legalitas & Amanah</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Kami menjamin penempatan kerja secara resmi dan legal dengan perlindungan kontrak kerja laut (KKL) yang kuat bagi calon ABK.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 space-y-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-xl font-bold">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900">Pelatihan Terarah</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Pendidikan Diklat terintegrasi langsung di Pemalang untuk mempersiapkan kesiapan mental, skill laut, serta sertifikasi keselamatan.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-100 space-y-4 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center text-violet-600 text-xl font-bold">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900">Jaringan Global</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Kemitraan erat dengan perusahaan kapal penangkap ikan dan logistik luar negeri di kawasan Asia Pasifik, Eropa, hingga Amerika.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recruitment Flow Section (The 6 Steps) -->
    <section id="alur" class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold text-blue-400 uppercase tracking-wider">Tahapan Proses</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold">Alur Rekrutmen Calon ABK</h3>
                <div class="w-16 h-1 bg-blue-500 mx-auto rounded"></div>
                <p class="text-slate-400">
                    Kami mendigitalisasi seluruh tahapan rekrutmen secara transparan agar calon ABK dapat memantau status secara langsung dari rumah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition group">
                    <span class="absolute top-4 right-6 text-5xl font-extrabold text-slate-700 group-hover:text-blue-500/20 transition">01</span>
                    <h4 class="text-lg font-bold text-white mb-2">Registrasi & Berkas</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Calon ABK mendaftar akun, melengkapi profil diri, serta mengupload 5 dokumen wajib (KTP, KK, SKCK, Akta Kelahiran, Ijazah).
                    </p>
                </div>
                <!-- Step 2 -->
                <div class="relative bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition group">
                    <span class="absolute top-4 right-6 text-5xl font-extrabold text-slate-700 group-hover:text-blue-500/20 transition">02</span>
                    <h4 class="text-lg font-bold text-white mb-2">Medical Check-Up</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Setelah dokumen terverifikasi disetujui, calon ABK melakukan tes kesehatan fisik/MCU secara mandiri dan mengupload hasilnya.
                    </p>
                </div>
                <!-- Step 3 -->
                <div class="relative bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition group">
                    <span class="absolute top-4 right-6 text-5xl font-extrabold text-slate-700 group-hover:text-blue-500/20 transition">03</span>
                    <h4 class="text-lg font-bold text-white mb-2">Diklat (Pelatihan)</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Mengikuti pelatihan fisik dan mental selama 7 hari di Balai Diklat Pemalang untuk menanamkan pemahaman keselamatan pelaut dasar.
                    </p>
                </div>
                <!-- Step 4 -->
                <div class="relative bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition group">
                    <span class="absolute top-4 right-6 text-5xl font-extrabold text-slate-700 group-hover:text-blue-500/20 transition">04</span>
                    <h4 class="text-lg font-bold text-white mb-2">Dokumen Pelaut</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Pembuatan Paspor, BST (Basic Safety Training), dan Buku Pelaut secara mandiri, didampingi secara administrasi hingga rampung.
                    </p>
                </div>
                <!-- Step 5 -->
                <div class="relative bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition group">
                    <span class="absolute top-4 right-6 text-5xl font-extrabold text-slate-700 group-hover:text-blue-500/20 transition">05</span>
                    <h4 class="text-lg font-bold text-white mb-2">Waiting List & Job</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Masuk daftar tunggu. Operator mencocokkan dokumen Anda dengan kuota kapal dan negara penempatan tujuan yang siap berangkat.
                    </p>
                </div>
                <!-- Step 6 -->
                <div class="relative bg-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500 transition group">
                    <span class="absolute top-4 right-6 text-5xl font-extrabold text-slate-700 group-hover:text-blue-500/20 transition">06</span>
                    <h4 class="text-lg font-bold text-white mb-2">Keberangkatan & Board</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Penerbitan visa & tiket pesawat penerbangan. Calon ABK berangkat ke negara pelabuhan tujuan dan resmi On Board bertugas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Document Requirements Section -->
    <section id="persyaratan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider">Persyaratan Administrasi</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Kelengkapan Dokumen Pelamar</h3>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Wajib -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200">
                    <h4 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                        <i class="fa-solid fa-circle-exclamation text-blue-600 mr-3"></i> Dokumen Wajib (Semua Pelamar)
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">KTP (Kartu Tanda Penduduk)</strong>
                                <p class="text-xs text-slate-500">Scan KTP asli yang masih berlaku secara jelas.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">Kartu Keluarga (KK)</strong>
                                <p class="text-xs text-slate-500">Scan KK terbaru untuk validasi kependudukan.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">SKCK (Surat Keterangan Catatan Kepolisian)</strong>
                                <p class="text-xs text-slate-500">SKCK aktif dari Polres setempat.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">Akta Kelahiran</strong>
                                <p class="text-xs text-slate-500">Scan akta kelahiran asli.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">Ijazah Terakhir</strong>
                                <p class="text-xs text-slate-500">Scan ijazah sekolah umum terakhir.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Tambahan -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200">
                    <h4 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                        <i class="fa-solid fa-award text-violet-600 mr-3"></i> Dokumen Tambahan (Jika Berpengalaman)
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fa-solid fa-plus text-violet-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">Paspor</strong>
                                <p class="text-xs text-slate-500">Paspor aktif minimal sisa masa berlaku 18 bulan.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-plus text-violet-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">BST (Basic Safety Training)</strong>
                                <p class="text-xs text-slate-500">Sertifikat pelatihan keselamatan standar IMO.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-plus text-violet-500 mt-1 mr-3"></i>
                            <div>
                                <strong class="text-slate-800">Buku Pelaut (Seaman's Book)</strong>
                                <p class="text-xs text-slate-500">Catatan dinas berlayar resmi dari syahbandar.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider">Tanya Jawab</h2>
                <h3 class="text-3xl font-extrabold text-slate-900">Pertanyaan yang Sering Diajukan (FAQ)</h3>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>

            <!-- Accordion Items -->
            <div class="space-y-4">
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h4 class="font-bold text-slate-900 text-base sm:text-lg">Apakah pendaftaran ini dipungut biaya?</h4>
                    <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                        Pendaftaran akun di sistem web ini 100% gratis. Segala biaya pengurusan dokumen pelaut mandiri dan MCU dilakukan di balai/rumah sakit yang ditunjuk dengan biaya transparan.
                    </p>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h4 class="font-bold text-slate-900 text-base sm:text-lg">Berapa lama durasi pelatihan Diklat offline?</h4>
                    <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                        Pelatihan Diklat offline dilaksanakan selama 7 hari bertempat di Balai Diklat Pemalang, berfokus pada pelatihan keselamatan maritim, koordinasi tim, dan fisik dasar.
                    </p>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h4 class="font-bold text-slate-900 text-base sm:text-lg">Kapal apa saja yang ditawarkan untuk penempatan?</h4>
                    <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                        Kami bekerja sama dengan maskapai pelayaran internasional mencakup kapal penangkap ikan berbendera Taiwan/Korea, kapal cargo logistik internasional, serta kapal pesiar komersial.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider">Hubungi Kami</h2>
                <h3 class="text-3xl font-extrabold text-slate-900">Kantor PT. Samudra Ina Pertiwi</h3>
                <div class="w-16 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                <!-- Info -->
                <div class="bg-slate-900 text-white p-10 rounded-2xl flex flex-col justify-between space-y-8">
                    <div class="space-y-6">
                        <h4 class="text-xl font-bold">Informasi Kontak Kantor</h4>
                        <p class="text-slate-400 text-sm">
                            Kunjungi kantor operasional kami untuk verifikasi langsung dokumen fisik dan arahan seleksi lanjutan.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fa-solid fa-location-dot text-blue-400 text-lg mt-1 mr-4"></i>
                                <span class="text-sm text-slate-300">Jalan Among dwijo RT 05 RW 03 Desa Pangkah Kecamatan Pangkah Kabupaten Tegal, Jawa Tengah</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-phone text-blue-400 text-lg mr-4"></i>
                                <span class="text-sm text-slate-300">083141413000</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-envelope text-blue-400 text-lg mr-4"></i>
                                <span class="text-sm text-slate-300">samudrainapertiwipt@gmail.com</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
                        <span class="text-xs text-slate-500">Copyright &copy; 2026 PT. Samudra Ina Pertiwi</span>
                        <div class="flex space-x-4">
                            <a href="#" class="text-slate-400 hover:text-white transition"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="text-slate-400 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="text-slate-400 hover:text-white transition"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-md">
                    <div class="bg-slate-100 px-5 py-3 flex items-center gap-2 border-b border-slate-200">
                        <i class="fa-solid fa-location-dot text-blue-600"></i>
                        <span class="text-sm font-semibold text-slate-700">Lokasi Kantor di Google Maps</span>
                        <a href="https://maps.app.goo.gl/vPGCNcKooFy6E3BE7" target="_blank" class="ml-auto text-xs font-semibold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                            Buka di Maps <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                    <iframe
                        src="https://maps.google.com/maps?q=Jalan+Among+dwijo+RT+05+RW+03+Desa+Pangkah+Kecamatan+Pangkah+Kabupaten+Tegal+Jawa+Tengah&output=embed&z=16"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

</body>
</html><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/welcome.blade.php ENDPATH**/ ?>