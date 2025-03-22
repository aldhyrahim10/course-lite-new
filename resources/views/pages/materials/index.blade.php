@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Course Moduls</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Course</li>
                    <li class="breadcrumb-item active">{{ $courseName->course_name }}</li>
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
                        <h3 class="card-title">Moduls List</h3>
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
                                    <th>Course</th>
                                    <th>Module Title</th>
                                    <th>Description</th>
                                    <th>Modul</th>
                                    <th>Video</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="courseModulTableBody">
                               @foreach ($courseModuls as $item)
                                   <tr class="item-content">
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                            <input type="hidden" class="hdnCourseMaterialID" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->course->course_name }}</td>
                                        <td>{{ $item->course_material_title }}</td>
                                        <td>{{ $item->course_material_description }}</td>
                                        <td>
                                            @if(!empty($item->course_material_modul))
                                                <a href="{{ Storage::url($item->course_material_modul) }}" target="_blank">Download Modul</a>
                                            @else
                                                <span>No file available</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <video width="320" height="240" controls>
                                                <source src="{{ Storage::url($item->course_material_video) }}" type="video/mp4">
                                            </video>
                                        </td>
                                        <td class="text-center">
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
            <form id="formAddModul" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="course_id" value="{{ $courseName->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul Name</label>
                                <input type="text" class="form-control" name="course_material_title" id="course_material_title"
                                    placeholder="Enter Modul Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul Description</label>
                                <textarea name="course_material_description" id="course_material_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul File</label>
                                <input type="file" id="course_material_modul" class="form-control" name="course_material_modul">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul Video</label>
                                <input type="file" id="course_material_video" class="form-control" name="course_material_video">
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
                <h2 class="modal-title fs-5" id="modalEditLabel">Edit Data</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="formEditModul" enctype="multipart/form-data">    
                <input type="hidden" id="hdnCourseMaterialID" name="course_material_id">
                <div class="modal-body">
                    <input type="hidden" id="hdnCourseID" name="course_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul Name</label>
                                <input type="text" class="form-control" name="course_material_title" id="course_material_title"
                                    placeholder="Enter Modul Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul Description</label>
                                <textarea name="course_material_description" id="course_material_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul File</label>
                                <input type="file" id="course_material_modul" class="form-control" name="course_material_modul">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Modul Video</label>
                                <input type="file" id="course_material_video" class="form-control" name="course_material_video">
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.content-desc-add'))
        .catch(error => console.error(error));

    ClassicEditor
        .create(document.querySelector('.content-desc-edit'))
        .catch(error => console.error(error));
</script> --}}

<script>
    $(document).ready(function () {
        $("#formAddModul").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData(this);

            formData.append('_token', csrfToken);

            console.log(formData);
            
            $.ajax({
                url: "{{ route('admin.course-materials.store') }}",
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
            var id = item.find(".hdnCourseMaterialID").val();

            $.ajax({
                url: "{{ route('admin.course-materials.edit') }}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var formEditContent = $("#formEditModul");
                    formEditContent.find("#hdnCourseMaterialID").val(data.id);
                    formEditContent.find("#hdnCourseID").val(data.course_id);
                    formEditContent.find("#course_material_title").val(data.course_material_title);
                    formEditContent.find("#course_material_description").val(data
                    .course_material_description);
                    formEditContent.find("#course_material_modul").attr("src", data.course_material_modul);
                    formEditContent.find("#course_material_video").attr("src", data.course_material_video);
                },
                error: function (xhr) {
                    console.error("Error fetching material course data:", xhr.responseText);
                }
            });
        });

        $("#formEditModul").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).find("#hdnCourseMaterialID").val();

            // Create a FormData object from the form element
            var formData = new FormData(this);
            // Ensure the CSRF token and spoofed method are included
            formData.append('_token', csrfToken);
            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ route('admin.course-materials.update', '') }}/" +
                    id,
                type: "POST", // Use POST and spoof PATCH via _method
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    alert("Data Berhasil Diubah");
                    location.reload();
                },
                error: function (xhr) {
                    console.error("Error updating course material:", xhr.responseText);
                    alert("Gagal mengubah data");
                }
            });
        });

        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');
                var id = item.find(".hdnCourseMaterialID").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.course-materials.destroy', '') }}/" +
                        id,
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
                        console.error("Error deleting course material:", xhr.responseText);
                        alert("Gagal menghapus data");
                    }
                });
            }
        });
    });

</script>