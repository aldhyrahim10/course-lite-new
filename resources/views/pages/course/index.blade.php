@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Courses</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Courses</li>
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
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Instructor</th>
                                    <th>Picture</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="courseTableBody">
                                @foreach($courses as $item)
                                    <tr class="item-content">
                                        <td>
                                            {{ $loop->iteration }}
                                            <input type="hidden" class="hdnCourseID" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->course_name }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->course_price }}</td>
                                        <td>{{ $item->instructor_name }}</td>
                                        <td class="text-center"><img src="{{ Storage::url($item->course_image) }}"
                                                width="100" alt="">
                                        <td class="text-center">
                                            <div class="btn btn-primary btn-show" data-toggle="modal"
                                                data-target="#modalDetail">
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
                                <label>Course Name</label>
                                <input type="text" class="form-control" name="course_name" id="course_name"
                                    placeholder="Enter Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="course_category_id" id="course_category_id">
                                    <option value="">--Select Category--</option>
                                    @foreach($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->course_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Description</label>
                                <textarea name="course_description" id="course_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Benefit</label>
                                <textarea name="course_benefit" id="course_benefit"
                                    class="form-control content-benefit-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Price</label>
                                <input type="number" class="form-control" name="course_price" id="course_price"
                                    placeholder="Enter Course Price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Is Discount ?</label>
                                <!-- Hidden input provides a default of "false" -->
                                <input type="hidden" name="is_discount" id="is_discount" value="0">
                                <!-- Checkbox sends "true" if checked -->
                                <input type="checkbox" name="is_discount" id="is_discount" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Discount Percentage</label>
                                <input type="number" class="form-control" name="discount_percentage"
                                    id="discount_percentage" placeholder="Enter Discount Percentage">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Image</label>
                                <input type="file" id="course_image" class="form-control" name="course_image">
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
                <input type="hidden" id="hdnCourseID" name="course_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" class="form-control" name="course_name" id="course_name"
                                    placeholder="Enter Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="course_category_id" id="course_category_id">
                                    <option value="">--Select Category--</option>
                                    @foreach($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->course_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Description</label>
                                <textarea name="course_description" id="course_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Benefit</label>
                                <textarea name="course_benefit" id="course_benefit"
                                    class="form-control content-benefit-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Price</label>
                                <input type="number" class="form-control" name="course_price" id="course_price"
                                    placeholder="Enter Course Price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Is Discount ?</label>
                                <!-- Hidden input provides a default of "false" -->
                                <input type="hidden" name="is_discount" id="is_discount" value="0">
                                <!-- Checkbox sends "true" if checked -->
                                <input type="checkbox" name="is_discount" id="is_discount" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Discount Percentage</label>
                                <input type="number" class="form-control" name="discount_percentage"
                                    id="discount_percentage" placeholder="Enter Discount Percentage">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Image</label>
                                <input type="file" id="course_image" class="form-control" name="course_image">
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

{{-- Modal Detail Data --}}
<div class="modal fade" id="modalDetail" class="modalBodyDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="modalDetailabel">Detail Course</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="" class="btn-modul-link">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="totalModul"></h3>
    
                                    <p>Moduls</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="" class="btn-exam-link">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 id="totalExam"></h3>
                                    <p>Exam</p>
                                </div>        
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCloseModaDetail" class="btn btn-secondary"
                    data-dismiss="modal">Tutup</button>

            </div>

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

    ClassicEditor
        .create(document.querySelector('.content-benefit-add'))
        .catch(error => console.error(error));

    ClassicEditor
        .create(document.querySelector('.content-benefit-edit'))
        .catch(error => console.error(error));

</script>

<script>
    $(document).ready(function () {
        $("#formAddCourse").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData(this);

            formData.append('_token', csrfToken);

            $.ajax({
                url: "{{ route('admin.courses.store') }}",
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
            var id = item.find(".hdnCourseID").val();

            $.ajax({
                url: "{{ route('admin.courses.edit') }}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var formEditContent = $("#formEditCourse");
                    formEditContent.find("#hdnCourseID").val(data.id);
                    formEditContent.find("#course_name").val(data.course_name);
                    formEditContent.find("#course_category_id").val(data
                    .course_category_id);
                    formEditContent.find("#course_description").val(data
                    .course_description);
                    formEditContent.find("#course_benefit").val(data.course_benefit);
                    formEditContent.find("#course_price").val(data.course_price);
                    formEditContent.find("#discount_percentage").val(data
                        .discount_percentage);
                    // Set the checkbox for is_discount (assumes a value of 1 means true)
                    formEditContent.find("#is_discount").prop("checked", data.is_discount ==
                        1);
                    // Update the image preview if applicable
                    formEditContent.find("#course_image").attr("src", data.course_image);
                },
                error: function (xhr) {
                    console.error("Error fetching course data:", xhr.responseText);
                }
            });
        });

        $("#formEditCourse").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).find("#hdnCourseID").val();

            // Create a FormData object from the form element
            var formData = new FormData(this);
            // Ensure the CSRF token and spoofed method are included
            formData.append('_token', csrfToken);
            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ route('admin.courses.update', '') }}/" +
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
                    console.error("Error updating course:", xhr.responseText);
                    alert("Gagal mengubah data");
                }
            });
        });

        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');
                var id = item.find(".hdnCourseID").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.courses.destroy', '') }}/" +
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
                        console.error("Error deleting course:", xhr.responseText);
                        alert("Gagal menghapus data");
                    }
                });
            }
        });

        $(".btn-show").click(function(){
            var item = $(this).closest('.item-content');
            var id = item.find(".hdnCourseID").val();
            var routeModuls = "{{ route('admin.course-materials.index', ['id' => '__ID__']) }}";

            var routeExams = "{{ route('admin.course-exam.index', ['id' => '__ID__']) }}";

            routeModuls = routeModuls.replace('__ID__', id);

            routeExams = routeExams.replace('__ID__', id);

            var modalDetail = $("#modalDetail");

            var linkModul = modalDetail.find(".btn-modul-link").attr('href', routeModuls);

            var linkExam = modalDetail.find(".btn-exam-link").attr('href', routeExams);

            $.ajax({
                url: "{{ route('admin.course-materials.count') }}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var moduleCount = data.moduleCount === 0 ? 0 : data.moduleCount;
                    var examCount = data.examCount === 0 ? 0 : data.examCount;
                    
                    modalDetail.find("#totalModul").text(moduleCount);
                    modalDetail.find("#totalExam").text(examCount);
                },
                error: function (xhr) {
                    console.error("Error fetching course data:", xhr.responseText);
                }
            });
        });
    });

</script>
@endsection
