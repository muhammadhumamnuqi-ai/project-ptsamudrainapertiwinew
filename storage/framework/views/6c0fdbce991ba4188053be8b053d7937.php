<?php $__env->startSection('page_title', 'Dashboard Operator'); ?>
<?php $__env->startSection('page_subtitle', 'Kelola pendaftaran, seleksi, diklat, verifikasi berkas, dan keberangkatan calon ABK'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 text-lg">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Total Calon ABK</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['total_abk']); ?></strong>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 text-lg">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Verifikasi Berkas</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['dokumen_pending']); ?></strong>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 text-lg">
                <i class="fa-solid fa-notes-medical"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Verifikasi MCU</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['mcu_pending']); ?></strong>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-lg">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Peserta Diklat</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['diklat_aktif']); ?></strong>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-lg">
                <i class="fa-solid fa-anchor"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Waiting List Job</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['waiting_list']); ?></strong>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 text-lg">
                <i class="fa-solid fa-ship"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">ABK On Board</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['abk_onboard']); ?></strong>
            </div>
        </div>

        <!-- Card 7 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-lg">
                <i class="fa-solid fa-square-check"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Berkas Disetujui</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['dokumen_approved']); ?></strong>
            </div>
        </div>

        <!-- Card 8 -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center space-x-4">
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 text-lg">
                <i class="fa-solid fa-square-xmark"></i>
            </div>
            <div>
                <span class="text-xs font-semibold text-slate-400 block uppercase">Berkas Ditolak</span>
                <strong class="text-xl sm:text-2xl font-bold text-slate-900"><?php echo e($stats['dokumen_rejected']); ?></strong>
            </div>
        </div>
    </div>

    <!-- Candidate List Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Table Header Actions -->
        <div class="p-6 border-b border-slate-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Daftar Calon ABK PT. SIP</h3>
                <p class="text-xs text-slate-500 mt-1">Gunakan filter di bawah untuk memilah berdasarkan tahapan rekrutmen</p>
            </div>
            
            <div class="flex items-center space-x-3">
                <a href="<?php echo e(route('reports.export.pdf')); ?>" target="_blank" class="bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition">
                    <i class="fa-solid fa-print mr-1"></i> Cetak Laporan PDF
                </a>
                <a href="<?php echo e(route('reports.export.csv')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-md transition">
                    <i class="fa-solid fa-file-excel mr-1"></i> Ekspor CSV/Excel
                </a>
            </div>
        </div>

        <!-- Live Filters -->
        <div class="p-6 border-b border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Filter Tahapan</label>
                <select id="stageFilter" onchange="filterCandidates()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    <option value="">Semua Tahapan</option>
                    <option value="1">Tahap 1 - Administrasi & Berkas</option>
                    <option value="2">Tahap 2 - Medical Check-Up</option>
                    <option value="3">Tahap 3 - Diklat Offline</option>
                    <option value="4">Tahap 4 - Dokumen Pelaut</option>
                    <option value="5">Tahap 5 - Waiting List Job</option>
                    <option value="6">Tahap 6 - Keberangkatan</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Cari Calon ABK</label>
                <div class="relative rounded-lg shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input id="tableSearch" onkeyup="filterCandidates()" type="text" placeholder="Masukkan nama atau email..." class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-xs focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Filter Posisi</label>
                <select id="posisiFilter" onchange="filterCandidates()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    <option value="">Semua Posisi</option>
                    <option value="Deckhand">Deckhand</option>
                    <option value="Oiler">Oiler</option>
                    <option value="Cook">Cook</option>
                    <option value="Bosun">Bosun</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-wider">Calon ABK</th>
                        <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-wider">No. HP & Kota</th>
                        <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-wider">Posisi Dilamar</th>
                        <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tahap Aktif</th>
                        <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Progres</th>
                        <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pendaftaran</th>
                        <th class="px-6 py-3.5 text-center text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tindakan</th>
                    </tr>
                </thead>
                <tbody id="candidateTableBody" class="divide-y divide-slate-100 bg-white">
                    <?php $__empty_1 = true; $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $profile = $candidate->profilAbk;
                            $tahapLabel = [
                                1 => 'Tahap 1 - Administrasi',
                                2 => 'Tahap 2 - MCU',
                                3 => 'Tahap 3 - Diklat',
                                4 => 'Tahap 4 - Berkas Pelaut',
                                5 => 'Tahap 5 - Waiting List',
                                6 => 'Tahap 6 - Keberangkatan'
                            ];
                        ?>
                        <tr class="candidate-row hover:bg-slate-50/50 transition-colors" data-stage="<?php echo e($candidate->current_tahap); ?>" data-posisi="<?php echo e($profile ? $profile->posisi_dilamar : ''); ?>">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <?php
                                        $photo = ($profile && $profile->foto_profil) ? asset('storage/' . $profile->foto_profil) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop';
                                    ?>
                                    <img class="h-10 w-10 rounded-full object-cover ring-2 ring-slate-100 flex-shrink-0" src="<?php echo e($photo); ?>" alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-slate-900 candidate-name"><?php echo e($profile ? $profile->nama_lengkap : $candidate->name); ?></div>
                                        <div class="text-xs text-slate-400"><?php echo e($candidate->email); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-800"><?php echo e($profile ? $profile->nomor_hp : '-'); ?></div>
                                <div class="text-xs text-slate-400"><?php echo e($profile ? $profile->tempat_lahir : '-'); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700">
                                    <?php echo e($profile ? $profile->posisi_dilamar : 'Belum Ditentukan'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-semibold text-slate-900">
                                <?php echo e($tahapLabel[$candidate->current_tahap] ?? 'Tahap ' . $candidate->current_tahap); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                                    <?php echo e($candidate->tahap_status === 'Selesai' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                    <?php echo e($candidate->tahap_status === 'Dalam Proses' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                    <?php echo e($candidate->tahap_status === 'Revisi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                    <?php echo e($candidate->tahap_status === 'Pending' ? 'bg-purple-100 text-purple-800' : ''); ?>

                                    <?php echo e($candidate->tahap_status === 'Terjadwal' ? 'bg-cyan-100 text-cyan-800' : ''); ?>

                                    <?php echo e($candidate->tahap_status === 'Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                                ">
                                    <?php echo e($candidate->tahap_status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                <?php echo e($candidate->created_at->format('d-m-Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="<?php echo e(route('operator.abk.show', $candidate->id)); ?>" class="inline-flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white font-semibold px-4 py-2 rounded-xl text-xs shadow-sm transition">
                                    <i class="fa-regular fa-folder-open mr-1.5"></i> Periksa Berkas
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-slate-400 italic">Belum ada calon ABK terdaftar</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    function filterCandidates() {
        const stageVal = document.getElementById('stageFilter').value;
        const posisiVal = document.getElementById('posisiFilter').value;
        const searchVal = document.getElementById('tableSearch').value.toLowerCase();
        
        const rows = document.querySelectorAll('.candidate-row');
        
        rows.forEach(row => {
            const stage = row.getAttribute('data-stage');
            const posisi = row.getAttribute('data-posisi');
            const nameAndEmail = row.querySelector('.candidate-name').innerText.toLowerCase() + ' ' + row.querySelector('.text-slate-400').innerText.toLowerCase();

            const matchesStage = stageVal === "" || stage === stageVal;
            const matchesPosisi = posisiVal === "" || posisi === posisiVal;
            const matchesSearch = searchVal === "" || nameAndEmail.includes(searchVal);

            if (matchesStage && matchesPosisi && matchesSearch) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/dashboard/operator.blade.php ENDPATH**/ ?>