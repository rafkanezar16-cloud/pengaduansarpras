
<?php ($brand = \App\Models\Pengaturan::palet()); ?>
<script>
    tailwind.config = {
        theme: { extend: {
            fontFamily: { sans: ['Inter', 'sans-serif'] },
            colors: { brand: <?php echo json_encode($brand, 15, 512) ?> }
        } }
    }
</script>
<style>
    :root { --brand-600: <?php echo e($brand[600]); ?>; }
    .lift:hover { box-shadow: 0 10px 25px -10px <?php echo e($brand[600]); ?>40; }
</style>
<?php /**PATH C:\xampp\htdocs\AduinAja-Laravel-v6\resources\views/layouts/theme.blade.php ENDPATH**/ ?>