@extends('layouts.exam')

@section('content')
<input type="hidden" class="hdnCourseID" value="{{ $course_id }}">
<div class="container-fluid p-4">
    <div class="row form-question">
        @foreach($courseAnswers as $item)
            <div class="col-12">
                <div class="card item-content">
                    <div class="card-header ">
                        <div class="row justify-content-between" style="align-items: center">
                            <h3 class="card-title">Soal No. {{ $loop->iteration }}</h3>
                            <input type="hidden" class="hdnCourseExamID" value="{{ $item->id }}">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="question">
                            <p>{!! $item->course_exam_question_description !!}</p>
                        </div>
                        <div class="answer">
                            @foreach($item->answers as $item2)
                                <div>
                                    <input type="radio" name="rboQuestion{{ $item->id }}"
                                        id="rboQuestion{{ $item->id }}" value="{{ $item2->id }}"
                                        displaytext="{{ $item2->course_exam_answer_description }}"
                                        is-true="{{ $item2->is_true }}">
                                    {{ $item2->course_exam_answer_description }}
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
    <div class="row justify-content-center">
        <div class="btn btn-primary m-2 " id="btnSubmit">
            Submit
        </div>
        <div class="btn btn-danger m-2 ">
            Batal
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#btnSubmit").click(function () {
            if (confirm("Apakah sudah yakin dengan jawaban anda?")) {

                var studentUserId = {{ Auth::user()->id }};
                var formQuestion = $(".form-question");

                var countQuestion = formQuestion.find(".col-12").length;
                var countTrue = 0;

                formQuestion.find(".col-12").each(function () {
                    var questionID = $(this).find(".hdnCourseExamID").val();
                    var selectedRadio = $(this).find("#rboQuestion" + questionID + ":checked");

                    var selectedAnswer = selectedRadio.attr("displaytext");
                    var isTrue = selectedRadio.attr("is-true");

                    if (selectedAnswer !== undefined) {
                        // Konversi ke integer agar lebih akurat
                        if (parseInt(isTrue) === 1) {
                            countTrue += 1;
                        }
                    }
                });

                var pointInDecimal = countTrue / countQuestion;
                var pointInInteger = Math.round(pointInDecimal * 100); // Dibulatkan

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var courseID = $(".hdnCourseID").val();
                var isPassed = pointInInteger >= 65; // Jika >= 65, isPassed = true

                // Satu AJAX request untuk semua kondisi
                $.ajax({
                    url: "{{ route('admin.exam-result.store') }}",
                    type: "POST", // Perbaikan type POST
                    data: {
                        '_token': csrfToken,
                        'course_id': courseID,
                        'student_user_id': studentUserId,
                        'course_exam_point': pointInInteger,
                        'is_passed': isPassed ? 1 : 0
                    },
                    success: function (response) {
                        alert("Sukses, data exam berhasil terkumpul");
                        window.close();
                    },
                    error: function (response) {
                        alert("Terjadi kesalahan, coba lagi.");
                    }
                });

            }
        });
    });

</script>
@endsection
