<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body id="page-top">
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{!! session('success') !!}',
                // timer: 1500,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__bounceInDown' // Menambahkan animasi muncul
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp' // Menambahkan animasi saat ditutup
                },
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{!! session('error') !!}',
                // timer: 1500,
                confirmButtonText: 'OK',
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeIn' // Animasi muncul
                },
                hideClass: {
                    popup: 'animate__animated animate__zoomOut' // Animasi saat ditutup
                },
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.confirmButtonText) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Informasi',
                        text: 'Silakan Coba kembali.',
                        // confirmButtonText: 'OK',
                        timer: 1800,
                        timerProgressBar: true,
                        showClass: {
                            popup: 'animate__animated animate__fadeIn' // Animasi muncul
                        },
                        hideClass: {
                            popup: 'animate__animated animate__zoomOut' // Animasi saat ditutup
                        },
                    });
                }
            });
        @endif
    </script>

    <div id="wrapper">
        @include('layout.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.header', ['user' => $user])
                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Modal JavaScript -->
    <script>
        // Ensure jQuery is loaded after Bootstrap
        $(document).ready(function() {
            // Show modal when clicking tambahAmilModal button
            $('#tambahAmilModal').on('show.bs.modal', function(e) {
                // Do something when modal is about to show
            });
        });
    </script>
</body>

</html>
