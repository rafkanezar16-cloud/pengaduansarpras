<?php ($title = 'Dashboard Teknisi'); ?>
<?php ($subtitle = 'Halo, ' . auth()->user()->name . '. Ini ringkasan tugas perbaikan Anda.'); ?>


<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-5 mb-6 sm:mb-8">
    <?php $__currentLoopData = [
        ['label' => 'Tugas Baru', 'key' => 'baru', 'icon' => 'bell', 'box' => 'bg-blue-50 text-blue-600'],
        ['label' => 'Sedang Dikerjakan', 'key' => 'dikerjakan', 'icon' => 'wrench', 'box' => 'bg-amber-50 text-amber-600'],
        ['label' => 'Selesai Diperbaiki', 'key' => 'selesai', 'icon' => 'check', 'box' => 'bg-green-50 text-green-600'],
        ['label' => 'Lewat Target', 'key' => 'terlambat', 'icon' => 'alert', 'box' => 'bg-red-50 text-red-600'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="anim-up d<?php echo e($i + 1); ?> lift bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6">
            <div class="w-11 h-11 rounded-xl <?php echo e($card['box']); ?> flex items-center justify-center mb-3 sm:mb-4">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $card['icon'],'class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon']),'class' => 'w-6 h-6']); ?>
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
            </div>
            <p class="text-xs sm:text-sm text-slate-500"><?php echo e($card['label']); ?></p>
            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1"><span data-count="<?php echo e($stats[$card['key']]); ?>"><?php echo e($stats[$card['key']]); ?></span></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="grid grid-cols-1 xl:grid-cols-5 gap-5 sm:gap-6">
    <div class="anim-up d5 xl:col-span-3 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-2">
            <h3 class="font-bold text-slate-800">Tugas Perbaikan Aktif</h3>
            <a href="<?php echo e(route('teknisi.tugas.index')); ?>" class="text-sm font-semibold text-brand-600 hover:underline whitespace-nowrap">Lihat semua &rarr;</a>
        </div>
        <?php if($tugas->isEmpty()): ?>
            <div class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada tugas aktif. Tugas baru akan muncul setelah admin menugaskan Anda.</div>
        <?php else: ?>
            <div class="divide-y divide-slate-100">
                <?php $__currentLoopData = $tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('teknisi.tugas.show', $item)); ?>" class="flex items-start gap-3 px-4 sm:px-6 py-4 hover:bg-slate-50">
                        <?php if($item->foto): ?>
                            <img src="<?php echo e(asset($item->foto)); ?>" alt="" loading="lazy" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shrink-0">
                        <?php endif; ?>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-800 truncate"><?php echo e($item->kategori->nama); ?> &middot; <?php echo e($item->lokasi_nama); ?></p>
                            <p class="text-xs text-slate-400 mt-0.5"><?php echo e($item->kode); ?> &middot; pelapor <?php echo e($item->user->name); ?></p>
                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700"><?php echo e($item->tahapPerbaikan()); ?></span>
                                <?php if($item->target_selesai): ?>
                                    <span class="text-xs <?php echo e($item->terlambat() ? 'text-red-600 font-semibold' : 'text-slate-500'); ?>">
                                        Target <?php echo e($item->target_selesai->translatedFormat('d M Y')); ?><?php if($item->terlambat()): ?> (terlambat)<?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="anim-up d5 xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
        <h3 class="font-bold text-slate-800 mb-4">Aktivitas Terakhir Anda</h3>
        <?php $__empty_1 = true; $__currentLoopData = $aktivitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex gap-3 py-3 <?php echo e(! $loop->last ? 'border-b border-slate-100' : ''); ?>">
                <span class="mt-1.5 w-2.5 h-2.5 rounded-full shrink-0 <?php echo e($log->dotClass()); ?>"></span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-800"><?php echo e($log->label()); ?></p>
                    <p class="text-xs text-slate-500 truncate"><?php echo e($log->pengaduan->kode); ?></p>
                    <p class="text-xs text-slate-400"><?php echo e($log->created_at->diffForHumans()); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-sm text-slate-400">Belum ada aktivitas perbaikan yang tercatat.</p>
        <?php endif; ?>
        <a href="<?php echo e(route('teknisi.riwayat')); ?>" class="inline-block mt-3 text-sm font-semibold text-brand-600 hover:underline">Buka riwayat perbaikan &rarr;</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/teknisi/dashboard.blade.php ENDPATH**/ ?>