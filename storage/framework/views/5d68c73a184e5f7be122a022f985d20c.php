<?php $__env->startSection('page_title', 'Manajemen Pengguna'); ?>
<?php $__env->startSection('page_subtitle', 'Kelola akun super admin, operator, dan calon ABK'); ?>

<?php $__env->startSection('page_actions'); ?>
<a href="<?php echo e(route('admin.users.create')); ?>" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm shadow-lg shadow-blue-600/30 transition">
    <i class="fa-solid fa-user-plus mr-2"></i> Tambah Pengguna
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    
    <div class="p-6 border-b border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-4 bg-slate-50/50">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Filter Role</label>
            <select id="roleFilter" onchange="filterUsers()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                <option value="">Semua Role</option>
                <option value="super_admin">Super Admin</option>
                <option value="operator">Operator</option>
                <option value="abk">Calon ABK</option>
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Filter Status</label>
            <select id="statusFilter" onchange="filterUsers()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Non-Aktif</option>
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Cari Pengguna</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 text-xs pointer-events-none"><i class="fa-solid fa-magnifying-glass"></i></div>
                <input id="userSearch" onkeyup="filterUsers()" type="text" placeholder="Nama atau email..." class="w-full pl-8 pr-3 py-2 bg-white border border-slate-300 rounded-xl text-xs focus:outline-none focus:border-blue-500">
            </div>
        </div>
    </div>

    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase">Pengguna</th>
                    <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase">Role</th>
                    <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase">Status Akun</th>
                    <th class="px-6 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase">Terdaftar</th>
                    <th class="px-6 py-3.5 text-center text-[10px] font-bold text-slate-400 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="usersTableBody" class="divide-y divide-slate-100 bg-white">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $roleColor = ['super_admin'=>'bg-violet-100 text-violet-800','operator'=>'bg-blue-100 text-blue-800','abk'=>'bg-emerald-100 text-emerald-800'];
                    $roleLabel = ['super_admin'=>'Super Admin','operator'=>'Operator','abk'=>'Calon ABK'];
                ?>
                <tr class="user-row hover:bg-slate-50/50 transition" data-role="<?php echo e($u->role); ?>" data-status="<?php echo e($u->status_akun); ?>">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-slate-800 to-slate-700 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                <?php echo e(strtoupper(substr($u->name, 0, 2))); ?>

                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-bold text-slate-900 user-name"><?php echo e($u->name); ?></div>
                                <div class="text-xs text-slate-400"><?php echo e($u->email); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase <?php echo e($roleColor[$u->role] ?? 'bg-slate-100 text-slate-600'); ?>">
                            <?php echo e($roleLabel[$u->role] ?? $u->role); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase <?php echo e($u->status_akun==='aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo e($u->status_akun); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                        <?php echo e($u->created_at->format('d M Y')); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="<?php echo e(route('admin.users.edit', $u->id)); ?>" class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                <i class="fa-solid fa-pen mr-1"></i>Edit
                            </a>
                            <?php if($u->id !== auth()->id()): ?>
                            <form action="<?php echo e(route('admin.users.destroy', $u->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                    <i class="fa-solid fa-trash mr-1"></i>Hapus
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-400 italic">Belum ada pengguna</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function filterUsers() {
    const roleVal = document.getElementById('roleFilter').value;
    const statusVal = document.getElementById('statusFilter').value;
    const searchVal = document.getElementById('userSearch').value.toLowerCase();
    document.querySelectorAll('.user-row').forEach(row => {
        const role = row.getAttribute('data-role');
        const status = row.getAttribute('data-status');
        const name = row.querySelector('.user-name').innerText.toLowerCase();
        const matchRole = !roleVal || role === roleVal;
        const matchStatus = !statusVal || status === statusVal;
        const matchSearch = !searchVal || name.includes(searchVal);
        row.style.display = (matchRole && matchStatus && matchSearch) ? '' : 'none';
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ptsamudrainapertiwi_sip\resources\views/admin/users_index.blade.php ENDPATH**/ ?>