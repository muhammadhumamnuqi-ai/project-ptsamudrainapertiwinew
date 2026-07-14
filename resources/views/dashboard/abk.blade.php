@extends('layouts.app')

@section('page_title', 'Status Pendaftaran')
@section('page_subtitle', 'Pantau progres rekrutmen dan lengkapi berkas Anda secara real-time')

@section('content')
<div class="space-y-8">

    <!-- Stepper Tracker -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm overflow-hidden">
        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
            <i class="fa-solid fa-map-location-dot text-blue-600 mr-2.5"></i> Progress Tracker Tahapan Rekrutmen
        </h3>

        <!-- Stepper Visual -->
        <div class="relative flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
            <!-- Line across stepper (desktop only) -->
            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 h-1 bg-slate-100 hidden md:block z-0"></div>
            <!-- Progress Line filling up to current active stage -->
            @php
                $progressPct = (($tahapAktif - 1) / 5) * 100;
            @endphp
            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 hidden md:block z-0 transition-all duration-500" style="width: {{ $progressPct }}%"></div>

            <!-- Steps -->
            @php
                $steps = [
                    1 => ['icon' => 'fa-file-signature', 'label' => 'Administrasi'],
                    2 => ['icon' => 'fa-notes-medical', 'label' => 'Medical Check-Up'],
                    3 => ['icon' => 'fa-graduation-cap', 'label' => 'Diklat Offline'],
                    4 => ['icon' => 'fa-passport', 'label' => 'Dokumen Pelaut'],
                    5 => ['icon' => 'fa-anchor', 'label' => 'Waiting List Job'],
                    6 => ['icon' => 'fa-plane-departure', 'label' => 'Keberangkatan'],
                ];
            @endphp

            @foreach($steps as $num => $step)
                @php
                    $isCompleted = $num < $tahapAktif || ($num == $tahapAktif && $statusTahap === 'Selesai');
                    $isActive = $num == $tahapAktif && $statusTahap !== 'Selesai';
                    $isUpcoming = $num > $tahapAktif;
                @endphp
                <div class="flex flex-col items-center relative z-10 w-full md:w-auto">
                    <!-- Circle -->
                    <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 shadow-md
                        {{ $isCompleted ? 'bg-emerald-600 text-white ring-4 ring-emerald-100' : '' }}
                        {{ $isActive ? 'bg-blue-600 text-white ring-4 ring-blue-100 animate-pulse' : '' }}
                        {{ $isUpcoming ? 'bg-white text-slate-400 border-2 border-slate-200' : '' }}
                    ">
                        <i class="fa-solid {{ $step['icon'] }} text-base"></i>
                    </div>
                    <span class="text-xs font-bold mt-2 text-center
                        {{ $isCompleted ? 'text-emerald-700' : '' }}
                        {{ $isActive ? 'text-blue-700' : '' }}
                        {{ $isUpcoming ? 'text-slate-400' : '' }}
                    ">
                        {{ $step['label'] }}
                    </span>
                    <span class="text-[9px] uppercase tracking-wider font-semibold text-slate-400">Tahap {{ $num }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Active Stage Detail Panel & Uploads -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Panel: Stage Instructions & Uploaders -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Alert Info Box based on current status -->
            <div class="rounded-2xl border p-6 flex items-start space-x-4 shadow-sm bg-white border-slate-200">
                <div class="w-12 h-12 rounded-xl flex-shrink-0 flex items-center justify-center text-xl font-bold
                    {{ $statusTahap === 'Revisi' ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600' }}
                ">
                    @if($statusTahap === 'Revisi')
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    @else
                        <i class="fa-solid fa-circle-info"></i>
                    @endif
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-950">
                        Status Anda saat ini: 
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                            {{ $statusTahap === 'Selesai' ? 'bg-emerald-100 text-emerald-800' : '' }}
                            {{ $statusTahap === 'Dalam Proses' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $statusTahap === 'Revisi' ? 'bg-amber-100 text-amber-800' : '' }}
                            {{ $statusTahap === 'Pending' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $statusTahap === 'Terjadwal' ? 'bg-cyan-100 text-cyan-800' : '' }}
                            {{ $statusTahap === 'Ditolak' ? 'bg-red-100 text-red-800' : '' }}
                        ">
                            {{ $statusTahap }}
                        </span>
                    </h4>
                    <p class="text-sm text-slate-600 mt-2">{{ $catatanTahap ?: 'Ikuti instruksi di bawah ini untuk menyelesaikan tahapan Anda.' }}</p>
                </div>
            </div>

            <!-- Stage Content Blocks -->

            <!-- TAHAP 1: UPLOAD DOKUMEN WAJIB -->
            @if($tahapAktif == 1)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 1: Unggah Dokumen Administrasi Wajib</h3>
                        <p class="text-xs text-slate-500 mt-1">Unggah berkas KTP, Kartu Keluarga, SKCK, Akta Lahir, dan Ijazah Terakhir dalam format PDF/JPG/PNG maksimal <strong>5 MB</strong> per file.</p>
                    </div>

                    <!-- Progress Bar Kelengkapan Dokumen -->
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-1">
                            <span>Kelengkapan Berkas Administrasi</span>
                            <span>{{ $docPercent }}% ({{ $approvedCount }}/5 Disetujui)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-emerald-600 h-2 rounded-full transition-all duration-500" style="width: {{ $docPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Documents Grid -->
                    @php
                        $docMeta = [
                            'ktp' => 'KTP (Kartu Tanda Penduduk)',
                            'kartu_keluarga' => 'Kartu Keluarga (KK)',
                            'skck' => 'SKCK Polres Terakhir',
                            'akta_kelahiran' => 'Akta Kelahiran Asli',
                            'ijazah' => 'Ijazah Pendidikan Terakhir',
                        ];
                    @endphp

                    <div class="space-y-4">
                        @foreach($docMeta as $type => $label)
                            @php
                                $doc = $user->dokumen->where('jenis_dokumen', $type)->first();
                            @endphp
                            <div class="p-4 rounded-xl border border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="space-y-1">
                                    <h5 class="text-sm font-semibold text-slate-900">{{ $label }}</h5>
                                    @if($doc)
                                        <div class="flex items-center space-x-2 text-xs">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                                {{ $doc->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                                {{ $doc->status === 'Menunggu Verifikasi' ? 'bg-amber-100 text-amber-800' : '' }}
                                                {{ $doc->status === 'Ditolak' ? 'bg-red-100 text-red-800' : '' }}
                                            ">
                                                {{ $doc->status }}
                                            </span>
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 hover:underline"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Berkas</a>
                                        </div>
                                        @if($doc->catatan_operator)
                                            <p class="text-xs text-red-600 mt-1 font-medium bg-red-50 p-2 rounded">Revisi: {{ $doc->catatan_operator }}</p>
                                        @endif
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum diunggah</span>
                                    @endif
                                </div>

                                @if(!$doc || $doc->status === 'Ditolak' || $doc->status === 'Menunggu Verifikasi')
                                    <form action="{{ route('dokumen.upload') }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="hidden" name="jenis_dokumen" value="{{ $type }}">
                                        <label class="cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold border border-slate-200 transition">
                                            {{ $doc ? 'Unggah Ulang' : 'Pilih Berkas' }}
                                            <input type="file" name="file_dokumen" class="hidden" accept=".pdf,.jpg,.jpeg,.png" onchange="validateFileSize(this, 5)">
                                        </label>
                                        <span class="text-[10px] text-slate-400">PDF/JPG/PNG · Maks. 5 MB</span>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- TAHAP 2: MEDICAL CHECK-UP -->
            @if($tahapAktif == 2)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 2: Medical Check-Up (MCU)</h3>
                        <p class="text-xs text-slate-500 mt-1">Lakukan pemeriksaan kesehatan fisik lengkap (Fit to Work) secara mandiri di rumah sakit atau lab kesehatan yang ditunjuk, kemudian unggah hasilnya.</p>
                    </div>

                    @php
                        $mcu = $user->medicalCheckups->sortByDesc('created_at')->first();
                    @endphp

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex justify-between items-center">
                            <h5 class="text-sm font-semibold text-slate-900">Unggah Hasil Scan MCU</h5>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                                {{ !$mcu ? 'bg-slate-200 text-slate-600' : '' }}
                                {{ $mcu && $mcu->status_mcu === 'Menunggu Upload Hasil MCU' ? 'bg-slate-200 text-slate-600' : '' }}
                                {{ $mcu && $mcu->status_mcu === 'Menunggu Verifikasi MCU' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $mcu && $mcu->status_mcu === 'Lulus MCU' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                {{ $mcu && $mcu->status_mcu === 'Pending MCU' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $mcu && $mcu->status_mcu === 'Tidak Lulus MCU' ? 'bg-red-100 text-red-800' : '' }}
                            ">
                                {{ $mcu ? $mcu->status_mcu : 'Belum Ada Data' }}
                            </span>
                        </div>

                        @if($mcu && $mcu->file_hasil_mcu)
                            <div class="flex items-center space-x-2 text-xs">
                                <a href="{{ asset('storage/' . $mcu->file_hasil_mcu) }}" target="_blank" class="text-blue-600 hover:underline font-semibold"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Hasil MCU Terunggah</a>
                                <span class="text-slate-400">| Diupload pada: {{ $mcu->tanggal_upload ? $mcu->tanggal_upload->format('d-m-Y H:i') : '' }}</span>
                            </div>
                            @if($mcu->catatan_operator)
                                <div class="text-xs bg-slate-100 p-3 rounded-lg border border-slate-200">
                                    <strong class="text-slate-800 block">Catatan Pemeriksa (Operator):</strong>
                                    <p class="text-slate-600 mt-1">{{ $mcu->catatan_operator }}</p>
                                </div>
                            @endif
                        @endif

                        @if(!$mcu || in_array($mcu->status_mcu, ['Menunggu Upload Hasil MCU', 'Menunggu Verifikasi MCU', 'Pending MCU', 'Tidak Lulus MCU']))
                            <form action="{{ route('mcu.upload') }}" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-blue-500 transition cursor-pointer relative bg-white">
                                @csrf
                                <input type="file" name="file_hasil_mcu" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png" onchange="validateFileSize(this, 5)">
                                <i class="fa-solid fa-cloud-arrow-up text-slate-400 text-3xl mb-2"></i>
                                <p class="text-xs font-semibold text-slate-600">
                                    {{ ($mcu && $mcu->file_hasil_mcu) ? 'Klik atau seret berkas hasil MCU baru untuk mengunggah ulang (menggantikan berkas lama)' : 'Klik atau seret berkas PDF hasil pemeriksaan MCU untuk diunggah' }}
                                </p>
                                <p class="text-[10px] text-slate-400 mt-1">Format: PDF, JPG, PNG &bull; Ukuran Maksimal: <strong class="text-slate-600">5 MB</strong></p>
                            </form>
                        @endif
                    </div>
                </div>
            @endif

            <!-- TAHAP 3: DIKLAT -->
            @if($tahapAktif == 3)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 3: Jadwal Diklat Offline Pemalang</h3>
                        <p class="text-xs text-slate-500 mt-1">Calon ABK wajib mengikuti pelatihan fisik, mental, dan kedisiplinan berlayar selama 7 hari di Pemalang sesuai jadwal kelompok batch Anda.</p>
                    </div>

                    @php
                        $diklat = $user->diklat->sortByDesc('created_at')->first();
                    @endphp

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                            <span class="text-sm font-semibold text-slate-900">Status Diklat</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                                {{ $diklat && $diklat->status === 'Terjadwal' ? 'bg-cyan-100 text-cyan-800' : '' }}
                                {{ $diklat && $diklat->status === 'Sedang Mengikuti Diklat' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $diklat && $diklat->status === 'Lulus Diklat' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                {{ $diklat && $diklat->status === 'Tidak Lulus Diklat' ? 'bg-red-100 text-red-800' : '' }}
                                {{ !$diklat || $diklat->status === 'Menunggu Jadwal Diklat' ? 'bg-slate-100 text-slate-600' : '' }}
                            ">
                                {{ $diklat ? $diklat->status : 'Menunggu Jadwal Diklat' }}
                            </span>
                        </div>

                        @if($diklat && $diklat->tanggal_mulai)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Batch Kelompok</span>
                                    <strong class="text-slate-900">{{ $diklat->batch ?: 'N/A' }}</strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Lokasi Diklat</span>
                                    <strong class="text-slate-900">{{ $diklat->lokasi }}</strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Tanggal Mulai</span>
                                    <strong class="text-slate-900">{{ $diklat->tanggal_mulai->format('d F Y') }}</strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Tanggal Selesai</span>
                                    <strong class="text-slate-900">{{ $diklat->tanggal_selesai->format('d F Y') }}</strong>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <i class="fa-solid fa-calendar-clock text-slate-400 text-3xl mb-2"></i>
                                <p class="text-xs font-semibold text-slate-600">Menunggu Penjadwalan oleh Operator</p>
                                <p class="text-[10px] text-slate-400 mt-1">Jadwal batch biasanya diterbitkan 2-3 hari kerja setelah Anda dinyatakan lulus tes MCU.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- TAHAP 4: PENGURUSAN DOKUMEN PELAUT -->
            @if($tahapAktif == 4)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 4: Pengurusan & Unggah Bukti Dokumen Pelaut</h3>
                        <p class="text-xs text-slate-500 mt-1">Lulus Diklat! Lakukan pembuatan berkas berlayar internasional (Paspor, BST, dan Buku Pelaut) secara mandiri, kemudian daftarkan buktinya di bawah ini.</p>
                    </div>

                    @php
                        $pDocs = ['paspor' => 'Paspor RI', 'bst' => 'Sertifikat BST (Basic Safety Training)', 'buku_pelaut' => 'Buku Pelaut (Seaman Book)'];
                    @endphp

                    <div class="space-y-4">
                        @foreach($pDocs as $type => $label)
                            @php
                                $doc = $user->dokumenPelaut->where('jenis_dokumen', $type)->first();
                            @endphp
                            <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50 space-y-4">
                                <div class="flex justify-between items-center">
                                    <h5 class="text-sm font-semibold text-slate-900">{{ $label }}</h5>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                        {{ $doc && $doc->status_verifikasi === 'Disetujui' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ $doc && $doc->status_verifikasi === 'Menunggu Verifikasi' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $doc && $doc->status_verifikasi === 'Ditolak' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ !$doc || $doc->status_verifikasi === 'Menunggu Pengurusan Dokumen' ? 'bg-slate-200 text-slate-600' : '' }}
                                    ">
                                        {{ $doc ? $doc->status_verifikasi : 'Menunggu Pengurusan Dokumen' }}
                                    </span>
                                </div>

                                @if($doc && $doc->file_path)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-xs text-slate-700 bg-white p-3 rounded-lg border">
                                        <div><strong>No Dokumen:</strong> {{ $doc->nomor_dokumen }}</div>
                                        <div><strong>Tgl Terbit:</strong> {{ $doc->tanggal_terbit ? $doc->tanggal_terbit->format('d-m-Y') : '-' }}</div>
                                        <div><strong>Expired:</strong> {{ $doc->tanggal_expired ? $doc->tanggal_expired->format('d-m-Y') : '-' }}</div>
                                        <div class="md:col-span-3 mt-2">
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-blue-600 hover:underline font-semibold"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Berkas</a>
                                        </div>
                                    </div>
                                @endif

                                @if(!$doc || in_array($doc->status_verifikasi, ['Menunggu Pengurusan Dokumen', 'Menunggu Verifikasi', 'Ditolak']))
                                    <form action="{{ route('dokumen_pelaut.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded-xl border border-slate-200">
                                        @csrf
                                        <input type="hidden" name="jenis_dokumen" value="{{ $type }}">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Nomor Dokumen</label>
                                                <input type="text" name="nomor_dokumen" required value="{{ old('nomor_dokumen', $doc ? $doc->nomor_dokumen : '') }}" placeholder="Contoh: B123456" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tanggal Terbit</label>
                                                <input type="date" name="tanggal_terbit" required value="{{ old('tanggal_terbit', $doc && $doc->tanggal_terbit ? $doc->tanggal_terbit->format('Y-m-d') : '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tanggal Kadaluarsa</label>
                                                <input type="date" name="tanggal_expired" required value="{{ old('tanggal_expired', $doc && $doc->tanggal_expired ? $doc->tanggal_expired->format('Y-m-d') : '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-blue-500">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-center justify-between mb-1">
                                                <label class="block text-[10px] font-bold uppercase text-slate-500">Unggah Berkas Scan (PDF/JPG/PNG)</label>
                                                <span class="text-[10px] text-slate-400">PDF/JPG/PNG · Maks. <strong>5 MB</strong></span>
                                            </div>
                                            <input type="file" name="file_dokumen" required accept=".pdf,.jpg,.jpeg,.png" onchange="validateFileSize(this, 5)" class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        </div>
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition">
                                            {{ $doc && $doc->file_path ? 'Unggah Ulang Dokumen' : 'Simpan Dokumen' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- TAHAP 5: WAITING LIST & JOB PENEMPATAN -->
            @if($tahapAktif == 5)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 5: Daftar Tunggu (Waiting List) Job Order</h3>
                        <p class="text-xs text-slate-500 mt-1">Dokumen dan kompetensi Anda telah lengkap. Anda terdaftar di waiting list penempatan. Operator kami sedang memproses pencocokan dengan pemberi kerja kapal asing.</p>
                    </div>

                    @php
                        $job = $user->jobOrders->first();
                    @endphp

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 text-center py-8">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-3xl mx-auto mb-4">
                            <i class="fa-solid fa-anchor"></i>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">Status Penempatan Kapal</h4>
                        <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full uppercase mt-2">
                            {{ $job ? $job->status_job : 'Waiting List' }}
                        </span>
                        
                        @if($job && $job->nama_kapal)
                            <div class="mt-6 max-w-md mx-auto bg-white p-4 rounded-xl border space-y-3 text-sm text-left">
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-slate-500">Kapal Penempatan:</span>
                                    <strong class="text-slate-900">{{ $job->nama_kapal }}</strong>
                                </div>
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-slate-500">Negara Tujuan:</span>
                                    <strong class="text-slate-900">{{ $job->negara_tujuan }}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Posisi Tugas:</span>
                                    <strong class="text-slate-900">{{ $job->posisi }}</strong>
                                </div>
                            </div>
                        @else
                            <p class="text-xs text-slate-500 mt-4 max-w-sm mx-auto">Kami akan segera memberi tahu Anda melalui email dan notifikasi sistem begitu Anda terpilih oleh perusahaan pelayaran.</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- TAHAP 6: KEBERANGKATAN -->
            @if($tahapAktif == 6)
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 6: Detail Keberangkatan Penerbangan</h3>
                        <p class="text-xs text-slate-500 mt-1">Selamat! Tiket pesawat dan visa Anda sedang disiapkan. Periksa jadwal penerbangan Anda secara berkala di bawah ini.</p>
                    </div>

                    @php
                        $flight = $user->keberangkatan->first();
                    @endphp

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex justify-between items-center border-b pb-3">
                            <span class="text-sm font-semibold text-slate-900">Status Keberangkatan</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                {{ $flight && $flight->status === 'Tiket Diproses' ? 'bg-slate-200 text-slate-700' : '' }}
                                {{ $flight && $flight->status === 'Jadwal Terbit' ? 'bg-cyan-100 text-cyan-800' : '' }}
                                {{ $flight && $flight->status === 'Berangkat' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $flight && $flight->status === 'On Board' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                {{ !$flight ? 'bg-slate-100 text-slate-500' : '' }}
                            ">
                                {{ $flight ? $flight->status : 'Tiket Diproses' }}
                            </span>
                        </div>

                        @if($flight && $flight->maskapai)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Maskapai / Maskapai Penerbangan</span>
                                    <strong class="text-slate-900">{{ $flight->maskapai }}</strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Nomor Penerbangan</span>
                                    <strong class="text-slate-900">{{ $flight->nomor_penerbangan }}</strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Negara Pelabuhan Tujuan</span>
                                    <strong class="text-slate-900">{{ $flight->negara_tujuan }}</strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Tanggal Terbang (Keberangkatan)</span>
                                    <strong class="text-slate-900">{{ $flight->tanggal_berangkat ? $flight->tanggal_berangkat->format('d F Y, H:i') : '-' }} WIB</strong>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fa-solid fa-ticket-airline text-slate-400 text-4xl mb-2"></i>
                                <p class="text-xs font-semibold text-slate-600">Tiket Sedang Diproses</p>
                                <p class="text-[10px] text-slate-400 mt-1">Dokumen visa dan tiket penerbangan grup sedang dalam pemrosesan administrasi.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>

        <!-- Right Panel: Profile Form & System Notifications -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Complete Profile Form -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Profil Calon ABK</h3>
                    <p class="text-xs text-slate-500">Lengkapi biodata pribadi Anda untuk validasi data kapal</p>
                </div>

                @php
                    $profile = $user->profilAbk;
                @endphp

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <!-- Profile Photo Display/Upload -->
                    <div class="flex items-center space-x-4">
                        @php
                            $photoUrl = ($profile && $profile->foto_profil) ? asset('storage/' . $profile->foto_profil) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop';
                        @endphp
                        <img class="h-16 w-16 rounded-full object-cover ring-2 ring-blue-500/20" src="{{ $photoUrl }}" alt="Foto">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Foto Profil (3x4)</label>
                            <input type="file" name="foto_profil" accept=".jpg,.jpeg,.png" onchange="validateFileSize(this, 5)" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap', $profile ? $profile->nama_lengkap : $user->name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $profile ? $profile->tempat_lahir : '') }}" placeholder="Pemalang" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Hari</label>
                            @php
                                $tgl = ($profile && $profile->tanggal_lahir) ? $profile->tanggal_lahir->format('d') : '';
                            @endphp
                            <select name="tanggal_lahir_hari" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">Tgl</option>
                                @for($d = 1; $d <= 31; $d++)
                                    <option value="{{ str_pad($d, 2, '0', STR_PAD_LEFT) }}" {{ $tgl == str_pad($d, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ $d }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Bulan</label>
                            @php
                                $bln = ($profile && $profile->tanggal_lahir) ? (int)$profile->tanggal_lahir->format('m') : 0;
                                $bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                            @endphp
                            <select name="tanggal_lahir_bulan" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">Bulan</option>
                                @foreach($bulanList as $i => $namaBulan)
                                    <option value="{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}" {{ $bln == ($i+1) ? 'selected' : '' }}>{{ $namaBulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tahun</label>
                            @php
                                $thn = ($profile && $profile->tanggal_lahir) ? $profile->tanggal_lahir->format('Y') : '';
                            @endphp
                            <select name="tanggal_lahir_tahun" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">Tahun</option>
                                @for($y = date('Y') - 17; $y >= 1970; $y--)
                                    <option value="{{ $y }}" {{ $thn == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Nomor HP / WhatsApp</label>
                        <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $profile ? $profile->nomor_hp : '') }}" placeholder="0812345..." class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Negara Kapal</label>
                            <select name="negara_kapal" id="negara_kapal" onchange="updateJenisKapal()" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih Negara --</option>
                                <option value="China" {{ ($profile && $profile->posisi_dilamar && str_contains($profile->posisi_dilamar, 'China')) ? 'selected' : '' }}>China</option>
                                <option value="Taiwan" {{ ($profile && $profile->posisi_dilamar && str_contains($profile->posisi_dilamar, 'Taiwan')) ? 'selected' : '' }}>Taiwan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Jenis Kapal</label>
                            <select name="posisi_dilamar" id="jenis_kapal" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih Jenis Kapal --</option>
                                <option value="China - Cumi" {{ ($profile && $profile->posisi_dilamar == 'China - Cumi') ? 'selected' : '' }}>1. Cumi</option>
                                <option value="China - Purshine" {{ ($profile && $profile->posisi_dilamar == 'China - Purshine') ? 'selected' : '' }}>2. Purshine</option>
                                <option value="China - Trawl" {{ ($profile && $profile->posisi_dilamar == 'China - Trawl') ? 'selected' : '' }}>3. Trawl</option>
                                <option value="China - Longline" {{ ($profile && $profile->posisi_dilamar == 'China - Longline') ? 'selected' : '' }}>4. Longline</option>
                            </select>
                        </div>
                    </div>

                    <script>
                        function updateJenisKapal() {
                            const negara = document.getElementById('negara_kapal').value;
                            const jenisSelect = document.getElementById('jenis_kapal');
                            jenisSelect.innerHTML = '<option value="">-- Pilih Jenis Kapal --</option>';
                            const types = ['Cumi', 'Purshine', 'Trawl', 'Longline'];
                            types.forEach((t, i) => {
                                const opt = document.createElement('option');
                                opt.value = negara + ' - ' + t;
                                opt.textContent = (i + 1) + '. ' + t;
                                jenisSelect.appendChild(opt);
                            });
                        }
                        // Run on page load to pre-select
                        document.addEventListener('DOMContentLoaded', function() {
                            const negara = document.getElementById('negara_kapal').value;
                            if (negara) updateJenisKapal();
                        });
                    </script>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Alamat Lengkap (KTP)</label>
                        <textarea name="alamat" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">{{ old('alamat', $profile ? $profile->alamat : '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Riwayat Pengalaman Kerja</label>
                        <textarea name="pengalaman_kerja" rows="2" placeholder="Tuliskan pengalaman berlayar atau pekerjaan sebelumnya" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">{{ old('pengalaman_kerja', $profile ? $profile->pengalaman_kerja : '') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 rounded-lg text-xs transition">Simpan Perubahan</button>
                </form>
            </div>

            <!-- Notifications Center -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Notifikasi Sistem</h3>
                    <p class="text-xs text-slate-500">Pemberitahuan terkini terkait akun dan status seleksi Anda</p>
                </div>

                <div class="space-y-3 max-h-64 overflow-y-auto">
                    @forelse($notifications as $notif)
                        <div class="p-3 rounded-lg border text-xs space-y-1 {{ $notif->status_baca ? 'bg-slate-50/50 border-slate-100' : 'bg-blue-50/20 border-blue-100' }}">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-slate-800">{{ $notif->judul }}</span>
                                @if(!$notif->status_baca)
                                    <form action="{{ route('notification.read', $notif->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-[9px] font-semibold text-blue-600 hover:underline">Tandai Baca</button>
                                    </form>
                                @endif
                            </div>
                            <p class="text-slate-600 leading-relaxed">{{ $notif->pesan }}</p>
                            <span class="text-[9px] text-slate-400 block pt-1">{{ $notif->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <div class="text-center py-4 text-xs text-slate-400 italic">Tidak ada notifikasi baru</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>
@section('scripts')
<script>
    function validateFileSize(input, maxMB) {
        const maxBytes = maxMB * 1024 * 1024;
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > maxBytes) {
                Swal.fire({
                    icon: 'error',
                    title: 'Berkas Terlalu Besar!',
                    html: `Ukuran berkas <strong>${(file.size / 1024 / 1024).toFixed(2)} MB</strong> melebihi batas maksimal <strong>${maxMB} MB</strong>.<br><br>Silakan kompres atau pilih berkas lain yang lebih kecil.`,
                    confirmButtonText: 'Pilih Berkas Lain',
                    confirmButtonColor: '#2563eb',
                });
                input.value = '';
                return;
            }
            // Valid - submit the form
            input.closest('form').submit();
        }
    }
</script>
@endsection

@endsection
