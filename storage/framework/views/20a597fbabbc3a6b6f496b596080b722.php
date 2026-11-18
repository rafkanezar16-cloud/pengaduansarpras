<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? $web['nama_aplikasi']); ?> - <?php echo e($web['nama_aplikasi']); ?></title>
    <link rel="icon" href="<?php echo e($web['logo'] ? \App\Models\Pengaturan::logoUrl() : asset('favicon.svg')); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->make('layouts.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        /* ---- Animasi ringan ---- */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes popIn  { from { opacity: 0; transform: scale(.94); } to { opacity: 1; transform: none; } }
        .anim-up   { opacity: 0; animation: fadeUp .5s ease-out forwards; }
        .anim-pop  { animation: popIn .25s ease-out; }
        .d1 { animation-delay: .05s; } .d2 { animation-delay: .12s; } .d3 { animation-delay: .19s; }
        .d4 { animation-delay: .26s; } .d5 { animation-delay: .33s; }
        .lift { transition: transform .2s ease, box-shadow .2s ease; }
        .lift:hover { transform: translateY(-3px); }
        @media (prefers-reduced-motion: reduce) {
            .anim-up { opacity: 1; animation: none; }
            .lift:hover { transform: none; }
        }
    </style>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

<?php
    $isAdmin = auth()->user()->isAdmin();
    $isTeknisi = auth()->user()->isTeknisi();
    $menu = $isTeknisi ? [
        ['route' => 'teknisi.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
        ['route' => 'teknisi.tugas.index', 'label' => 'Tugas Perbaikan', 'icon' => 'wrench', 'alsoActive' => ['teknisi.tugas.*']],
        ['route' => 'teknisi.riwayat', 'label' => 'Riwayat Perbaikan', 'icon' => 'history'],
    ] : ($isAdmin ? [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
        ['route' => 'admin.pengaduan.index', 'label' => 'Verifikasi Pengaduan', 'icon' => 'clipboard'],
        ['route' => 'admin.kategori.index', 'label' => 'Master Data', 'icon' => 'database', 'alsoActive' => ['admin.lokasi.*', 'admin.user.*']],
        ['route' => 'admin.laporan.index', 'label' => 'Laporan', 'icon' => 'chart'],
        ['route' => 'admin.pengaturan.edit', 'label' => 'Pengaturan Website', 'icon' => 'cog'],
    ] : [
        ['route' => 'siswa.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
        ['route' => 'siswa.pengaduan.create', 'label' => 'Ajukan Pengaduan', 'icon' => 'plus'],
        ['route' => 'siswa.pengaduan.index', 'label' => 'Riwayat Pengaduan', 'icon' => 'clock', 'alsoActive' => ['siswa.pengaduan.show']],
        ['route' => 'siswa.panduan', 'label' => 'Panduan', 'icon' => 'book'],
    ]);

    $flashMessages = [
        'pengaduan-created' => 'Pengaduan berhasil dikirim. Pantau statusnya di Riwayat Pengaduan.',
        'status-updated' => 'Status pengaduan berhasil diperbarui.',
        'kategori-created' => 'Kategori berhasil ditambahkan.',
        'kategori-updated' => 'Kategori berhasil diperbarui.',
        'kategori-deleted' => 'Kategori berhasil dihapus.',
        'lokasi-created' => 'Lokasi berhasil ditambahkan.',
        'lokasi-updated' => 'Lokasi berhasil diperbarui.',
        'lokasi-deleted' => 'Lokasi berhasil dihapus.',
        'user-created' => 'Pengguna berhasil ditambahkan.',
        'user-updated' => 'Data pengguna berhasil diperbarui.',
        'user-deleted' => 'Pengguna berhasil dihapus.',
        'pengaturan-updated' => 'Pengaturan website berhasil disimpan. Tampilan sudah diperbarui.',
        'pengaturan-reset' => 'Pengaturan website dikembalikan ke bawaan.',
        'teknisi-assigned' => 'Teknisi berhasil ditugaskan. Riwayat perbaikan sudah dicatat.',
        'tugas-mulai' => 'Perbaikan ditandai mulai dikerjakan.',
        'catatan-added' => 'Catatan progres berhasil disimpan ke riwayat perbaikan.',
        'tugas-selesai' => 'Perbaikan ditandai selesai. Status pengaduan kini Selesai.',
        'tugas-dikembalikan' => 'Tugas dikembalikan ke admin beserta alasannya.',
        'profile-updated' => 'Profil berhasil diperbarui.',
        'password-updated' => 'Kata sandi berhasil diperbarui.',
    ];
    $flashKey = session('status');
    $flashText = session('error') ?: ($flashMessages[$flashKey] ?? $flashKey);
?>

<div class="flex min-h-screen">

    
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/60 z-30 hidden lg:hidden" style="animation: fadeIn .2s"></div>

    
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-40 w-72 -translate-x-full transition-transform duration-300 ease-out
                  lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:z-auto
                  shrink-0 flex flex-col bg-gradient-to-b from-brand-950 via-brand-900 to-brand-950 text-white overflow-y-auto">
        <div class="px-6 py-6 flex items-center gap-3 border-b border-white/10">
            <?php $nama = \App\Models\Pengaturan::namaTerpisah(); ?>
            <img src="<?php echo e(\App\Models\Pengaturan::logoUrl()); ?>" alt="Logo <?php echo e($web['nama_aplikasi']); ?>" class="w-11 h-11 shrink-0 object-contain">
            <div class="flex-1 min-w-0">
                <p class="text-xl font-extrabold leading-tight break-words"><?php echo e($nama[0]); ?><span class="text-amber-400"><?php echo e($nama[1]); ?></span></p>
                <p class="text-[11px] text-brand-200 leading-tight"><?php echo e($web['slogan']); ?></p>
            </div>
            <button type="button" id="sidebar-close" class="lg:hidden p-1.5 rounded-lg hover:bg-white/10" aria-label="Tutup menu">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-5 h-5']); ?>
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
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $active = request()->routeIs($item['route'].'*') || request()->routeIs(...($item['alsoActive'] ?? ['__none__']));
                ?>
                <a href="<?php echo e(route($item['route'])); ?>"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                          <?php echo e($active ? 'bg-brand-600 text-white shadow-lg shadow-brand-900/40' : 'text-brand-100 hover:bg-white/10'); ?>">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $item['icon'],'class' => 'w-5 h-5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item['icon']),'class' => 'w-5 h-5 shrink-0']); ?>
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
                    <span><?php echo e($item['label']); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>

        <div class="px-4 pb-4">
            <a href="<?php echo e(route('profile.edit')); ?>"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                      <?php echo e(request()->routeIs('profile.*') ? 'bg-brand-600 text-white' : 'text-brand-100 hover:bg-white/10'); ?>">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'user','class' => 'w-5 h-5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user','class' => 'w-5 h-5 shrink-0']); ?>
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
                <span>Profil Saya</span>
            </a>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-brand-100 hover:bg-white/10 transition">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'logout','class' => 'w-5 h-5 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'logout','class' => 'w-5 h-5 shrink-0']); ?>
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
                    <span>Keluar</span>
                </button>
            </form>
        </div>

        <div class="px-6 py-4 border-t border-white/10 flex items-center gap-2 text-brand-300">
            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[10px] font-bold">SMK</div>
            <div class="text-[11px] leading-tight">
                <p class="font-semibold text-white"><?php echo e($web['nama_aplikasi']); ?></p>
                <p><?php echo e($web['nama_sekolah']); ?></p>
            </div>
        </div>
    </aside>

    
    <div class="flex-1 flex flex-col min-w-0">

        <header class="sticky top-0 z-20 bg-white/90 backdrop-blur border-b border-slate-100 px-4 sm:px-8 py-3 sm:py-5 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <button type="button" id="sidebar-open" class="lg:hidden p-2 -ml-2 rounded-lg text-slate-600 hover:bg-slate-100" aria-label="Buka menu">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'menu','class' => 'w-6 h-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'menu','class' => 'w-6 h-6']); ?>
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
                <div class="min-w-0">
                    <h1 class="text-lg sm:text-2xl font-extrabold text-slate-900 truncate"><?php echo e($title ?? 'Dashboard'); ?></h1>
                    <?php if(!empty($subtitle)): ?>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5 truncate"><?php echo e($subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-2 bg-slate-50 border border-slate-100 rounded-full pl-1.5 sm:pl-2 pr-1.5 sm:pr-4 py-1.5 shrink-0 hover:bg-slate-100 transition">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-sm">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                </div>
                <div class="text-sm leading-tight hidden sm:block">
                    <p class="font-semibold text-slate-800 max-w-[160px] truncate"><?php echo e(auth()->user()->name); ?></p>
                    <p class="text-slate-400 text-xs"><?php echo e(auth()->user()->roleLabel()); ?></p>
                </div>
            </a>
        </header>

        <main class="flex-1 p-4 sm:p-8">
            <?php if($flashText): ?>
                <div id="flash" class="anim-pop mb-6 rounded-xl px-4 py-3 text-sm font-medium flex items-start justify-between gap-3
                    <?php echo e(session('error') ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-green-50 text-green-700 border border-green-200'); ?>">
                    <span><?php echo e($flashText); ?></span>
                    <button type="button" onclick="document.getElementById('flash').remove()" class="opacity-60 hover:opacity-100" aria-label="Tutup">&times;</button>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="anim-pop mb-6 rounded-xl px-4 py-3 text-sm font-medium bg-red-50 text-red-700 border border-red-200">
                    <ul class="list-disc list-inside space-y-0.5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</div>


<div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/90 p-4" role="dialog" aria-modal="true">
    <button type="button" id="lightbox-close" class="absolute top-4 right-4 text-white/80 hover:text-white p-2" aria-label="Tutup">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-8 h-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-8 h-8']); ?>
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
    <div id="lightbox-body" class="anim-pop max-w-5xl w-full max-h-full flex items-center justify-center"></div>
</div>

<script>
(function () {
    // ----- Drawer sidebar (mobile) -----
    var sidebar = document.getElementById('sidebar');
    var overlay = document.getElementById('sidebar-overlay');
    function openMenu()  { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
    function closeMenu() { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); document.body.style.overflow = ''; }
    document.getElementById('sidebar-open').addEventListener('click', openMenu);
    document.getElementById('sidebar-close').addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);

    // ----- Lightbox: elemen dengan data-lightbox="url" & data-type="image|video" -----
    var box = document.getElementById('lightbox');
    var body = document.getElementById('lightbox-body');
    function closeBox() { box.classList.add('hidden'); box.classList.remove('flex'); body.innerHTML = ''; document.body.style.overflow = ''; }
    document.addEventListener('click', function (e) {
        var el = e.target.closest('[data-lightbox]');
        if (!el) return;
        e.preventDefault();
        var url = el.getAttribute('data-lightbox');
        var type = el.getAttribute('data-type') || 'image';
        body.innerHTML = type === 'video'
            ? '<video src="' + url + '" controls autoplay playsinline class="max-h-[85vh] max-w-full rounded-xl bg-black"></video>'
            : '<img src="' + url + '" alt="Foto bukti" class="max-h-[85vh] max-w-full rounded-xl object-contain">';
        box.classList.remove('hidden'); box.classList.add('flex'); document.body.style.overflow = 'hidden';
    });
    box.addEventListener('click', function (e) { if (e.target === box) closeBox(); });
    document.getElementById('lightbox-close').addEventListener('click', closeBox);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { closeBox(); closeMenu(); } });

    // ----- Count-up angka statistik: <span data-count="24">0</span> -----
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    document.querySelectorAll('[data-count]').forEach(function (el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        if (reduce || target === 0) { el.textContent = target; return; }
        var start = null, dur = 800;
        function step(ts) {
            if (!start) start = ts;
            var p = Math.min((ts - start) / dur, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    });
})();
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/layouts/app.blade.php ENDPATH**/ ?>