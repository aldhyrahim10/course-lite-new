@extends('layouts.front')

@section('content')
<div class="">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div style="" class="carousel-item active">
        <img src="https://png.pngtree.com/thumb_back/fh260/background/20211225/pngtree-mountain-sunset-minimalist-landscape-scenery-wallpaper-full-hd-4k-8k-images-image_934390.jpg" class="d-block w-100" alt="..." width="100%" height="500px">
      </div>
      <div style="" class="carousel-item">
        <img src="https://img.pikbest.com/backgrounds/20250102/beautiful-river-anime-wallpapers-in-ultra-hd-4k-quality_11331653.jpg!w700wp" class="d-block w-100" alt="..." width="100%" height="500px">
      </div>
      <div style="" class="carousel-item">
        <img src="https://i.pinimg.com/736x/ec/b9/2d/ecb92d18c7855c986a5571c1b6f7cad2.jpg" class="d-block w-100" alt="..." width="100%" height="500px">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<div class="container mt-3 mb-3">
  <h3>News Courses</h3>
  <div class="row">
    @forelse ($courses as $item)
      <div class="col-lg-3">
        <a href="{{ route('courses-detail-page', $item->id) }}" style="text-decoration: none;">
          <div class="card-product shadow">
            <img src="{{ Storage::url($item->course_image) }}" alt="{{ $item->course_name }}" width="100%" height="200px" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
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

<div class="container mt-3 mb-3">
  <h3>News Articles</h3>
  <div class="row">
    @forelse ($articles as $item)
      <div class="col-lg-3">
        <a href="{{ route('articles-detail-page', $item->id) }}" style="text-decoration: none;">
          <div class="card-product shadow">
            <img src="{{ Storage::url($item->article_image) }}" width="100%" height="200px" style="border-top-left-radius: 10px; border-top-right-radius: 10px;" alt="{{ $item->article_title }}">
            <div class="card-content p-2">
              <h4 class="title">
                {{ $item->article_title }}
              </h4>
              <p class="category">
                {{ $item->category->article_category_name }}
              </p>
              <p >
                {!! $item->article_description !!}
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