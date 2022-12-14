@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Assign Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Assign Subject</li>
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
                <h3> Assign Subject Details
                  <a class="btn btn-success my-3 float-sm-right" href="{{route('setups.assign.subject.view')}}"><i class="fa fa-list"></i>View Assign Subject </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <h4> <strong> Class Name : </strong> {{$items[0]['student_class']['name']}}</h4>
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Subject Name</th>
                      <th>Full Mark</th>
                      <th>Pass Mark</th>
                      <th>Subjective Mark</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($items as $key => $item)
                    <tr class="{{$item->id}}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item['subject']['name'] }}</td>
                      <td>{{ $item->full_mark }}</td>
                      <td>{{ $item->pass_mark }}</td>
                      <td>{{ $item->subjective_mark }}</td>
                      
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