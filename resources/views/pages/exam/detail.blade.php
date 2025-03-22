@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Course Exam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Exam</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
            Add Data
        </button>
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="row justify-content-between" style="align-items: center">
                            <h3 class="card-title">Soal No. 1</h3>
                            <div>
                                <div class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalEdit">
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                                <div class="btn btn-danger btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="question">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae nobis suscipit
                                distinctio earum voluptate ex deserunt molestiae illo facilis quaerat aspernatur
                                veritatis praesentium sapiente, laboriosam eveniet commodi quo, dicta asperiores.</p>
                        </div>
                        <div class="answer">
                            <input type="radio" name="rboQuestion1" id="rboQuestion1" disabled value="" checked> jawaban
                            1
                            <br>
                            <input type="radio" name="rboQuestion1" id="rboQuestion1" disabled value=""> jawaban 2
                            <br>
                            <input type="radio" name="rboQuestion1" id="rboQuestion1" disabled value=""> jawaban 3
                            <br>
                            <input type="radio" name="rboQuestion1" id="rboQuestion1" disabled value=""> jawaban 4
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="row justify-content-between" style="align-items: center">
                            <h3 class="card-title">Soal No. 2</h3>
                            <div>
                                <div class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalEdit">
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                                <div class="btn btn-danger btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="question">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae nobis suscipit
                                distinctio earum voluptate ex deserunt molestiae illo facilis quaerat aspernatur
                                veritatis praesentium sapiente, laboriosam eveniet commodi quo, dicta asperiores.</p>
                        </div>
                        <div class="answer">
                            <input type="radio" name="rboQuestion2" id="rboQuestion2" disabled value="" checked> jawaban
                            1
                            <br>
                            <input type="radio" name="rboQuestion2" id="rboQuestion2" disabled value=""> jawaban 2
                            <br>
                            <input type="radio" name="rboQuestion2" id="rboQuestion2" disabled value=""> jawaban 3
                            <br>
                            <input type="radio" name="rboQuestion2" id="rboQuestion2" disabled value=""> jawaban 4
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
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
                    {{-- <input type="hidden" name="course_id" value="{{ $courseName->id }}">
                    --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question</label>
                                <textarea name="course_exam_description" id="course_exam_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer</label>
                                <div class="row">
                                    <div class="col-lg-6 mt-2 d-flex">
                                        <input type="text" class="form-control" name="course_exam_title"
                                            id="course_exam_title" placeholder="Enter Exam Name"> <input type="checkbox" class="ml-1" name="is_true" id="is_true">
                                    </div>
                                    <div class="col-lg-6 mt-2 d-flex">
                                        <input type="text" class="form-control" name="course_exam_title"
                                            id="course_exam_title" placeholder="Enter Exam Name"> <input type="checkbox" class="ml-1" name="is_true" id="is_true">
                                    </div>
                                    <div class="col-lg-6 mt-2 d-flex">
                                        <input type="text" class="form-control" name="course_exam_title"
                                            id="course_exam_title" placeholder="Enter Exam Name"> <input type="checkbox" class="ml-1" name="is_true" id="is_true">
                                    </div>
                                    <div class="col-lg-6 mt-2 d-flex">
                                        <input type="text" class="form-control" name="course_exam_title"
                                            id="course_exam_title" placeholder="Enter Exam Name"> <input type="checkbox" class="ml-1" name="is_true" id="is_true">
                                    </div>

                                </div>
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


@endsection

@section('scripts')

@endsection
