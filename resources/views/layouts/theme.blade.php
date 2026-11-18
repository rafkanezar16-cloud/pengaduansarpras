{{-- Warna utama (brand) mengikuti Pengaturan Website yang dipilih admin --}}
@php($brand = \App\Models\Pengaturan::palet())
<script>
    tailwind.config = {
        theme: { extend: {
            fontFamily: { sans: ['Inter', 'sans-serif'] },
            colors: { brand: @json($brand) }
        } }
    }
</script>
<style>
    :root { --brand-600: {{ $brand[600] }}; }
    .lift:hover { box-shadow: 0 10px 25px -10px {{ $brand[600] }}40; }
</style>
