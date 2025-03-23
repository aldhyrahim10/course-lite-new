@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <img src="https://png.pngtree.com/thumb_back/fh260/background/20211225/pngtree-mountain-sunset-minimalist-landscape-scenery-wallpaper-full-hd-4k-8k-images-image_934390.jpg"
                width="100%" height="500px" style="border-radius: 20px;" alt="">
            <h3 class="mt-3">Title Course</h3>
            <p class="mt-1" style="color: #ababab">Course Category</p>
            <p class="desc mt-2">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam blanditiis quod aliquam voluptates cum
                soluta veniam amet culpa reiciendis debitis quam quas aspernatur qui illum ea asperiores, earum
                recusandae error! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi aliquid nulla
                voluptas, nobis exercitationem, nemo quia doloribus, tenetur eos praesentium natus? Voluptatibus autem
                corrupti repellendus. Officiis repellendus nostrum nisi quisquam. Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Pariatur vitae eveniet animi doloribus alias ex, dolores ducimus et illum culpa
                delectus sit. Eum tempora reprehenderit soluta aperiam voluptatum sed animi.
            </p>
            <p style="font-weight: 500; font-size: 20px;" class="mt-3">Benefit</p>
            <p class="desc mt-1">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam blanditiis quod aliquam voluptates cum
                soluta veniam amet culpa reiciendis debitis quam quas aspernatur qui illum ea asperiores, earum
                recusandae error! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi aliquid nulla
                voluptas, nobis exercitationem, nemo quia doloribus, tenetur eos praesentium natus? Voluptatibus autem
                corrupti repellendus. Officiis repellendus nostrum nisi quisquam. Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Pariatur vitae eveniet animi doloribus alias ex, dolores ducimus et illum culpa
                delectus sit. Eum tempora reprehenderit soluta aperiam voluptatum sed animi.
            </p>
        </div>
        <div class="col-lg-4">
            <div class="card-product shadow">
                <div class="card-content p-4">
                    <p class="title">Course Title</p>
                    <p class="mt-2 category">Category</p>
                    <p class="mt-2 price">Rp 500.000,00</p>
                    <div class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Enroll Course</div>
                </div>
            </div>
            <h4 class="mt-3">Course Lainnya</h4>
            <div class="row">
                <div class="col-lg-12 mt-4">
                    <a style="text-decoration: none;" href="{{ route("courses-detail-page") }}">
                        <div class="card-product shadow">
                            <img src="https://png.pngtree.com/thumb_back/fh260/background/20211225/pngtree-mountain-sunset-minimalist-landscape-scenery-wallpaper-full-hd-4k-8k-images-image_934390.jpg"
                                width="100%" height="200px"
                                style="border-top-left-radius: 10px; border-top-right-radius: 10px;" alt="">
                            <div class="card-content p-2">
                                <h4 class="title">
                                    Title Course
                                </h4>
                                <p class="category">
                                    Category
                                </p>
                                <p class="price">
                                    Rp 500.000,00
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 mt-4">
                    <a style="text-decoration: none;" href="{{ route("courses-detail-page") }}">
                        <div class="card-product shadow">
                            <img src="https://png.pngtree.com/thumb_back/fh260/background/20211225/pngtree-mountain-sunset-minimalist-landscape-scenery-wallpaper-full-hd-4k-8k-images-image_934390.jpg"
                                width="100%" height="200px"
                                style="border-top-left-radius: 10px; border-top-right-radius: 10px;" alt="">
                            <div class="card-content p-2">
                                <h4 class="title">
                                    Title Course
                                </h4>
                                <p class="category">
                                    Category
                                </p>
                                <p class="price">
                                    Rp 500.000,00
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 mt-4">
                    <a style="text-decoration: none;" href="{{ route("courses-detail-page") }}">
                        <div class="card-product shadow">
                            <img src="https://png.pngtree.com/thumb_back/fh260/background/20211225/pngtree-mountain-sunset-minimalist-landscape-scenery-wallpaper-full-hd-4k-8k-images-image_934390.jpg"
                                width="100%" height="200px"
                                style="border-top-left-radius: 10px; border-top-right-radius: 10px;" alt="">
                            <div class="card-content p-2">
                                <h4 class="title">
                                    Title Course
                                </h4>
                                <p class="category">
                                    Category
                                </p>
                                <p class="price">
                                    Rp 500.000,00
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
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
