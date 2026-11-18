<?php ($title = 'Master Data'); ?>
<?php ($subtitle = 'Kelola kategori kerusakan, lokasi, dan data pengguna'); ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.partials.master-tabs', ['active' => 'lokasi'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-bold text-slate-800">Lokasi / Ruangan</h3>
        <a href="<?php echo e(route('admin.lokasi.create')); ?>"
           class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 transition text-white text-sm font-semibold px-4 py-2 rounded-xl">
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
<?php endif; ?> Tambah Lokasi
        </a>
    </div>

    <?php if($lokasis->isEmpty()): ?>
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Belum ada data lokasi.</div>
    <?php else: ?>
        <div class="overflow-x-auto"><table class="w-full text-sm min-w-[640px]">
            <thead class="bg-slate-50 text-slate-500">
                <tr>
                    <th class="text-left font-medium px-6 py-3 w-16">No</th>
                    <th class="text-left font-medium px-6 py-3">Nama Lokasi</th>
                    <th class="text-left font-medium px-6 py-3">Gedung</th>
                    <th class="text-left font-medium px-6 py-3">Jumlah Pengaduan</th>
                    <th class="text-right font-medium px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $lokasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $lokasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 text-slate-500"><?php echo e($lokasis->firstItem() + $i); ?></td>
                        <td class="px-6 py-4 font-medium text-slate-800"><?php echo e($lokasi->nama); ?></td>
                        <td class="px-6 py-4 text-slate-600"><?php echo e($lokasi->gedung ?? '-'); ?></td>
                        <td class="px-6 py-4 text-slate-600"><?php echo e($lokasi->pengaduans_count); ?></td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="<?php echo e(route('admin.lokasi.edit', $lokasi)); ?>" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="<?php echo e(route('admin.lokasi.destroy', $lokasi)); ?>" onsubmit="return confirm('Hapus lokasi ini?')">
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
            <?php echo e($lokasis->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/lokasi/index.blade.php ENDPATH**/ ?>