@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Course Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Course Category</li>
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
                        <h3 class="card-title">Courses List</h3>
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
                            <tbody id="courseTableBody">
                                @foreach($courseCategories as $item)
                                    <tr class="item-content">
                                        <td>
                                            {{ $loop->iteration }}
                                            <input type="hidden" class="hdnCourseCategoryID" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->course_category_name }}</td>
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
            <form id="formAddCourse" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Category Name</label>
                                <input type="text" class="form-control" name="course_category_name" id="course_category_name"
                                    placeholder="Enter Course Category Name">
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
            <form id="formEditCourse" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Category Name</label>
                                <input type="hidden" id="hdnCourseCategoryID" value="">
                                <input type="text" class="form-control" name="course_category_name" id="course_category_name"
                                    placeholder="Enter Course Category Name">
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
        // Add course category form submission
        $("#formAddCourse").submit(function(e) {
            e.preventDefault();
            
            // Get the CSRF token
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            // Get the category name
            var categoryName = $(this).find("#course_category_name").val();
            
            // Validate input before proceeding
            if (!categoryName || categoryName.trim() === "") {
                alert("Please enter a course category name");
                return;
            }
            
            $.ajax({
                url: "{{ route('admin.course-categories.store') }}", // Suggested consistent endpoint naming
                type: "POST",
                data: {
                    '_token': csrfToken,
                    'course_category_name': categoryName
                },
                success: function(response) {
                    alert("Data Berhasil Ditambahkan");
                    location.reload();
                },
                error: function(xhr, status, error) {        
                    console.error("Error saving course category:", xhr.responseText);
                    alert("Failed to save category. Please try again.");
                }
            });
        });

        // Edit button click handler
        $(".btn-edit").click(function () {
            var item = $(this).closest('.item-content');
            var id = item.find(".hdnCourseCategoryID").val(); // Make sure this ID exists in your HTML

            $.ajax({
                url: "{{ route('admin.course-categories.edit') }}", // Suggested endpoint
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var courseID = data.id;
                    var categoryName = data.course_category_name;

                    var formEditContent = $("#formEditCourse");
                    formEditContent.find("#hdnCourseCategoryID").val(courseID); // Match the actual ID in your form
                    formEditContent.find("#course_category_name").val(categoryName);
                },
                error: function(xhr) {
                    console.error("Error fetching category data:", xhr.responseText);
                    alert("Failed to load category data.");
                }
            });
        });

        // Edit form submission
        $("#formEditCourse").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).find("#hdnCourseCategoryID").val(); // Match the ID used in your form
            var categoryName = $(this).find("#course_category_name").val();

            $.ajax({
                url: "{{ route('admin.course-categories.update', '') }}/" + id, // Suggested consistent endpoint
                type: "PATCH",
                data: {
                    '_token': csrfToken,
                    'course_category_name': categoryName
                },
                success: function(response) {
                    alert("Data Berhasil Diperbarui");
                    location.reload();
                },
                error: function (data) {
                    alert("Error");
                }
            });
        });

        // Delete button handler
        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');
                var id = item.find(".hdnCourseCategoryID").val();
                console.log("Deleting category with ID:", id);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.course-categories.destroy', '') }}/" + id,
                    type: "POST",
                    data: {
                        '_token': csrfToken,
                        '_method': 'DELETE',
                    },
                    success: function (data) {
                        alert("Data Berhasil Dihapus");
                        location.reload();
                    },
                    error: function (data) {
                        console.error("Error deleting category:", data.responseText);
                        alert("Gagal menghapus data");
                    }
                });
            }
        });
    });

</script>
@endsection
