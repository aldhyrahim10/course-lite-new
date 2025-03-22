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
                    <li class="breadcrumb-item active">{{ $courseName->course_name }}</li>
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
                                @foreach($courseExams as $item)
                                    <tr class="item-content">
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                            <input type="hidden" class="hdnCourseExamID" value="{{ $item->id }}">
                                        </td>

                                        <td>{{ $item->course_exam_title }}</td>
                                        <td>{!! $item->course_exam_description !!}</td>

                                        {{-- <td class="text-center">
                                    <video width="320" height="240" controls>
                                        <source src="{{ Storage::url($item->course_material_video) }}"
                                        type="video/mp4">
                                        </video>
                                        </td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.course-exam.show', ['id' => $courseName->id, 'idExam' => $item->id]) }}" class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <div class="btn btn-success btn-edit" data-toggle="modal"
                                                data-target="#modalEdit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </div>
                                            <div class="btn btn-danger btn-delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
