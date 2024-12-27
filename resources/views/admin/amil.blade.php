@extends('layout.app')

@section('title', 'Amil')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Amil Data</h1>
        <p class="mb-4">Daftar Amil.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data amil yang terdaftar</h6>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahAmilModal">
                    <i class="ti ti-plus me-2"></i> Tambah Data Amil
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Profile</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">status Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($amilList as $amil)
                                <tr>
                                    <td>{{ $amil->name }}</td>
                                    <td>{{ $amil->phone }}</td>
                                    <td>{{ $amil->address }}</td>
                                    <td>{{ $amil->user->status }}</td>
                                    <td>
                                        @if ($amil->imageProfile)
                                            <img src="{{ asset($amil->imageProfile) }}" class="img-fluid"
                                                alt="{{ $amil->name }}"style="max-width: 100px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>

                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editAmilModal{{ $amil->id }}">
                                            Edit
                                        </button>
                                        <!-- Ubah Password & Username Modal -->
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#editPasswordUsernameModal{{ $amil->id }}">
                                            Ubah Password & Username
                                        </button>
                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm mt-1 delete-confirm"
                                            data-id="{{ $amil->id }}" data-name="{{ $amil->name }}">
                                            Delete
                                        </button>


                                    </td>
                                    <td>
                                        <!-- Non-Aktifkan or Aktifkan Button based on status -->
                                        @if ($amil->user->status == 'aktif')
                                            <form action="{{ route('admin.amil.deactivate', ['id' => $amil->user->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btn-sm">Non-Aktifkan</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.amil.activate', ['id' => $amil->user->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>


                                <!-- Modal Edit -->
                                <div class="modal fade" id="editAmilModal{{ $amil->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editAmilModalLabel{{ $amil->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAmilModalLabel{{ $amil->id }}">Edit
                                                    Amil
                                                    Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Edit Form -->
                                                <form action="{{ route('admin.amil.update', ['id' => $amil->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ $amil->name }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            name="phone" value="{{ $amil->phone }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address"
                                                            name="address" value="{{ $amil->address }}">
                                                    </div>



                                                    <div class="form-group">
                                                        <label for="imageProfile">Profile Image</label>
                                                        <input type="file" class="form-control-file" id="imageProfile"
                                                            name="imageProfile" accept=".jpeg,.jpg,.png,.gif">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit Password & Username -->
                                <div class="modal fade" id="editPasswordUsernameModal{{ $amil->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="editPasswordUsernameModalLabel{{ $amil->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="editPasswordUsernameModalLabel{{ $amil->id }}">Ubah Password &
                                                    Username</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form Ubah Password & Username -->
                                                <form
                                                    action="{{ route('admin.amil.updatePasswordUsername', ['id' => $amil->user->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="username">New Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" value="{{ $amil->user->username }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" required>
                                                    </div>


                                                    <button type="submit" class="btn btn-primary">Update Password &
                                                        Username</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Amil -->
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
                    <!-- Form Tambah Amil -->
                    <form action="{{ route('admin.amil.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Password</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="imageProfile">Profile Image</label>
                            <input type="file" class="form-control-file" id="imageProfile" name="imageProfile"
                                accept=".jpeg,.jpg,.png,.gif">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script SweetAlert untuk Konfirmasi Delete -->
    <script>
        document.querySelectorAll('.delete-confirm').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menghapus Amil " + name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
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
