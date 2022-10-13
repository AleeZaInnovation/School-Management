
@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Grade Point</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Grade Point</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3> Grade Point List
                  <a class="btn btn-success my-3 float-sm-right" href="{{route('mark.grade.add')}}"><i class="fa fa-plus-circle"></i>Add Grade Point </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Grade Name</th>
                        <th>Grade Point</th>
                        <th>Start Marks</th>
                        <th>End Marks</th>
                        <th>Point Range</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $key => $item)
                        <tr class="{{$item->id}}">
                          <td>{{ $key+1 }}</td>
                          <td>{{$item->grade_name}}</td>
                          <td>{{number_format((float)$item->grade_point,2)}}</td>
                          <td>{{$item->start_marks}}</td>
                          <td>{{$item->end_marks}}</td>
                          <td>{{number_format((float)$item->start_point,2)}} - {{number_format((float)$item->end_point,2)}}</td>
                          <td>{{$item->remarks}}</td>
                          <td>
                            <a title="Edit" class="btn btn-sm btn-success" href="{{ route('mark.grade.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                            <a title="Details" target="_blank" class="btn btn-sm btn-primary" href="{{ route('employee.attend.details', $item->id) }}"><i class="fa fa-eye"></i></a>
                          </td>                          
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection