<?php ($title = 'Master Data'); ?>
<?php ($subtitle = 'Kelola kategori kerusakan, lokasi, dan data pengguna'); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.partials.master-tabs', ['active' => 'user'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
        <h3 class="font-bold text-slate-800">Data Pengguna</h3>
        <div class="flex items-center gap-2">
            <form method="GET">
                <select name="role" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                    <option value="">Semua role</option>
                    <option value="admin" <?php if(request('role') === 'admin'): echo 'selected'; endif; ?>>Admin</option>
                    <option value="siswa" <?php if(request('role') === 'siswa'): echo 'selected'; endif; ?>>Siswa</option>
                    <option value="teknisi" <?php if(request('role') === 'teknisi'): echo 'selected'; endif; ?>>Teknisi</option>
                </select>
            </form>
            <a href="<?php echo e(route('admin.user.create')); ?>"
               class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 transition text-white text-sm font-semibold px-4 py-2 rounded-xl whitespace-nowrap">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'plus','class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'plus','class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Tambah Pengguna
            </a>
        </div>
    </div>

    <?php if($users->isEmpty()): ?>
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Belum ada data pengguna.</div>
    <?php else: ?>
        <div class="overflow-x-auto"><table class="w-full text-sm min-w-[640px]">
            <thead class="bg-slate-50 text-slate-500">
                <tr>
                    <th class="text-left font-medium px-6 py-3">Nama</th>
                    <th class="text-left font-medium px-6 py-3">NIS / NIP</th>
                    <th class="text-left font-medium px-6 py-3">Email</th>
                    <th class="text-left font-medium px-6 py-3">Role</th>
                    <th class="text-right font-medium px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-800"><?php echo e($user->name); ?></td>
                        <td class="px-6 py-4 text-slate-600"><?php echo e($user->nis_nip ?? '-'); ?></td>
                        <td class="px-6 py-4 text-slate-600"><?php echo e($user->email); ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold <?php echo e($user->isAdmin() ? 'bg-brand-50 text-brand-700' : ($user->isTeknisi() ? 'bg-amber-50 text-amber-700' : 'bg-slate-100 text-slate-600')); ?>">
                                <?php echo e($user->isAdmin() ? 'Admin' : ($user->isTeknisi() ? 'Teknisi' : 'Siswa')); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="<?php echo e(route('admin.user.edit', $user)); ?>" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="<?php echo e(route('admin.user.destroy', $user)); ?>" onsubmit="return confirm('Hapus pengguna ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-semibold hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table></div>
        <div class="px-6 py-4 border-t border-slate-100">
            <?php echo e($users->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/user/index.blade.php ENDPATH**/ ?>