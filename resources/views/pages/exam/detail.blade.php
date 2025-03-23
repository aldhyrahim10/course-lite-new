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
            @foreach ($courseAnswers as $item)
                <div class="col-12">
                    <div class="card item-content">
                        <div class="card-header ">
                            <div class="row justify-content-between" style="align-items: center">
                                <h3 class="card-title">Soal No. {{ $loop->iteration }}</h3>
                                <input type="hidden" class="hdnCourseExamID" value="{{ $item->id }}">
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
                                <p>{!! $item->course_exam_question_description !!}</p>
                            </div>
                            <div class="answer">
                                @foreach ($item->answers as $item)
                                    <div>
                                        @if($item->is_true)
                                            <input type="hidden" name="is_true" value="{{ $item->is_true }}">
                                            <input type="radio" name="rboQuestion{{ $loop->iteration }}" id="rboQuestion{{ $loop->iteration }}" value="{{ $item->id }}" disabled checked >
                                            {{ $item->course_exam_answer_description }}
                                        @else
                                            <input type="hidden" name="is_true" value="{{ $item->is_true }}">
                                            <input type="radio" name="rboQuestion{{ $loop->iteration }}" id="rboQuestion{{ $loop->iteration }}" value="{{ $item->id }}" disabled>
                                            {{ $item->course_exam_answer_description }}
                                        @endif
                                        <br>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            @endforeach
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
                    <input type="hidden" name="course_exam_id" value="{{ $courseExam->id }}">
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question</label>
                                <textarea name="course_exam_question_description" id="course_exam_question_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer</label>
                                <div class="row">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="col-lg-6 mt-2">
                                            <div class="input-answer d-flex">
                                                <input type="text" class="form-control" name="course_exam_answer_description[{{ $i }}]"
                                                    id="course_exam_answer_description" placeholder="Enter Answer {{$i+1}}"> 
                                                <input type="checkbox" class="ml-1" name="is_true" id="is_true[{{ $i }}]" value="1">
                                            </div>
                                        </div>
                                    @endfor
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
                    <input type="hidden" name="course_exam_id" value="{{ $courseExam->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question</label>
                                <textarea name="course_exam_question_description" id="course_exam_question_description"
                                    class="form-control content-desc-add" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer</label>
                                <div class="row">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="col-lg-6 mt-2">
                                            <div class="input-answer d-flex">
                                                <input type="text" class="form-control" name="course_exam_answer_description[{{ $i }}]"
                                                    id="course_exam_answer_description" placeholder="Enter Answer {{$i+1}}"> 
                                                <input type="checkbox" class="ml-1" name="is_true" id="is_true[{{ $i }}]" value="1">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#formAddExam').submit(function (e) {
            e.preventDefault();

            let formData = {
                course_exam_id: $('input[name="course_exam_id"]').val(),
                course_exam_question_description: $('#course_exam_question_description').val(),
                answers: [] // Initialize an empty array for answers
            };

            $(this).('.input-answer').each(function(index) {
                let answerText = $(this).find('input[type="text"]').val() || '';
                let is_true = $(this).find('input[type="checkbox"]').is(':checked');
                
                formData.answers.push({
                    course_exam_answer_description: answerText,
                    is_true: is_true ? 1 : 0
                });
            });

            console.log(formData);
            
            $.ajax({
                url: "{{ route('admin.course-exam-question.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Data Berhasil Ditambahkan");
                    location.reload();
                },
                error: function (error) {
                    console.error("Error:", error);
                    alert("Gagal menambahkan data");
                }
            });
        });

        $(".btn-edit").click(function () {
            // Get the question ID from the data attribute
            var item = $(this).closest('.item-content');
            var id = item.find(".hdnCourseExamID").val();
            
            $.ajax({
                url: "{{ route('admin.course-exam-question.edit') }}",
                type: "GET",
                data: {
                    'query': id
                },
                success: function (data) {
                    var formEditContent = $("#formEditExam");
                    
                    // Set question ID and description
                    formEditContent.find("#hdnCourseExamID").val(data.id);
                    formEditContent.find("#course_exam_question_description").val(data.course_exam_question_description);
                    
                    // Clear all checkboxes first
                    formEditContent.find('input[type="checkbox"]').prop('checked', false);
                    
                    // Set answer values and checkboxes
                    if (data.answers && data.answers.length > 0) {
                        for (var i = 0; i < Math.min(data.answers.length, 4); i++) {
                            formEditContent.find('input[name="course_exam_answer_description[' + i + ']"]')
                                .val(data.answers[i].course_exam_answer_description);
                            
                            if (data.answers[i].is_true == 1) {
                                formEditContent.find('#is_true\\[' + i + '\\]').prop('checked', true);
                            }
                        }
                        
                        // Clear any remaining answer fields if there are less than 4 answers
                        for (var i = data.answers.length; i < 4; i++) {
                            formEditContent.find('input[name="course_exam_answer_description[' + i + ']"]').val('');
                        }
                    }
                },
                error: function (xhr) {
                    console.error("Error fetching question data:", xhr.responseText);
                    alert("Gagal mengambil data");
                }
            });
        });

        $('#formEditExam').submit(function (e) {
            e.preventDefault();

            var id = $(this).find("#hdnCourseExamID").val();
            var questionDescription = $(this).find("#course_exam_question_description").val();

            let formData = {
                id: $('#hdnCourseExamID').val(),
                course_exam_id: $('input[name="course_exam_id"]').val(),
                course_exam_question_description: questionDescription,
                answers: [], // Initialize an empty array for answers
                _method: 'PATCH'
            };

            $(this).('.input-answer').each(function(index) {
                let answerText = $(this).find('input[type="text"]').val() || '';
                let is_true = $(this).find('input[type="checkbox"]').is(':checked');
                
                // Only include non-empty answers
                if (answerText.trim() !== '') {
                    formData.answers.push({
                        course_exam_answer_description: answerText,
                        is_true: is_true ? 1 : 0
                    });
                }
            });

            console.log(formData);
            
            $.ajax({
                url: "{{ route('admin.course-exam-question.update', '') }}/" + id,
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Data Berhasil Diperbarui");
                    location.reload();
                },
                error: function (error) {
                    console.error("Error:", error);
                    alert("Gagal memperbarui data");
                }
            });
        });

        $(".btn-delete").click(function () {
            if (confirm("Apakah Anda ingin menghapus data ini?")) {
                var item = $(this).closest('.item-content');
                var id = item.find(".hdnCourseExamID").val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('admin.course-exam-question.destroy', '') }}/" +
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
