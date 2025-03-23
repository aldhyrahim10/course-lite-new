@extends('layouts.front')

@section('content')
<div class="container">
  <div class="mt-5">
    <h1 class="text-center">
      Courses
    </h1>
    <p class="text-center mt-2">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. 
      <br>
      Asperiores delectus nihil impedit consequatur dolor exercitationem ipsa a ipsam cumque 
  </div>

  <div class="form-search mt-5">
    <input type="text" class="form-control search" style="width: 60%; margin: auto; height: 60px;" placeholder="Search Courses...">
  </div>

  <div class="courses-all mt-5 row">
    @forelse ($courses as $item)
      <div class="col-lg-3 mt-4 item-content">
        <a style="text-decoration: none;" href="{{route("courses-detail-page", $item->id)}}">
          <div class="card-product shadow">
            <img src="{{ Storage::url($item->course_image) }}" width="100%" height="200px" style="border-top-left-radius: 10px; border-top-right-radius: 10px;" alt="{{ $item->course_name }}">
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
    @empty
      <div class="col-lg-12">
        <div class="alert alert-danger">
          Data not found
        </div>
      </div>
    @endforelse
  </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.form-control').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase();
        
        if(searchValue === '') {
            $('.item-content').show();
            $('.no-results').remove();
            return;
        }
        
        var visibleCount = 0;
        
        $('.item-content').each(function() {
            var courseName = $(this).find('.title').text().toLowerCase();
            
            if(courseName.indexOf(searchValue) > -1) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });
        
        if(visibleCount === 0) {
            $('.courses-all').append('<div class="col-lg-12 no-results alert alert-danger">Data not found</div>');
        } else {
            $('.no-results').remove();
        }
    });
});
</script>
@endsection