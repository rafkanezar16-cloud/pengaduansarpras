<?php if($item->status === 'diproses' || ($item->status === 'selesai' && $item->teknisi)): ?>
    <p class="text-xs mt-1.5 <?php echo e($item->status === 'diproses' && ! $item->teknisi_id ? 'text-amber-600 font-semibold' : 'text-slate-500'); ?>">
        <?php if($item->teknisi): ?>
            <span class="inline-flex items-center gap-1"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'wrench','class' => 'w-3.5 h-3.5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'wrench','class' => 'w-3.5 h-3.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?> <?php echo e($item->teknisi->name); ?></span>
            <?php if($item->status === 'diproses' && $item->tahapPerbaikan()): ?> &middot; <?php echo e($item->tahapPerbaikan()); ?> <?php endif; ?>
            <?php if($item->terlambat()): ?> <span class="text-red-600 font-semibold">&middot; terlambat</span> <?php endif; ?>
        <?php else: ?>
            <?php echo e($item->tahapPerbaikan()); ?>

        <?php endif; ?>
    </p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/pengaduan/_teknisi-info.blade.php ENDPATH**/ ?>