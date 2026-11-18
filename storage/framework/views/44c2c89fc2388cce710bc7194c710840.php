<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status', 'label' => null]));

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

foreach (array_filter((['status', 'label' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = match ($status) {
    'diajukan' => 'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200',
    'diproses' => 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-200',
    'selesai' => 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-200',
    'ditolak' => 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-200',
    default => 'bg-slate-50 text-slate-700 ring-1 ring-inset ring-slate-200',
};
$text = $label ?? ucfirst($status);
?>

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo e($classes); ?>">
    <?php echo e($text); ?>

</span>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/components/status-badge.blade.php ENDPATH**/ ?>