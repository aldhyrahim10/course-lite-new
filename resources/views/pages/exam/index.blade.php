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
                  <li class="breadcrumb-item">Course</li>
                  <li class="breadcrumb-item active">Course Name</li>
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
                      <h3 class="card-title">Exam List</h3>
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
                                  
                                  <th>Exam Title</th>
                                  <th>Description</th>
                                  {{-- <th>Video</th> --}}
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id="courseExamTableBody">
                             
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
@endsection

@section('scripts')
    
@endsection