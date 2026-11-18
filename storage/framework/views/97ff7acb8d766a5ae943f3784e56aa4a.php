<?php ($title = 'Dashboard Admin'); ?>
<?php ($subtitle = 'Selamat datang di panel admin '.\App\Models\Pengaturan::ambil('nama_aplikasi')); ?>


<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-5 mb-6 sm:mb-8">
    <?php $__currentLoopData = [
        ['label' => 'Total Pengaduan', 'val' => $stats['total'], 'icon' => 'clipboard', 'box' => 'bg-brand-50 text-brand-600', 'sub' => '+'.$stats['hari_ini'].' hari ini'],
        ['label' => 'Diajukan', 'val' => $stats['diajukan'], 'icon' => 'clock', 'box' => 'bg-violet-50 text-violet-600', 'sub' => 'menunggu verifikasi'],
        ['label' => 'Diproses', 'val' => $stats['diproses'], 'icon' => 'cog', 'box' => 'bg-amber-50 text-amber-600', 'sub' => 'sedang ditangani'],
        ['label' => 'Selesai', 'val' => $stats['selesai'], 'icon' => 'check', 'box' => 'bg-green-50 text-green-600', 'sub' => 'sudah diperbaiki'],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="anim-up d<?php echo e($i + 1); ?> lift bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl <?php echo e($c['box']); ?> flex items-center justify-center mb-3 sm:mb-4">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $c['icon'],'class' => 'w-5 h-5 sm:w-6 sm:h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($c['icon']),'class' => 'w-5 h-5 sm:w-6 sm:h-6']); ?>
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
            <p class="text-xs sm:text-sm text-slate-500"><?php echo e($c['label']); ?></p>
            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1"><span data-count="<?php echo e($c['val']); ?>"><?php echo e($c['val']); ?></span></p>
            <p class="text-[11px] sm:text-xs text-slate-400 mt-1"><?php echo e($c['sub']); ?></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="grid grid-cols-1 xl:grid-cols-5 gap-4 sm:gap-5">
    <div class="anim-up d3 xl:col-span-3 bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex items-center gap-2">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chart','class' => 'w-5 h-5 text-brand-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chart','class' => 'w-5 h-5 text-brand-600']); ?>
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
                <h3 class="font-bold text-slate-800">Statistik Kerusakan per Kategori</h3>
            </div>
            <form method="GET">
                <select name="periode" onchange="this.form.submit()" class="px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-medium text-slate-600 focus:ring-2 focus:ring-brand-500 outline-none">
                    <option value="7" <?php if($periode === '7'): echo 'selected'; endif; ?>>7 Hari Terakhir</option>
                    <option value="30" <?php if($periode === '30'): echo 'selected'; endif; ?>>30 Hari Terakhir</option>
                    <option value="semua" <?php if($periode === 'semua'): echo 'selected'; endif; ?>>Semua Waktu</option>
                </select>
            </form>
        </div>
        <div class="relative h-64 sm:h-72"><canvas id="kategoriChart"></canvas></div>
    </div>

    <div class="anim-up d4 xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'bell','class' => 'w-5 h-5 text-brand-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bell','class' => 'w-5 h-5 text-brand-600']); ?>
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
                <h3 class="font-bold text-slate-800">Aktivitas Terbaru</h3>
            </div>
            <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="text-xs font-semibold text-brand-600 hover:underline">Lihat semua</a>
        </div>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('admin.pengaduan.show', $item)); ?>" class="flex items-center gap-3 group">
                    <?php if($item->foto): ?>
                        <img src="<?php echo e(asset($item->foto)); ?>" alt="" loading="lazy" class="w-10 h-10 rounded-xl object-cover border border-slate-200 shrink-0">
                    <?php else: ?>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center shrink-0">
                            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'clipboard','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'clipboard','class' => 'w-5 h-5']); ?>
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
                    <?php endif; ?>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800 truncate group-hover:text-brand-600"><?php echo e($item->kategori->nama); ?> - <?php echo e($item->lokasi_nama); ?></p>
                        <p class="text-xs text-slate-400 truncate"><?php echo e($item->user->name); ?> &middot; <?php echo e($item->created_at->diffForHumans()); ?></p>
                    </div>
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
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-6">Belum ada aktivitas.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    if (window.Chart) {
        new Chart(document.getElementById('kategoriChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chartData->pluck('label')); ?>,
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: <?php echo json_encode($chartData->pluck('total')); ?>,
                    backgroundColor: ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#ef4444', '#06b6d4', '#ec4899', '#84cc16'],
                    borderRadius: 8,
                    maxBarThickness: 56,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 900, easing: 'easeOutQuart' },
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false }, ticks: { maxRotation: 40, minRotation: 0, autoSkip: false, font: { size: 11 } } },
                }
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>