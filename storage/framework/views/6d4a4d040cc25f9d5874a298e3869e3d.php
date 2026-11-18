<?php ($title = 'Tugas Perbaikan'); ?>
<?php ($subtitle = 'Daftar pengaduan yang ditugaskan kepada Anda'); ?>


<?php $__env->startSection('content'); ?>
<div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="inline-flex rounded-xl bg-slate-100 p-1 text-sm font-semibold self-start">
            <?php $__currentLoopData = ['aktif' => 'Aktif', 'selesai' => 'Selesai', 'semua' => 'Semua']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('teknisi.tugas.index', ['tampil' => $k])); ?>"
                   class="px-4 py-1.5 rounded-lg <?php echo e($filter === $k ? 'bg-white text-brand-700 shadow-sm' : 'text-slate-500 hover:text-slate-700'); ?>"><?php echo e($label); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <form method="GET" class="flex-1 sm:max-w-xs sm:ml-auto relative">
            <input type="hidden" name="tampil" value="<?php echo e($filter); ?>">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search','class' => 'w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search','class' => 'w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari kode / deskripsi..."
                   class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
        </form>
    </div>

    <?php if($tugas->isEmpty()): ?>
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Tidak ada tugas pada tampilan ini.</div>
    <?php else: ?>
        <div class="divide-y divide-slate-100">
            <?php $__currentLoopData = $tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('teknisi.tugas.show', $item)); ?>" class="flex items-start gap-4 px-4 sm:px-6 py-4 hover:bg-slate-50">
                    <?php if($item->foto): ?>
                        <img src="<?php echo e(asset($item->foto)); ?>" alt="" loading="lazy" class="w-14 h-14 rounded-xl object-cover border border-slate-200 shrink-0">
                    <?php endif; ?>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-semibold text-slate-800"><?php echo e($item->kategori->nama); ?> &middot; <?php echo e($item->lokasi_nama); ?></p>
                            <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $item->status,'label' => $item->statusLabel()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->status),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->statusLabel())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5"><?php echo e($item->kode); ?> &middot; pelapor <?php echo e($item->user->name); ?></p>
                        <p class="text-sm text-slate-600 mt-1 line-clamp-1"><?php echo e($item->deskripsi); ?></p>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <?php if($item->tahapPerbaikan()): ?>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600"><?php echo e($item->tahapPerbaikan()); ?></span>
                            <?php endif; ?>
                            <?php if($item->target_selesai && $item->status === 'diproses'): ?>
                                <span class="text-xs <?php echo e($item->terlambat() ? 'text-red-600 font-semibold' : 'text-slate-500'); ?>">Target <?php echo e($item->target_selesai->translatedFormat('d M Y')); ?><?php if($item->terlambat()): ?> (terlambat)<?php endif; ?></span>
                            <?php endif; ?>
                            <?php if($item->status === 'selesai' && $item->selesai_at): ?>
                                <span class="text-xs text-slate-500">Selesai <?php echo e($item->selesai_at->translatedFormat('d M Y')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100"><?php echo e($tugas->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/teknisi/tugas/index.blade.php ENDPATH**/ ?>