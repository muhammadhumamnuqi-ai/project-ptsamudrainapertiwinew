<?php $__env->startSection('page_title', 'Detail Calon ABK'); ?>
<?php $__env->startSection('page_subtitle', 'Folder lengkap seleksi, verifikasi berkas, MCU, Diklat, dan keberangkatan'); ?>

<?php $__env->startSection('page_actions'); ?>
<a href="<?php echo e(route('dashboard.operator')); ?>" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $tahapLabel = [1=>'Administrasi & Berkas',2=>'Medical Check-Up',3=>'Diklat Offline',4=>'Dokumen Pelaut',5=>'Waiting List Job',6=>'Keberangkatan'];
    $profile = $candidate->profilAbk;
    $latestMcu = $candidate->medicalCheckups->sortByDesc('created_at')->first();
    $latestDiklat = $candidate->diklat->sortByDesc('created_at')->first();
    $job = $candidate->jobOrders->first();
    $flight = $candidate->keberangkatan->first();
?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    
    <div class="lg:col-span-4 space-y-6">

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="h-24 bg-gradient-to-r from-slate-900 to-blue-900"></div>
            <div class="px-6 pb-6 -mt-10">
                <?php
                    $photo = ($profile && $profile->foto_profil) ? asset('storage/'.$profile->foto_profil) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop';
                ?>
                <img src="<?php echo e($photo); ?>" class="h-20 w-20 rounded-2xl object-cover ring-4 ring-white shadow-lg" alt="Foto">
                <div class="mt-4 space-y-1">
                    <h2 class="text-xl font-extrabold text-slate-900"><?php echo e($profile ? $profile->nama_lengkap : $candidate->name); ?></h2>
                    <p class="text-sm text-slate-500"><?php echo e($candidate->email); ?></p>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 uppercase">
                        <?php echo e($candidate->role); ?>

                    </span>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold <?php echo e($candidate->status_akun === 'aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'); ?> uppercase ml-1">
                        <?php echo e($candidate->status_akun); ?>

                    </span>
                </div>

                <?php if($profile): ?>
                <div class="mt-5 space-y-2.5 text-sm border-t border-slate-100 pt-4">
                    <div class="flex justify-between">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Tempat, Tgl Lahir</span>
                        <span class="text-slate-800 font-medium text-xs text-right"><?php echo e($profile->tempat_lahir); ?>, <?php echo e($profile->tanggal_lahir ? $profile->tanggal_lahir->format('d-m-Y') : '-'); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400 text-xs font-semibold uppercase">No. HP</span>
                        <span class="text-slate-800 font-medium text-xs"><?php echo e($profile->nomor_hp ?: '-'); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Posisi Dilamar</span>
                        <span class="text-slate-800 font-semibold text-xs"><?php echo e($profile->posisi_dilamar ?: '-'); ?></span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-slate-400 text-xs font-semibold uppercase flex-shrink-0">Alamat</span>
                        <span class="text-slate-800 font-medium text-xs text-right ml-4"><?php echo e($profile->alamat ?: '-'); ?></span>
                    </div>
                    <div class="pt-2 border-t border-slate-100">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Pengalaman Kerja</span>
                        <p class="text-xs text-slate-700 mt-1 leading-relaxed"><?php echo e($profile->pengalaman_kerja ?: 'Belum berpengalaman'); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Progres Tahapan Rekrutmen</h3>
            <div class="space-y-2">
                <?php for($i=1;$i<=6;$i++): ?>
                <div class="flex items-center space-x-3">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                        <?php echo e($i < $currentStage ? 'bg-emerald-500 text-white' : ''); ?>

                        <?php echo e($i == $currentStage ? 'bg-blue-600 text-white ring-2 ring-blue-200' : ''); ?>

                        <?php echo e($i > $currentStage ? 'bg-slate-100 text-slate-400' : ''); ?>

                    ">
                        <?php if($i < $currentStage): ?>
                            <i class="fa-solid fa-check text-[10px]"></i>
                        <?php else: ?>
                            <?php echo e($i); ?>

                        <?php endif; ?>
                    </div>
                    <span class="text-xs font-medium <?php echo e($i==$currentStage ? 'text-blue-700 font-bold' : ($i<$currentStage ? 'text-emerald-700' : 'text-slate-400')); ?>">
                        <?php echo e($tahapLabel[$i]); ?>

                    </span>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-bold text-slate-900 mb-4">Update Progres Rekrutmen</h3>
            <form action="<?php echo e(route('operator.abk.update_stage', $candidate->id)); ?>" method="POST" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Tahap</label>
                    <select name="tahap" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        <?php for($i=1;$i<=6;$i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e($currentStage==$i?'selected':''); ?>>Tahap <?php echo e($i); ?> – <?php echo e($tahapLabel[$i]); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Status</label>
                    <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        <option>Dalam Proses</option>
                        <option>Terjadwal</option>
                        <option>Revisi</option>
                        <option>Pending</option>
                        <option>Ditolak</option>
                        <option>Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Catatan Operator</label>
                    <textarea name="catatan" rows="3" placeholder="Tuliskan catatan atau instruksi..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white py-2.5 rounded-xl text-xs font-bold transition">Simpan Perubahan Tahap</button>
            </form>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
            <h3 class="text-sm font-bold text-slate-900 mb-3">Riwayat Aktivitas</h3>
            <div class="space-y-3 max-h-56 overflow-y-auto">
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-start space-x-2 text-xs">
                    <i class="fa-solid fa-circle-dot text-blue-500 mt-1 flex-shrink-0 text-[8px]"></i>
                    <div>
                        <p class="text-slate-700 leading-relaxed"><?php echo e($log->aktivitas); ?></p>
                        <span class="text-[10px] text-slate-400"><?php echo e($log->created_at->diffForHumans()); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-xs text-slate-400 italic">Belum ada riwayat aktivitas</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    
    <div class="lg:col-span-8 space-y-6">

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-900 flex items-center">
                    <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">1</span>
                    Verifikasi Berkas Administrasi
                </h3>
                <?php
                    $approved5 = $candidate->dokumen->whereIn('jenis_dokumen',['ktp','kartu_keluarga','skck','akta_kelahiran','ijazah'])->where('status','Disetujui')->count();
                ?>
                <span class="text-xs font-bold <?php echo e($approved5==5 ? 'text-emerald-700' : 'text-amber-700'); ?>">
                    <?php echo e($approved5); ?>/5 Disetujui
                </span>
            </div>

            <?php
                $docMeta = ['ktp'=>'KTP','kartu_keluarga'=>'Kartu Keluarga','skck'=>'SKCK','akta_kelahiran'=>'Akta Kelahiran','ijazah'=>'Ijazah Terakhir'];
            ?>

            <div class="divide-y divide-slate-50">
                <?php $__currentLoopData = $docMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $doc = $candidate->dokumen->where('jenis_dokumen',$type)->first(); ?>
                <div class="px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="space-y-1">
                        <h5 class="text-sm font-semibold text-slate-900"><?php echo e($label); ?></h5>
                        <?php if($doc): ?>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                <?php echo e($doc->status==='Disetujui' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                <?php echo e($doc->status==='Menunggu Verifikasi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                <?php echo e($doc->status==='Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                            "><?php echo e($doc->status); ?></span>
                            <a href="<?php echo e(asset('storage/'.$doc->file_path)); ?>" target="_blank" class="text-xs text-blue-600 hover:underline"><i class="fa-solid fa-file-pdf mr-1"></i>Lihat Berkas</a>
                        </div>
                        <?php if($doc->catatan_operator): ?><p class="text-xs text-red-600 bg-red-50 px-2 py-1 rounded mt-1">Catatan: <?php echo e($doc->catatan_operator); ?></p><?php endif; ?>
                        <?php else: ?>
                        <span class="text-xs text-slate-400 italic">Belum diunggah oleh kandidat</span>
                        <?php endif; ?>
                    </div>
                    <?php if($doc && $doc->status === 'Menunggu Verifikasi'): ?>
                    <form action="<?php echo e(route('operator.dokumen.verify', $doc->id)); ?>" method="POST" class="flex items-center space-x-2 flex-shrink-0">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="status" id="status_<?php echo e($doc->id); ?>">
                        <input type="text" name="catatan_operator" placeholder="Catatan revisi (jika ditolak)" class="bg-slate-50 border border-slate-200 rounded-lg px-2 py-1.5 text-xs w-36 focus:outline-none focus:border-blue-500">
                        <button type="submit" onclick="document.getElementById('status_<?php echo e($doc->id); ?>').value='Disetujui'" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">✓ Setujui</button>
                        <button type="submit" onclick="document.getElementById('status_<?php echo e($doc->id); ?>').value='Ditolak'" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">✕ Tolak</button>
                    </form>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-900 flex items-center">
                    <span class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">2</span>
                    Verifikasi Medical Check-Up (MCU)
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <?php if($latestMcu): ?>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase
                        <?php echo e($latestMcu->status_mcu==='Lulus MCU' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                        <?php echo e($latestMcu->status_mcu==='Menunggu Verifikasi MCU' ? 'bg-amber-100 text-amber-800' : ''); ?>

                        <?php echo e($latestMcu->status_mcu==='Pending MCU' ? 'bg-purple-100 text-purple-800' : ''); ?>

                        <?php echo e($latestMcu->status_mcu==='Tidak Lulus MCU' ? 'bg-red-100 text-red-800' : ''); ?>

                        <?php echo e($latestMcu->status_mcu==='Menunggu Upload Hasil MCU' ? 'bg-slate-100 text-slate-600' : ''); ?>

                    "><?php echo e($latestMcu->status_mcu); ?></span>
                    <?php if($latestMcu->file_hasil_mcu): ?>
                    <a href="<?php echo e(asset('storage/'.$latestMcu->file_hasil_mcu)); ?>" target="_blank" class="text-xs text-blue-600 hover:underline font-semibold"><i class="fa-solid fa-file-pdf mr-1"></i>Lihat Hasil MCU</a>
                    <span class="text-xs text-slate-400">Diunggah: <?php echo e($latestMcu->tanggal_upload ? $latestMcu->tanggal_upload->format('d-m-Y H:i') : '-'); ?></span>
                    <?php endif; ?>
                </div>
                <?php if($latestMcu->catatan_operator): ?><div class="text-xs bg-slate-50 p-3 rounded-lg border"><strong>Catatan Operator:</strong> <?php echo e($latestMcu->catatan_operator); ?></div><?php endif; ?>

                <?php if($latestMcu->status_mcu === 'Menunggu Verifikasi MCU'): ?>
                <form action="<?php echo e(route('operator.mcu.verify', $latestMcu->id)); ?>" method="POST" class="space-y-3 pt-2 border-t border-slate-100">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Keputusan MCU</label>
                        <select name="status_mcu" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                            <option>Lulus MCU</option>
                            <option>Pending MCU</option>
                            <option>Tidak Lulus MCU</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Catatan Operator</label>
                        <textarea name="catatan_operator" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Simpan Keputusan MCU</button>
                </form>
                <?php endif; ?>
                <?php else: ?>
                <p class="text-xs text-slate-400 italic">Kandidat belum mengunggah hasil MCU</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-900 flex items-center">
                    <span class="w-6 h-6 bg-cyan-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">3</span>
                    Manajemen Diklat
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <?php if($latestDiklat): ?>
                <div class="flex flex-wrap items-center gap-3 pb-4 border-b border-slate-100">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase
                        <?php echo e($latestDiklat->status==='Lulus Diklat'?'bg-emerald-100 text-emerald-800':''); ?>

                        <?php echo e($latestDiklat->status==='Terjadwal'?'bg-cyan-100 text-cyan-800':''); ?>

                        <?php echo e($latestDiklat->status==='Sedang Mengikuti Diklat'?'bg-blue-100 text-blue-800':''); ?>

                        <?php echo e($latestDiklat->status==='Menunggu Jadwal Diklat'?'bg-slate-100 text-slate-600':''); ?>

                        <?php echo e($latestDiklat->status==='Tidak Lulus Diklat'?'bg-red-100 text-red-800':''); ?>

                    "><?php echo e($latestDiklat->status); ?></span>
                    <?php if($latestDiklat->batch): ?><span class="text-xs text-slate-600 font-semibold"><?php echo e($latestDiklat->batch); ?> | <?php echo e($latestDiklat->lokasi); ?></span><?php endif; ?>
                </div>

                
                <?php if(in_array($latestDiklat->status, ['Menunggu Jadwal Diklat'])): ?>
                <div>
                    <h4 class="text-xs font-bold text-slate-700 mb-3">Atur Jadwal Diklat</h4>
                    <form action="<?php echo e(route('operator.diklat.schedule', $latestDiklat->id)); ?>" method="POST" class="grid grid-cols-2 gap-3">
                        <?php echo csrf_field(); ?>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Batch</label>
                            <input type="text" name="batch" required placeholder="Contoh: Batch XIV" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Lokasi</label>
                            <input type="text" name="lokasi" required value="Balai Diklat Pemalang" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="col-span-2">
                            <button type="submit" class="bg-cyan-700 hover:bg-cyan-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Terbitkan Jadwal Diklat</button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>

                
                <?php if(in_array($latestDiklat->status, ['Terjadwal','Sedang Mengikuti Diklat'])): ?>
                <form action="<?php echo e(route('operator.diklat.verify', $latestDiklat->id)); ?>" method="POST" class="flex items-center space-x-3 pt-2">
                    <?php echo csrf_field(); ?>
                    <select name="status" class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                        <option>Sedang Mengikuti Diklat</option>
                        <option>Lulus Diklat</option>
                        <option>Tidak Lulus Diklat</option>
                    </select>
                    <button type="submit" class="bg-cyan-700 hover:bg-cyan-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Update Status Diklat</button>
                </form>
                <?php endif; ?>
                <?php else: ?>
                <p class="text-xs text-slate-400 italic">Kandidat belum mencapai tahap Diklat (belum lulus MCU)</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-900 flex items-center">
                    <span class="w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">4</span>
                    Verifikasi Dokumen Pelaut
                </h3>
            </div>
            <div class="divide-y divide-slate-50">
                <?php $pTypes = ['paspor'=>'Paspor RI','bst'=>'BST Certificate','buku_pelaut'=>'Buku Pelaut']; ?>
                <?php $__currentLoopData = $pTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $pd = $candidate->dokumenPelaut->where('jenis_dokumen',$type)->first(); ?>
                <div class="px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="space-y-1">
                        <h5 class="text-sm font-semibold text-slate-900"><?php echo e($label); ?></h5>
                        <?php if($pd && $pd->file_path): ?>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                <?php echo e($pd->status_verifikasi==='Disetujui' ? 'bg-emerald-100 text-emerald-800' : ''); ?>

                                <?php echo e($pd->status_verifikasi==='Menunggu Verifikasi' ? 'bg-amber-100 text-amber-800' : ''); ?>

                                <?php echo e($pd->status_verifikasi==='Ditolak' ? 'bg-red-100 text-red-800' : ''); ?>

                                <?php echo e($pd->status_verifikasi==='Menunggu Pengurusan Dokumen' ? 'bg-slate-100 text-slate-600' : ''); ?>

                            "><?php echo e($pd->status_verifikasi); ?></span>
                            <span class="text-xs text-slate-500">No: <?php echo e($pd->nomor_dokumen); ?></span>
                            <span class="text-xs text-slate-500">Exp: <?php echo e($pd->tanggal_expired ? $pd->tanggal_expired->format('d-m-Y') : '-'); ?></span>
                            <a href="<?php echo e(asset('storage/'.$pd->file_path)); ?>" target="_blank" class="text-xs text-blue-600 hover:underline font-semibold"><i class="fa-solid fa-file-pdf mr-1"></i>Lihat</a>
                        </div>
                        <?php else: ?>
                        <span class="text-xs text-slate-400 italic">Belum diunggah</span>
                        <?php endif; ?>
                    </div>
                    <?php if($pd && $pd->status_verifikasi === 'Menunggu Verifikasi'): ?>
                    <form action="<?php echo e(route('operator.dokumen_pelaut.verify', $pd->id)); ?>" method="POST" class="flex items-center space-x-2 flex-shrink-0">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="status_verifikasi" id="pdstatus_<?php echo e($pd->id); ?>">
                        <button type="submit" onclick="document.getElementById('pdstatus_<?php echo e($pd->id); ?>').value='Disetujui'" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">✓ Setujui</button>
                        <button type="submit" onclick="document.getElementById('pdstatus_<?php echo e($pd->id); ?>').value='Ditolak'" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">✕ Tolak</button>
                    </form>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-900 flex items-center">
                    <span class="w-6 h-6 bg-amber-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">5</span>
                    Job Order – Penempatan Kapal
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <?php if($job): ?>
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase bg-amber-100 text-amber-800"><?php echo e($job->status_job); ?></span>
                    <?php if($job->nama_kapal): ?><span class="text-xs text-slate-600 font-medium">Kapal: <?php echo e($job->nama_kapal); ?></span><?php endif; ?>
                    <?php if($job->negara_tujuan): ?><span class="text-xs text-slate-600 font-medium">Negara: <?php echo e($job->negara_tujuan); ?></span><?php endif; ?>
                </div>
                <form action="<?php echo e(route('operator.job.assign', $job->id)); ?>" method="POST" class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-100">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Nama Kapal</label>
                        <input type="text" name="nama_kapal" value="<?php echo e($job->nama_kapal); ?>" required placeholder="MV Fortune" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Negara Tujuan</label>
                        <input type="text" name="negara_tujuan" value="<?php echo e($job->negara_tujuan); ?>" required placeholder="Jepang" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Posisi / Jabatan</label>
                        <input type="text" name="posisi" value="<?php echo e($job->posisi); ?>" required placeholder="Deckhand" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Status Job</label>
                        <select name="status_job" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                            <option <?php echo e($job->status_job==='Waiting List'?'selected':''); ?>>Waiting List</option>
                            <option <?php echo e($job->status_job==='Job Tersedia'?'selected':''); ?>>Job Tersedia</option>
                            <option <?php echo e($job->status_job==='Dipilih untuk Job'?'selected':''); ?>>Dipilih untuk Job</option>
                            <option <?php echo e($job->status_job==='Persiapan Keberangkatan'?'selected':''); ?>>Persiapan Keberangkatan</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Simpan Job Order</button>
                    </div>
                </form>
                <?php else: ?>
                <p class="text-xs text-slate-400 italic">Kandidat belum memasuki tahap Waiting List</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-bold text-slate-900 flex items-center">
                    <span class="w-6 h-6 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">6</span>
                    Informasi Keberangkatan
                </h3>
            </div>
            <div class="p-6">
                <?php if($flight): ?>
                <form action="<?php echo e(route('operator.keberangkatan.save', $flight->id)); ?>" method="POST" class="grid grid-cols-2 gap-3">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Maskapai Penerbangan</label>
                        <input type="text" name="maskapai" value="<?php echo e($flight->maskapai); ?>" required placeholder="Garuda Indonesia" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Nomor Penerbangan</label>
                        <input type="text" name="nomor_penerbangan" value="<?php echo e($flight->nomor_penerbangan); ?>" required placeholder="GA-401" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Tanggal & Jam Terbang</label>
                        <input type="datetime-local" name="tanggal_berangkat" value="<?php echo e($flight->tanggal_berangkat ? $flight->tanggal_berangkat->format('Y-m-d\TH:i') : ''); ?>" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Negara Tujuan</label>
                        <input type="text" name="negara_tujuan" value="<?php echo e($flight->negara_tujuan); ?>" required placeholder="Jepang" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Status Keberangkatan</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                            <option <?php echo e($flight->status==='Tiket Diproses'?'selected':''); ?>>Tiket Diproses</option>
                            <option <?php echo e($flight->status==='Jadwal Terbit'?'selected':''); ?>>Jadwal Terbit</option>
                            <option <?php echo e($flight->status==='Berangkat'?'selected':''); ?>>Berangkat</option>
                            <option <?php echo e($flight->status==='On Board'?'selected':''); ?>>On Board</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Simpan Info Keberangkatan</button>
                    </div>
                </form>
                <?php else: ?>
                <p class="text-xs text-slate-400 italic">Kandidat belum memasuki tahap keberangkatan</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/operator/abk_detail.blade.php ENDPATH**/ ?>