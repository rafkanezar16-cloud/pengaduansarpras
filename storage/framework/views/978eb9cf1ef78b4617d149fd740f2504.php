<?php ($title = 'Verifikasi Pengaduan'); ?>
<?php ($subtitle = 'Kelola dan tindak lanjuti laporan pengaduan siswa'); ?>


<?php $__env->startSection('content'); ?>
<div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-slate-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-2">
            <div class="relative flex-1 sm:max-w-xs">
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
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari kode / nama siswa..."
                       class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
            </div>
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                <option value="">Semua status</option>
                <?php $__currentLoopData = ['diajukan' => 'Diajukan', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php if(request('status') === $val): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="urut" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                <option value="">Urut: diproses dulu</option>
                <option value="terbaru" <?php if(request('urut') === 'terbaru'): echo 'selected'; endif; ?>>Urut: terbaru</option>
            </select>
            <button type="submit" class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-50">Cari</button>
        </form>
    </div>


    <?php if($pengaduans->isEmpty()): ?>
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Tidak ada data pengaduan yang cocok.</div>
    <?php else: ?>
        
        <div class="md:hidden divide-y divide-slate-100">
            <?php $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="px-4 py-4">
                    <div class="flex items-start justify-between gap-3">
                        <a href="<?php echo e(route('admin.pengaduan.show', $item)); ?>" class="font-semibold text-slate-800 hover:text-brand-600"><?php echo e($item->user->name); ?></a>
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
                    <p class="text-xs text-slate-400 mt-1"><?php echo e($item->kode); ?></p>
                    <p class="text-sm text-slate-600 mt-1"><?php echo e($item->kategori->nama); ?> &middot; <?php echo e($item->lokasi_nama); ?></p>
                    <p class="text-xs text-slate-400"><?php echo e($item->tanggal_kejadian->translatedFormat('d M Y')); ?></p>
                    <?php echo $__env->make('admin.pengaduan._teknisi-info', ['item' => $item], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <?php echo $__env->make('admin.pengaduan._actions', ['item' => $item], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left font-medium px-6 py-3">Pelapor</th>
                        <th class="text-left font-medium px-6 py-3">Kategori / Lokasi</th>
                        <th class="text-left font-medium px-6 py-3">Bukti</th>
                        <th class="text-left font-medium px-6 py-3">Status</th>
                        <th class="text-right font-medium px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <a href="<?php echo e(route('admin.pengaduan.show', $item)); ?>" class="font-semibold text-slate-800 hover:text-brand-600"><?php echo e($item->user->name); ?></a>
                                <p class="text-xs text-slate-400"><?php echo e($item->kode); ?> &middot; <?php echo e($item->tanggal_kejadian->translatedFormat('d M Y')); ?></p>
                            </td>
                            <td class="px-6 py-4 text-slate-600"><?php echo e($item->kategori->nama); ?> &middot; <?php echo e($item->lokasi_nama); ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <?php if($item->foto): ?>
                                        <button type="button" data-lightbox="<?php echo e(asset($item->foto)); ?>" data-type="image" aria-label="Perbesar foto">
                                            <img src="<?php echo e(asset($item->foto)); ?>" alt="" loading="lazy" class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                        </button>
                                    <?php endif; ?>
                                    <?php if($item->video): ?>
                                        <button type="button" data-lightbox="<?php echo e(asset($item->video)); ?>" data-type="video" aria-label="Putar video"
                                                class="w-10 h-10 rounded-lg bg-slate-100 text-slate-500 hover:bg-brand-50 hover:text-brand-600 flex items-center justify-center">
                                            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'video','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'video','class' => 'w-5 h-5']); ?>
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
                                        </button>
                                    <?php endif; ?>
                                    <?php if (! ($item->foto || $item->video)): ?> <span class="text-slate-300">-</span> <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
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
                                <?php echo $__env->make('admin.pengaduan._teknisi-info', ['item' => $item], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <?php echo $__env->make('admin.pengaduan._actions', ['item' => $item], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100"><?php echo e($pengaduans->links()); ?></div>
    <?php endif; ?>
</div>
<?php echo $__env->make('admin.pengaduan._modals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/pengaduan/index.blade.php ENDPATH**/ ?>