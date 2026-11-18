<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pengaduan', 'kosong' => 'Belum ada riwayat perbaikan.']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['pengaduan', 'kosong' => 'Belum ada riwayat perbaikan.']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php $logs = $pengaduan->perbaikans; ?>

<?php if($logs->isEmpty()): ?>
    <p class="text-sm text-slate-400"><?php echo e($kosong); ?></p>
<?php else: ?>
    <ol class="relative ml-2.5 border-l-2 border-slate-100 space-y-6">
        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="pl-6 relative">
                <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full ring-4 ring-white <?php echo e($log->dotClass()); ?>"></span>
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo e($log->chipClass()); ?>"><?php echo e($log->label()); ?></span>
                    <span class="text-xs text-slate-400"><?php echo e($log->created_at->translatedFormat('d M Y, H:i')); ?><?php if($log->pencatat): ?> &middot; <?php echo e($log->pencatat->name); ?><?php endif; ?></span>
                </div>
                <?php if($log->catatan): ?>
                    <p class="text-sm text-slate-700 mt-1.5 whitespace-pre-line"><?php echo e($log->catatan); ?></p>
                <?php endif; ?>
                <?php if($log->bahan): ?>
                    <p class="text-xs text-slate-500 mt-1"><span class="font-semibold">Bahan / suku cadang:</span> <?php echo e($log->bahan); ?></p>
                <?php endif; ?>
                <?php if($log->foto): ?>
                    <button type="button" data-lightbox="<?php echo e(asset($log->foto)); ?>" data-type="image" class="mt-2 block" aria-label="Perbesar foto perbaikan">
                        <img src="<?php echo e(asset($log->foto)); ?>" alt="Foto perbaikan" loading="lazy" class="w-28 h-20 object-cover rounded-lg border border-slate-200">
                    </button>
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/components/perbaikan-timeline.blade.php ENDPATH**/ ?>