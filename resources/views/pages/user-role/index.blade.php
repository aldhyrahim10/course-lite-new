@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Role</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Role</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Role List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                            Add Data
                        </button>
                        <table class="myTable table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="articleTableBody">
                                @foreach($userRoles as $item)
                                    <tr class="item-content">
                                        <td>
                                            {{ $loop->iteration }}
                                            <input type="hidden" class="hdnUserRoleID" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->user_role_name }}</td>
                                        <td class="text-center">
                                            <div class="btn btn-primary btn-show" data-toggle="modal"
                                                data-target="#modalShow">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <div class="btn btn-success btn-edit" data-toggle="modal"
                                                data-target="#modalEdit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <div class="btn btn-danger btn-delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


{{-- Modal Tambah Data --}}
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalAddLabel">Add Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formAddUserRole" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Role Name</label>
                                <input type="text" class="form-control" name="user_role_name" id="user_role_name"
                                    placeholder="Enter Role Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseModalAdd" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Modal Edit Data --}}
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalEditLabel">Add Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formEditUserRole" enctype="multipart/form-data">
                <input type="hidden" id="hdnUserRoleID" name="userRole_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Role Name</label>
                                <input type="text" class="form-control" name="user_role_name" id="user_role_name"
                                    placeholder="Enter Role Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseModalEdit" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#formAddUserRole").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData(this);
            
            formData.append('_token', csrfToken);

            $.ajax({
                url: "{{ route('admin.user-role.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    alert("Data Berhasil Ditambahkan");
                    location.reload();
                },
                error: function (data) {
                    console.error("Error:", data);
                    alert("Gagal menambahkan data");
                }
            });
        });

        $(".btn-edit").click(function () {
            var item = $(this).closest('.item-content');
            var id = item.find(".hdnUserRoleID").val();
            
            $.ajax({
                url: "{{ route('admin.user-role.edit') }}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var formEditContent = $("#formEditUserRole");
                    formEditContent.find("#hdnUserRoleID").val(data.id);
                    formEditContent.find("#user_role_name").val(data.user_role_name);
                },
                error: function (xhr) {
                    console.error("Error fetching article data:", xhr.responseText);
                }
            });
        });

        $("#formEditUserRole").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).find("#hdnUserRoleID").val();

            // Create a FormData object from the form element
            var formData = new FormData(this);
            // Ensure the CSRF token and spoofed method are included
            formData.append('_token', csrfToken);
            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ route('admin.user-role.update', '') }}/" + id,
                type: "POST", // Use POST and spoof PATCH via _method
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    alert("Data Berhasil Diubah");
                    location.reload();
                },
                error: function (xhr) {
                    console.error("Error updating course:", xhr.responseText);
                    alert("Gagal mengubah data");
                }
            });
        });

        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');
                var id = item.find(".hdnUserRoleID").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.user-role.destroy', '') }}/" + id,
                    type: "POST",
                    data: {
                        '_token': csrfToken,
                        '_method': 'DELETE'
                    },
                    success: function (data) {
                        alert("Data Berhasil Dihapus");
                        location.reload();
                    },
                    error: function (xhr) {
                        console.error("Error deleting course:", xhr.responseText);
                        alert("Gagal menghapus data");
                    }
                });
            }
        });
    });
</script>
@endsection
