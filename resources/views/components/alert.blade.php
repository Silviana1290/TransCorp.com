<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true
});
</script>
@endif

@if (session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '{{ session('error') }}',
    confirmButtonColor: '#e74c3c',
    confirmButtonText: 'Tutup'
});
</script>
@endif