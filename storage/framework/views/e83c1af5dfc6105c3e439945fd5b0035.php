<?php $__env->startSection('page_title', 'Status Pendaftaran'); ?>
<?php $__env->startSection('page_subtitle', 'Pantau progres rekrutmen dan lengkapi berkas Anda secara real-time'); ?>

<?php $__env->startSection('content'); ?>
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
            <?php
                $progressPct = (($tahapAktif - 1) / 5) * 100;
            ?>
            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-blue-600 hidden md:block z-0 transition-all duration-500" style="width: <?php echo e($progressPct); ?>%"></div>

            <!-- Steps -->
            <?php
                $steps = [
                    1 => ['icon' => 'fa-file-signature', 'label' => 'Administrasi'],
                    2 => ['icon' => 'fa-notes-medical', 'label' => 'Medical Check-Up'],
                    3 => ['icon' => 'fa-graduation-cap', 'label' => 'Diklat Offline'],
                    4 => ['icon' => 'fa-passport', 'label' => 'Dokumen Pelaut'],
                    5 => ['icon' => 'fa-anchor', 'label' => 'Waiting List Job'],
                    6 => ['icon' => 'fa-plane-departure', 'label' => 'Keberangkatan'],
                ];
            ?>

            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isCompleted = $num < $tahapAktif || ($num == $tahapAktif && $statusTahap === 'Selesai');
                    $isActive = $num == $tahapAktif && $statusTahap !== 'Selesai';
                    $isUpcoming = $num > $tahapAktif;
                ?>
                <div class="flex flex-col items-center relative z-10 w-full md:w-auto">
                    <!-- Circle -->
                    <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 shadow-md
                        <?php echo e($isCompleted ? 'bg-emerald-600 text-white ring-4 ring-emerald-100' : ''); ?>

                        <?php echo e($isActive ? 'bg-blue-600 text-white ring-4 ring-blue-100 animate-pulse' : ''); ?>

                        <?php echo e($isUpcoming ? 'bg-white text-slate-400 border-2 border-slate-200' : ''); ?>

                    ">
                        <i class="fa-solid <?php echo e($step['icon']); ?> text-base"></i>
                    </div>
                    <span class="text-xs font-bold mt-2 text-center
                        <?php echo e($isCompleted ? 'text-emerald-700' : ''); ?>

                        <?php echo e($isActive ? 'text-blue-700' : ''); ?>

                        <?php echo e($isUpcoming ? 'text-slate-400' : ''); ?>

                    ">
                        <?php echo e($step['label']); ?>

                    </span>
                    <span class="text-[9px] uppercase tracking-wider font-semibold text-slate-400">Tahap <?php echo e($num); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Active Stage Detail Panel & Uploads -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Panel: Stage Instructions & Uploaders -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Alert Info Box based on current status -->
            <div class="rounded-2xl border p-6 flex items-start space-x-4 shadow-sm bg-white border-slate-200">
                <div class="w-12 h-12 rounded-xl flex-shrink-0 flex items-center justify-center text-xl font-bold
                    <?php echo e($statusTahap === 'Revisi' ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600'); ?>

                ">
                    <?php if($statusTahap === 'Revisi'): ?>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    <?php else: ?>
                        <i class="fa-solid fa-circle-info"></i>
                    <?php endif; ?>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-950">
                        Status Anda saat ini: 
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                            <?php echo e($statusTahap === 'Selesai' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                            <?php echo e($statusTahap === 'Dalam Proses' ? 'bg-blue-100 text-blue-800' : ''); ?>

                            <?php echo e($statusTahap === 'Revisi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                            <?php echo e($statusTahap === 'Pending' ? 'bg-purple-100 text-purple-800' : ''); ?>

                            <?php echo e($statusTahap === 'Terjadwal' ? 'bg-cyan-100 text-cyan-800' : ''); ?>

                            <?php echo e($statusTahap === 'Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                        ">
                            <?php echo e($statusTahap); ?>

                        </span>
                    </h4>
                    <p class="text-sm text-slate-600 mt-2"><?php echo e($catatanTahap ?: 'Ikuti instruksi di bawah ini untuk menyelesaikan tahapan Anda.'); ?></p>
                </div>
            </div>

            <!-- Stage Content Blocks -->

            <!-- TAHAP 1: UPLOAD DOKUMEN WAJIB -->
            <?php if($tahapAktif == 1): ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 1: Unggah Dokumen Administrasi Wajib</h3>
                        <p class="text-xs text-slate-500 mt-1">Unggah berkas KTP, Kartu Keluarga, SKCK, Akta Lahir, dan Ijazah Terakhir dalam format PDF/JPG/PNG maksimal <strong>5 MB</strong> per file.</p>
                    </div>

                    <!-- Progress Bar Kelengkapan Dokumen -->
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-700 mb-1">
                            <span>Kelengkapan Berkas Administrasi</span>
                            <span><?php echo e($docPercent); ?>% (<?php echo e($approvedCount); ?>/5 Disetujui)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-emerald-600 h-2 rounded-full transition-all duration-500" style="width: <?php echo e($docPercent); ?>%"></div>
                        </div>
                    </div>

                    <!-- Documents Grid -->
                    <?php
                        $docMeta = [
                            'ktp' => 'KTP (Kartu Tanda Penduduk)',
                            'kartu_keluarga' => 'Kartu Keluarga (KK)',
                            'skck' => 'SKCK Polres Terakhir',
                            'akta_kelahiran' => 'Akta Kelahiran Asli',
                            'ijazah' => 'Ijazah Pendidikan Terakhir',
                        ];
                    ?>

                    <div class="space-y-4">
                        <?php $__currentLoopData = $docMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $doc = $user->dokumen->where('jenis_dokumen', $type)->first();
                            ?>
                            <div class="p-4 rounded-xl border border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="space-y-1">
                                    <h5 class="text-sm font-semibold text-slate-900"><?php echo e($label); ?></h5>
                                    <?php if($doc): ?>
                                        <div class="flex items-center space-x-2 text-xs">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                                <?php echo e($doc->status === 'Disetujui' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                                <?php echo e($doc->status === 'Menunggu Verifikasi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                                <?php echo e($doc->status === 'Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                                            ">
                                                <?php echo e($doc->status); ?>

                                            </span>
                                            <a href="<?php echo e(asset('storage/' . $doc->file_path)); ?>" target="_blank" class="text-blue-600 hover:underline"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Berkas</a>
                                        </div>
                                        <?php if($doc->catatan_operator): ?>
                                            <p class="text-xs text-red-600 mt-1 font-medium bg-red-50 p-2 rounded">Revisi: <?php echo e($doc->catatan_operator); ?></p>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 italic">Belum diunggah</span>
                                    <?php endif; ?>
                                </div>

                                <?php if(!$doc || $doc->status === 'Ditolak' || $doc->status === 'Menunggu Verifikasi'): ?>
                                    <form action="<?php echo e(route('dokumen.upload')); ?>" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="jenis_dokumen" value="<?php echo e($type); ?>">
                                        <label class="cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold border border-slate-200 transition">
                                            <?php echo e($doc ? 'Unggah Ulang' : 'Pilih Berkas'); ?>

                                            <input type="file" name="file_dokumen" class="hidden" accept=".pdf,.jpg,.jpeg,.png" onchange="validateFileSize(this, 5)">
                                        </label>
                                        <span class="text-[10px] text-slate-400">PDF/JPG/PNG · Maks. 5 MB</span>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TAHAP 2: MEDICAL CHECK-UP -->
            <?php if($tahapAktif == 2): ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 2: Medical Check-Up (MCU)</h3>
                        <p class="text-xs text-slate-500 mt-1">Lakukan pemeriksaan kesehatan fisik lengkap (Fit to Work) secara mandiri di rumah sakit atau lab kesehatan yang ditunjuk, kemudian unggah hasilnya.</p>
                    </div>

                    <?php
                        $mcu = $user->medicalCheckups->sortByDesc('created_at')->first();
                    ?>

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex justify-between items-center">
                            <h5 class="text-sm font-semibold text-slate-900">Unggah Hasil Scan MCU</h5>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                                <?php echo e(!$mcu ? 'bg-slate-200 text-slate-600' : ''); ?>

                                <?php echo e($mcu && $mcu->status_mcu === 'Menunggu Upload Hasil MCU' ? 'bg-slate-200 text-slate-600' : ''); ?>

                                <?php echo e($mcu && $mcu->status_mcu === 'Menunggu Verifikasi MCU' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                <?php echo e($mcu && $mcu->status_mcu === 'Lulus MCU' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                <?php echo e($mcu && $mcu->status_mcu === 'Pending MCU' ? 'bg-purple-100 text-purple-800' : ''); ?>

                                <?php echo e($mcu && $mcu->status_mcu === 'Tidak Lulus MCU' ? 'bg-red-100 text-red-800' : ''); ?>

                            ">
                                <?php echo e($mcu ? $mcu->status_mcu : 'Belum Ada Data'); ?>

                            </span>
                        </div>

                        <?php if($mcu && $mcu->file_hasil_mcu): ?>
                            <div class="flex items-center space-x-2 text-xs">
                                <a href="<?php echo e(asset('storage/' . $mcu->file_hasil_mcu)); ?>" target="_blank" class="text-blue-600 hover:underline font-semibold"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Hasil MCU Terunggah</a>
                                <span class="text-slate-400">| Diupload pada: <?php echo e($mcu->tanggal_upload ? $mcu->tanggal_upload->format('d-m-Y H:i') : ''); ?></span>
                            </div>
                            <?php if($mcu->catatan_operator): ?>
                                <div class="text-xs bg-slate-100 p-3 rounded-lg border border-slate-200">
                                    <strong class="text-slate-800 block">Catatan Pemeriksa (Operator):</strong>
                                    <p class="text-slate-600 mt-1"><?php echo e($mcu->catatan_operator); ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(!$mcu || in_array($mcu->status_mcu, ['Menunggu Upload Hasil MCU', 'Menunggu Verifikasi MCU', 'Pending MCU', 'Tidak Lulus MCU'])): ?>
                            <form action="<?php echo e(route('mcu.upload')); ?>" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-blue-500 transition cursor-pointer relative bg-white">
                                <?php echo csrf_field(); ?>
                                <input type="file" name="file_hasil_mcu" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png" onchange="validateFileSize(this, 5)">
                                <i class="fa-solid fa-cloud-arrow-up text-slate-400 text-3xl mb-2"></i>
                                <p class="text-xs font-semibold text-slate-600">
                                    <?php echo e(($mcu && $mcu->file_hasil_mcu) ? 'Klik atau seret berkas hasil MCU baru untuk mengunggah ulang (menggantikan berkas lama)' : 'Klik atau seret berkas PDF hasil pemeriksaan MCU untuk diunggah'); ?>

                                </p>
                                <p class="text-[10px] text-slate-400 mt-1">Format: PDF, JPG, PNG &bull; Ukuran Maksimal: <strong class="text-slate-600">5 MB</strong></p>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TAHAP 3: DIKLAT -->
            <?php if($tahapAktif == 3): ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 3: Jadwal Diklat Offline Pemalang</h3>
                        <p class="text-xs text-slate-500 mt-1">Calon ABK wajib mengikuti pelatihan fisik, mental, dan kedisiplinan berlayar selama 7 hari di Pemalang sesuai jadwal kelompok batch Anda.</p>
                    </div>

                    <?php
                        $diklat = $user->diklat->sortByDesc('created_at')->first();
                    ?>

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                            <span class="text-sm font-semibold text-slate-900">Status Diklat</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                                <?php echo e($diklat && $diklat->status === 'Terjadwal' ? 'bg-cyan-100 text-cyan-800' : ''); ?>

                                <?php echo e($diklat && $diklat->status === 'Sedang Mengikuti Diklat' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                <?php echo e($diklat && $diklat->status === 'Lulus Diklat' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                <?php echo e($diklat && $diklat->status === 'Tidak Lulus Diklat' ? 'bg-red-100 text-red-800' : ''); ?>

                                <?php echo e(!$diklat || $diklat->status === 'Menunggu Jadwal Diklat' ? 'bg-slate-100 text-slate-600' : ''); ?>

                            ">
                                <?php echo e($diklat ? $diklat->status : 'Menunggu Jadwal Diklat'); ?>

                            </span>
                        </div>

                        <?php if($diklat && $diklat->tanggal_mulai): ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Batch Kelompok</span>
                                    <strong class="text-slate-900"><?php echo e($diklat->batch ?: 'N/A'); ?></strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Lokasi Diklat</span>
                                    <strong class="text-slate-900"><?php echo e($diklat->lokasi); ?></strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Tanggal Mulai</span>
                                    <strong class="text-slate-900"><?php echo e($diklat->tanggal_mulai->format('d F Y')); ?></strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Tanggal Selesai</span>
                                    <strong class="text-slate-900"><?php echo e($diklat->tanggal_selesai->format('d F Y')); ?></strong>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-6">
                                <i class="fa-solid fa-calendar-clock text-slate-400 text-3xl mb-2"></i>
                                <p class="text-xs font-semibold text-slate-600">Menunggu Penjadwalan oleh Operator</p>
                                <p class="text-[10px] text-slate-400 mt-1">Jadwal batch biasanya diterbitkan 2-3 hari kerja setelah Anda dinyatakan lulus tes MCU.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TAHAP 4: PENGURUSAN DOKUMEN PELAUT -->
            <?php if($tahapAktif == 4): ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 4: Pengurusan & Unggah Bukti Dokumen Pelaut</h3>
                        <p class="text-xs text-slate-500 mt-1">Lulus Diklat! Lakukan pembuatan berkas berlayar internasional (Paspor, BST, dan Buku Pelaut) secara mandiri, kemudian daftarkan buktinya di bawah ini.</p>
                    </div>

                    <?php
                        $pDocs = ['paspor' => 'Paspor RI', 'bst' => 'Sertifikat BST (Basic Safety Training)', 'buku_pelaut' => 'Buku Pelaut (Seaman Book)'];
                    ?>

                    <div class="space-y-4">
                        <?php $__currentLoopData = $pDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $doc = $user->dokumenPelaut->where('jenis_dokumen', $type)->first();
                            ?>
                            <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50 space-y-4">
                                <div class="flex justify-between items-center">
                                    <h5 class="text-sm font-semibold text-slate-900"><?php echo e($label); ?></h5>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                        <?php echo e($doc && $doc->status_verifikasi === 'Disetujui' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                        <?php echo e($doc && $doc->status_verifikasi === 'Menunggu Verifikasi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                        <?php echo e($doc && $doc->status_verifikasi === 'Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                                        <?php echo e(!$doc || $doc->status_verifikasi === 'Menunggu Pengurusan Dokumen' ? 'bg-slate-200 text-slate-600' : ''); ?>

                                    ">
                                        <?php echo e($doc ? $doc->status_verifikasi : 'Menunggu Pengurusan Dokumen'); ?>

                                    </span>
                                </div>

                                <?php if($doc && $doc->file_path): ?>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-xs text-slate-700 bg-white p-3 rounded-lg border">
                                        <div><strong>No Dokumen:</strong> <?php echo e($doc->nomor_dokumen); ?></div>
                                        <div><strong>Tgl Terbit:</strong> <?php echo e($doc->tanggal_terbit ? $doc->tanggal_terbit->format('d-m-Y') : '-'); ?></div>
                                        <div><strong>Expired:</strong> <?php echo e($doc->tanggal_expired ? $doc->tanggal_expired->format('d-m-Y') : '-'); ?></div>
                                        <div class="md:col-span-3 mt-2">
                                            <a href="<?php echo e(asset('storage/' . $doc->file_path)); ?>" target="_blank" class="text-blue-600 hover:underline font-semibold"><i class="fa-solid fa-file-pdf mr-1"></i> Lihat Berkas</a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(!$doc || in_array($doc->status_verifikasi, ['Menunggu Pengurusan Dokumen', 'Menunggu Verifikasi', 'Ditolak'])): ?>
                                    <form action="<?php echo e(route('dokumen_pelaut.upload')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded-xl border border-slate-200">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="jenis_dokumen" value="<?php echo e($type); ?>">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Nomor Dokumen</label>
                                                <input type="text" name="nomor_dokumen" required value="<?php echo e(old('nomor_dokumen', $doc ? $doc->nomor_dokumen : '')); ?>" placeholder="Contoh: B123456" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tanggal Terbit</label>
                                                <input type="date" name="tanggal_terbit" required value="<?php echo e(old('tanggal_terbit', $doc && $doc->tanggal_terbit ? $doc->tanggal_terbit->format('Y-m-d') : '')); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tanggal Kadaluarsa</label>
                                                <input type="date" name="tanggal_expired" required value="<?php echo e(old('tanggal_expired', $doc && $doc->tanggal_expired ? $doc->tanggal_expired->format('Y-m-d') : '')); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-blue-500">
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
                                            <?php echo e($doc && $doc->file_path ? 'Unggah Ulang Dokumen' : 'Simpan Dokumen'); ?>

                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TAHAP 5: WAITING LIST & JOB PENEMPATAN -->
            <?php if($tahapAktif == 5): ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 5: Daftar Tunggu (Waiting List) Job Order</h3>
                        <p class="text-xs text-slate-500 mt-1">Dokumen dan kompetensi Anda telah lengkap. Anda terdaftar di waiting list penempatan. Operator kami sedang memproses pencocokan dengan pemberi kerja kapal asing.</p>
                    </div>

                    <?php
                        $job = $user->jobOrders->first();
                    ?>

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 text-center py-8">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-3xl mx-auto mb-4">
                            <i class="fa-solid fa-anchor"></i>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">Status Penempatan Kapal</h4>
                        <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full uppercase mt-2">
                            <?php echo e($job ? $job->status_job : 'Waiting List'); ?>

                        </span>
                        
                        <?php if($job && $job->nama_kapal): ?>
                            <div class="mt-6 max-w-md mx-auto bg-white p-4 rounded-xl border space-y-3 text-sm text-left">
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-slate-500">Kapal Penempatan:</span>
                                    <strong class="text-slate-900"><?php echo e($job->nama_kapal); ?></strong>
                                </div>
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-slate-500">Negara Tujuan:</span>
                                    <strong class="text-slate-900"><?php echo e($job->negara_tujuan); ?></strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Posisi Tugas:</span>
                                    <strong class="text-slate-900"><?php echo e($job->posisi); ?></strong>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-xs text-slate-500 mt-4 max-w-sm mx-auto">Kami akan segera memberi tahu Anda melalui email dan notifikasi sistem begitu Anda terpilih oleh perusahaan pelayaran.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TAHAP 6: KEBERANGKATAN -->
            <?php if($tahapAktif == 6): ?>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Tahap 6: Detail Keberangkatan Penerbangan</h3>
                        <p class="text-xs text-slate-500 mt-1">Selamat! Tiket pesawat dan visa Anda sedang disiapkan. Periksa jadwal penerbangan Anda secara berkala di bawah ini.</p>
                    </div>

                    <?php
                        $flight = $user->keberangkatan->first();
                    ?>

                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-4">
                        <div class="flex justify-between items-center border-b pb-3">
                            <span class="text-sm font-semibold text-slate-900">Status Keberangkatan</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                <?php echo e($flight && $flight->status === 'Tiket Diproses' ? 'bg-slate-200 text-slate-700' : ''); ?>

                                <?php echo e($flight && $flight->status === 'Jadwal Terbit' ? 'bg-cyan-100 text-cyan-800' : ''); ?>

                                <?php echo e($flight && $flight->status === 'Berangkat' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                <?php echo e($flight && $flight->status === 'On Board' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                <?php echo e(!$flight ? 'bg-slate-100 text-slate-500' : ''); ?>

                            ">
                                <?php echo e($flight ? $flight->status : 'Tiket Diproses'); ?>

                            </span>
                        </div>

                        <?php if($flight && $flight->maskapai): ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-slate-700">
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Maskapai / Maskapai Penerbangan</span>
                                    <strong class="text-slate-900"><?php echo e($flight->maskapai); ?></strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Nomor Penerbangan</span>
                                    <strong class="text-slate-900"><?php echo e($flight->nomor_penerbangan); ?></strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Negara Pelabuhan Tujuan</span>
                                    <strong class="text-slate-900"><?php echo e($flight->negara_tujuan); ?></strong>
                                </div>
                                <div>
                                    <span class="text-xs font-semibold text-slate-400 block uppercase">Tanggal Terbang (Keberangkatan)</span>
                                    <strong class="text-slate-900"><?php echo e($flight->tanggal_berangkat ? $flight->tanggal_berangkat->format('d F Y, H:i') : '-'); ?> WIB</strong>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-8">
                                <i class="fa-solid fa-ticket-airline text-slate-400 text-4xl mb-2"></i>
                                <p class="text-xs font-semibold text-slate-600">Tiket Sedang Diproses</p>
                                <p class="text-[10px] text-slate-400 mt-1">Dokumen visa dan tiket penerbangan grup sedang dalam pemrosesan administrasi.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <!-- Right Panel: Profile Form & System Notifications -->
        <div class="lg:col-span-4 space-y-8">
            
            <!-- Complete Profile Form -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Profil Calon ABK</h3>
                    <p class="text-xs text-slate-500">Lengkapi biodata pribadi Anda untuk validasi data kapal</p>
                </div>

                <?php
                    $profile = $user->profilAbk;
                ?>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Profile Photo Display/Upload -->
                    <div class="flex items-center space-x-4">
                        <?php
                            $photoUrl = ($profile && $profile->foto_profil) ? asset('storage/' . $profile->foto_profil) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop';
                        ?>
                        <img class="h-16 w-16 rounded-full object-cover ring-2 ring-blue-500/20" src="<?php echo e($photoUrl); ?>" alt="Foto">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Foto Profil (3x4)</label>
                            <input type="file" name="foto_profil" accept=".jpg,.jpeg,.png" onchange="validateFileSize(this, 5)" class="text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required value="<?php echo e(old('nama_lengkap', $profile ? $profile->nama_lengkap : $user->name)); ?>" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="<?php echo e(old('tempat_lahir', $profile ? $profile->tempat_lahir : '')); ?>" placeholder="Pemalang" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Hari</label>
                            <?php
                                $tgl = ($profile && $profile->tanggal_lahir) ? $profile->tanggal_lahir->format('d') : '';
                            ?>
                            <select name="tanggal_lahir_hari" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">Tgl</option>
                                <?php for($d = 1; $d <= 31; $d++): ?>
                                    <option value="<?php echo e(str_pad($d, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e($tgl == str_pad($d, 2, '0', STR_PAD_LEFT) ? 'selected' : ''); ?>><?php echo e($d); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Bulan</label>
                            <?php
                                $bln = ($profile && $profile->tanggal_lahir) ? (int)$profile->tanggal_lahir->format('m') : 0;
                                $bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                            ?>
                            <select name="tanggal_lahir_bulan" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">Bulan</option>
                                <?php $__currentLoopData = $bulanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $namaBulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(str_pad($i+1, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e($bln == ($i+1) ? 'selected' : ''); ?>><?php echo e($namaBulan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Tahun</label>
                            <?php
                                $thn = ($profile && $profile->tanggal_lahir) ? $profile->tanggal_lahir->format('Y') : '';
                            ?>
                            <select name="tanggal_lahir_tahun" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">Tahun</option>
                                <?php for($y = date('Y') - 17; $y >= 1970; $y--): ?>
                                    <option value="<?php echo e($y); ?>" <?php echo e($thn == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Nomor HP / WhatsApp</label>
                        <input type="text" name="nomor_hp" value="<?php echo e(old('nomor_hp', $profile ? $profile->nomor_hp : '')); ?>" placeholder="0812345..." class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Negara Kapal</label>
                            <select name="negara_kapal" id="negara_kapal" onchange="updateJenisKapal()" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih Negara --</option>
                                <option value="China" <?php echo e(($profile && $profile->posisi_dilamar && str_contains($profile->posisi_dilamar, 'China')) ? 'selected' : ''); ?>>China</option>
                                <option value="Taiwan" <?php echo e(($profile && $profile->posisi_dilamar && str_contains($profile->posisi_dilamar, 'Taiwan')) ? 'selected' : ''); ?>>Taiwan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Jenis Kapal</label>
                            <select name="posisi_dilamar" id="jenis_kapal" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                                <option value="">-- Pilih Jenis Kapal --</option>
                                <option value="China - Cumi" <?php echo e(($profile && $profile->posisi_dilamar == 'China - Cumi') ? 'selected' : ''); ?>>1. Cumi</option>
                                <option value="China - Purshine" <?php echo e(($profile && $profile->posisi_dilamar == 'China - Purshine') ? 'selected' : ''); ?>>2. Purshine</option>
                                <option value="China - Trawl" <?php echo e(($profile && $profile->posisi_dilamar == 'China - Trawl') ? 'selected' : ''); ?>>3. Trawl</option>
                                <option value="China - Longline" <?php echo e(($profile && $profile->posisi_dilamar == 'China - Longline') ? 'selected' : ''); ?>>4. Longline</option>
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
                        <textarea name="alamat" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500"><?php echo e(old('alamat', $profile ? $profile->alamat : '')); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-1">Riwayat Pengalaman Kerja</label>
                        <textarea name="pengalaman_kerja" rows="2" placeholder="Tuliskan pengalaman berlayar atau pekerjaan sebelumnya" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-blue-500"><?php echo e(old('pengalaman_kerja', $profile ? $profile->pengalaman_kerja : '')); ?></textarea>
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
                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-3 rounded-lg border text-xs space-y-1 <?php echo e($notif->status_baca ? 'bg-slate-50/50 border-slate-100' : 'bg-blue-50/20 border-blue-100'); ?>">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-slate-800"><?php echo e($notif->judul); ?></span>
                                <?php if(!$notif->status_baca): ?>
                                    <form action="<?php echo e(route('notification.read', $notif->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="text-[9px] font-semibold text-blue-600 hover:underline">Tandai Baca</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <p class="text-slate-600 leading-relaxed"><?php echo e($notif->pesan); ?></p>
                            <span class="text-[9px] text-slate-400 block pt-1"><?php echo e($notif->created_at->diffForHumans()); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-4 text-xs text-slate-400 italic">Tidak ada notifikasi baru</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>

</div>
<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/dashboard/abk.blade.php ENDPATH**/ ?>