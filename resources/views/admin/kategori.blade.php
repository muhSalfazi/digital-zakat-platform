@extends('layout.app')

@section('title', 'Kategori Penerimaan')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Kategori Penerima</h1>
        <p class="mb-4">Daftar Kategori.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kategori yang terdaftar</h6>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahAmilModal">
                    <i class="ti ti-plus me-2"></i> Tambah Data Amil
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Total Mustahik</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoriList as $kategori)
                                <tr>
                                    <td>{{ $kategori->name }}</td>
                                    <td class="text-center">{{ $kategori->mustahik_count }}</td>
                                    <td class="text-center">
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editAmilModal{{ $kategori->id }}">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger btn-sm delete-confirm"
                                            data-id="{{ $kategori->id }}" data-name="{{ $kategori->name }}">
                                            Hapus
                                        </button>

                                        <!-- Hidden Delete Form -->
                                        <form id="delete-form-{{ $kategori->id }}"
                                            action="{{ route('admin.kategori.delete', $kategori->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editAmilModal{{ $kategori->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editAmilModalLabel{{ $kategori->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAmilModalLabel{{ $kategori->id }}">Edit Data
                                                    Amil</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Edit Form -->
                                                <form
                                                    action="{{ route('admin.kategori.update', ['id' => $kategori->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ $kategori->name }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($kategoriList->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data kategori</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahAmilModal" tabindex="-1" role="dialog" aria-labelledby="tambahAmilModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAmilModalLabel">Tambah Data Amil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Tambah Amil -->
                    <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Konfirmasi Hapus -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-confirm').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Kategori " + name + " akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
