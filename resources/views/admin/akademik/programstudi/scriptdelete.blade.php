<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script>
    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        var url = '{{ route("program-studi-fik.destroy", ":id") }}';
        url = url.replace(':id', id);
        Swal.fire({
            title: 'Kamu yakin ?',
            text: "ingin menghapus data program studi ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            console.log(id);
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        // console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1250,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            },
                            toast: true,
                            position: 'top-right'
                        }).then((result) => {
                            // Reload the Page
                            location.reload();
                        })
                        $("#" + id + "").remove(); // you can add name div to remove
                    },
                    error: function(response) {
                        // console.log(response);
                        Swal.fire({
                            icon: 'error',
                            title: response.responseJSON.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            },
                            toast: true,
                            position: 'top-right'
                        }).then((result) => {
                            // Reload the Page
                            // location.reload();
                        })
                        $("#" + id + "").remove();
                    }
                });
            }
        })

    };
</script>
