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
                                        <td class="text-center"><img src="{{ $item->course_image }}" width="100"
                                                alt="">
                                        </td>
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
                                <select class="form-control" name="category_id" id="category_id">
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
                                <textarea name="content_desc" id="content_desc" class="form-control content-desc-add"
                                    cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Benefit</label>
                                <textarea name="content_benefit" id="content_benefit"
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
                                <label>Picture</label>
                                <input type="file" id="picture" class="form-control" name="picture">
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
                                <label>Course Name</label>
                                <input type="hidden" id="hdnCourseID" value="">
                                <input type="text" class="form-control" name="course_name" id="course_name"
                                    placeholder="Enter Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" id="category_id">
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
                                <textarea name="content_desc" id="content_desc" class="form-control content-desc-edit"
                                    cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Benefit</label>
                                <textarea name="content_benefit" id="content_benefit"
                                    class="form-control content-benefit-edit" cols="30" rows="10"></textarea>
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
                                <label>Picture</label>
                                <input type="file" id="picture" class="form-control" name="picture">
                                <small>gambar sebelumnya</small>
                                <br>
                                <img class="picture_image" width="100px" src="" alt="">
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

            var name = $(this).find("#course_name").val();
            var category = $(this).find("#category_id").val();
            var desc = $(this).find("#content_desc").val();
            var benefit = $(this).find("#content_benefit").val();
            var price = $(this).find("#course_price").val();
            var picture = $(this).find("#picture")[0].files[0];

            if (!picture) {
                alert("belum ada gambar");
            } else {
                let formData = new FormData();
                formData.append('image', picture);
                formData.append('_token', csrfToken);

                $.ajax({
                    // url: "",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        var imgUrl = data.image_url

                        $.ajax({
                            // url: "",
                            type: "POST",
                            data: {
                                '_token': csrfToken,
                                'course_category_id': category,
                                'course_name': name,
                                'course_description': desc,
                                'course_benefit': benefit,
                                'course_price': price,
                                'course_image': imgUrl
                            },
                            success: function (data2) {
                                alert("Data Berhasil Ditambahkan");

                                location.reload();
                            },
                            error: function (data2) {
                                console.log("gagal");
                            }
                        })

                    },
                    error: function (data) {
                        console.log("Upload gagal", data);
                    }
                });
            }

        });

        $(".btn-edit").click(function () {

            var item = $(this).closest('.item-content');

            var id = item.find(".hdnCourseID").val();

            $.ajax({
                // url: "",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var courseID = data.id;
                    var category = data.course_category_id;
                    var name = data.course_name;
                    var desc = data.course_description;
                    var benefit = data.course_benefit;
                    var price = data.course_price;
                    var picture = data.course_image;

                    var formEditContent = $("#formEditCourse");

                    formEditContent.find("#hdnCourseID").val(courseID);
                    formEditContent.find("#category_id").val(category);
                    formEditContent.find("#course_name").val(name);
                    formEditContent.find("#course_description").val(desc);
                    formEditContent.find("#course_benefit").val(benefit);
                    formEditContent.find("#course_price").val(price);
                    formEditContent.find(".picture_image").attr("src", picture);
                }
            });
        });

        $("#formEditCourse").submit(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var id = $(this).find("#hdnCourseID").val();
            var name = $(this).find("#course_name").val();
            var category = $(this).find("#category_id").val();
            var desc = $(this).find("#content_desc").val();
            var benefit = $(this).find("#content_benefit").val();
            var price = $(this).find("#course_price").val();
            var picture = $(this).find("#picture")[0].files[0];

            if (!picture) {
                $.ajax({
                    // url: "" +
                    //     id,
                    type: "PATCH",
                    data: {
                        '_token': csrfToken,
                        'course_category_id': category,
                        'course_name': name,
                        'course_description': desc,
                        'course_benefit': benefit,
                        'course_price': price,
                    },
                    success: function (data2) {
                        alert("Data Berhasil Diubah");

                        location.reload();
                    },
                    error: function (data2) {
                        console.log("gagal");
                    }
                })
            } else {
                let formData = new FormData();
                formData.append('image', picture);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        var imgUrl = data.image_url

                        $.ajax({
                        //     url: "" +
                        // id,
                            type: "PATCH",
                            data: {
                                '_token': csrfToken,
                                'course_category_id': category,
                                'course_name': name,
                                'course_description': desc,
                                'course_benefit': benefit,
                                'course_price': price,
                                'course_image': imgUrl
                            },
                            success: function (data2) {
                                alert("Data Berhasil Diubah");

                                location.reload();
                            },
                            error: function (data2) {
                                console.log("gagal");
                            }
                        })

                    },
                    error: function (data) {
                        console.log("Upload gagal", data);
                    }
                });
            }

        });

        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');

                var id = item.find(".hdnCourseID").val();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    // url: "" +
                    //     id,
                    type: "DELETE",
                    data: {
                        '_token': csrfToken,
                    },
                    success: function (data) {
                        alert("Data Berhasil Dihapus");
                        location.reload();
                    },
                    error: function (data) {
                        console.log("Gagal menghapus data");
                    }
                });
            }
        });
    });

</script>
@endsection
