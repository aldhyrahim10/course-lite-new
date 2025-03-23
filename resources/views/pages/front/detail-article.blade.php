@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <img src="{{ Storage::url($article->article_image) }}"
                width="100%" height="500px" style="border-radius: 20px;" alt="{{ $article->article_title }}">
            <h3 class="mt-3">{{ $article->article_title }}</h3>
            <p class="mt-1" style="color: #ababab">{{ $article->category->article_category_name }}</p>
            <p class="desc mt-2">
                {!! $article->article_description !!}
            </p>
        </div>
        <div class="col-lg-4">
            
            <h4 class="mt-3">Article Lainnya</h4>
            <div class="row">
                @foreach ($articles as $item)
                    <div class="col-lg-12 mt-4">
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
