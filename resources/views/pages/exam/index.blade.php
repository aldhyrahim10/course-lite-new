@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Course Exams</h1>
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
                        <h3 class="card-title">Exams List</h3>
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
                                    
                                    <th>Exame Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="courseExamTableBody">
                               @foreach ($courseExams as $item)
                                   <tr class="item-content">
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                            <input type="hidden" class="hdnCourseExamID" value="{{ $item->id }}">
                                        </td>
                                        
                                        <td>{{ $item->course_exam_title }}</td>
                                        <td>{!! $item->course_exam_description !!}</td>
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
            <form id="formAddExam" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="course_id" value="{{ $courseName->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Exam Name</label>
                                <input type="text" class="form-control" name="course_exam_title" id="course_exam_title"
                                    placeholder="Enter Exam Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Exam Description</label>
                                <textarea name="course_exam_description" id="course_exam_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
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
            <form id="formEditExam" enctype="multipart/form-data">    
                <input type="hidden" id="hdnCourseExamID" name="course_exam_id">
                <div class="modal-body">
                    <input type="hidden" id="hdnCourseID" name="course_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Exam Name</label>
                                <input type="text" class="form-control" name="course_exam_title" id="course_exam_title"
                                    placeholder="Enter Exam Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Exam Description</label>
                                <textarea name="course_exam_description" id="course_exam_description"
                                    class="form-control content-desc-edit" cols="30" rows="10"></textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.content-desc-add'))
        .catch(error => console.error(error));

    ClassicEditor
        .create(document.querySelector('.content-desc-edit'))
        .catch(error => console.error(error));
</script>

<script>
    $(document).ready(function () {
        $("#formAddExam").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData(this);

            formData.append('_token', csrfToken);

            console.log(formData);
            
            $.ajax({
                url: "{{ route('admin.course-exam.store') }}",
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
            var id = item.find(".hdnCourseExamID").val();

            $.ajax({
                url: "{{ route('admin.course-exam.edit') }}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var formEditContent = $("#formEditExam");
                    formEditContent.find("#hdnCourseExamID").val(data.id);
                    formEditContent.find("#hdnCourseID").val(data.course_id);
                    formEditContent.find("#course_exam_title").val(data.course_exam_title);
                    formEditContent.find("#course_exam_description").val(data
                    .course_exam_description);
                },
                error: function (xhr) {
                    console.error("Error fetching exam course data:", xhr.responseText);
                }
            });
        });

        $("#formEditExam").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).find("#hdnCourseExamID").val();

            // Create a FormData object from the form element
            var formData = new FormData(this);
            // Ensure the CSRF token and spoofed method are included
            formData.append('_token', csrfToken);
            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ route('admin.course-exam.update', '') }}/" +
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
                    console.error("Error updating course exam:", xhr.responseText);
                    alert("Gagal mengubah data");
                }
            });
        });

        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');
                var id = item.find(".hdnCourseExamID").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.course-exam.destroy', '') }}/" +
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
                        console.error("Error deleting course exam:", xhr.responseText);
                        alert("Gagal menghapus data");
                    }
                });
            }
        });
    });
</script>
@endsection