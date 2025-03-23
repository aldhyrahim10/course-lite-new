@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
            <img src="{{ Storage::url($course->course_image) }}"
                width="100%" height="500px" style="border-radius: 20px;" alt="{{ $course->course_name }}">
            <h3 class="mt-3">{{ $course->course_name }}</h3>
            <p class="mt-1" style="color: #ababab">{{ $course->courseCategory->course_category_name }}</p>
            <p class="desc mt-2">
                {!! $course->course_description !!}
            </p>
            <p style="font-weight: 500; font-size: 20px;" class="mt-3">Benefit</p>
            <p class="desc mt-1">
                {!! $course->course_benefit !!}
            </p>
        </div>
        <div class="col-lg-4">
            <div class="card-product shadow">
                <div class="card-content p-4">
                    <p class="title">{{ $course->course_name }}</p>
                    <p class="mt-2 category">{{ $course->courseCategory->course_category_name }}</p>
                    <p class="mt-2 course-price">Rp {{ number_format($course->course_price, 0, ',', '.') }}</p>
                    @auth
                        @if ($recordExist)
                            <div class="btn btn-secondary w-100 mt-3">Sudah Bergabung</div>
                        @else               
                            <div class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Enroll Course
                            </div>
                        @endif
                    @endauth

                    @guest
                        <div class="alert alert-warning">
                            Please log in to enroll in the course.
                        </div>
                    @endguest
                </div>
            </div>
            <h4 class="mt-3">Course Lainnya</h4>
            <div class="row">
                @foreach ($courses as $item)
                    <div class="col-lg-12 mt-4">
                        <a style="text-decoration: none;" href="{{ route('courses-detail-page', $item->id) }}">
                            <div class="card-product shadow">
                                <img src="{{ Storage::url($item->course_image) }}"
                                    width="100%" height="200px"
                                    style="border-top-left-radius: 10px; border-top-right-radius: 10px;" alt="{{ $item->course_name }}">
                                <div class="card-content p-2">
                                    <h4 class="title">
                                        {{ $item->course_name }}
                                    </h4>
                                    <p class="category">
                                        {{ $item->courseCategory->course_category_name }}
                                    </p>
                                    <p class="price">
                                        Rp {{ number_format($item->course_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enroll Course</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin mengambil course ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Enroll Course</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#exampleModal .btn-primary").click(function (e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var courseId = $("#course_id").val();
            var priceText = $(".card-content .course-price").text();
            var totalPayment = priceText.replace(/[^\d]/g, '');

            console.log(totalPayment);
            
            $.ajax({
                url: "{{ route('admin.enroll-course.store') }}",
                type: "POST",
                data: {
                    '_token': csrfToken,
                    'course_id': courseId,
                    'total_payment': totalPayment
                },
                success: function (response) {
                    alert("Data Berhasil Ditambahkan");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("Error saving course category:", xhr.responseText);
                    alert("Failed to save category. Please try again.");
                }
            });
        });
        })
    </script>
@endsection
