<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pengaduan']));

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

foreach (array_filter((['pengaduan']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($pengaduan->foto || $pengaduan->video): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <?php if($pengaduan->foto): ?>
            <button type="button" data-lightbox="<?php echo e(asset($pengaduan->foto)); ?>" data-type="image"
                    class="group relative block rounded-xl overflow-hidden border border-slate-200 bg-slate-100 text-left">
                <img src="<?php echo e(asset($pengaduan->foto)); ?>" alt="Foto bukti kerusakan" loading="lazy"
                     class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                <span class="absolute bottom-2 left-2 inline-flex items-center gap-1.5 bg-slate-900/70 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'eye','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'eye','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> Perbesar foto
                </span>
            </button>
        <?php endif; ?>

        <?php if($pengaduan->video): ?>
            <div class="rounded-xl overflow-hidden border border-slate-200 bg-black">
                <video src="<?php echo e(asset($pengaduan->video)); ?>#t=0.1" controls preload="metadata" playsinline class="w-full h-48 object-contain"></video>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p class="text-sm text-slate-400">Tidak ada foto atau video bukti.</p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/components/media-evidence.blade.php ENDPATH**/ ?>