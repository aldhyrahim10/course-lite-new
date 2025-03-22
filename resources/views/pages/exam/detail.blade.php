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
                          <input type="radio" name="rboQuestion1" id="rboQuestion1" disabled value="" checked> jawaban 1 
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
                        <input type="radio" name="rboQuestion1" id="rboQuestion1" disabled value="" checked> jawaban 1 
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


@endsection

@section('scripts')

@endsection
