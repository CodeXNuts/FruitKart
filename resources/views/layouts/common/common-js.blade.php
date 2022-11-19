<script src="{{ asset('seller/js/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('seller/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('seller/js/sweetalert2.min.js') }}" ></script>

<script>
        var Toast = Swal.mixin({
        target: '#custom-target',
        customClass: {
            container: 'position-absolute'
        },
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });
</script>