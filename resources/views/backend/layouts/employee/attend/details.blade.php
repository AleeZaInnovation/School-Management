@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee Attendance</li>
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
                <h3> 
                <li ><a href="#">{{ date('d-m-Y',strtotime($details['0']['date'])) }} Employee Attendance
                
                <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.attend.view')}}"><i class="fa fa-list"></i> Employee Attendance List </a></a></li>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Name</th>
                        <th>Id No</th>
                        <th>Attend Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($details as $key => $item)
                        <tr class="{{$item->id}}">
                          <td>{{ $key+1 }}</td>
                          <td>{{ $item['user']['name']}}</td>
                          <td>{{ $item['user']['id_no'] }}</td>
                          <td>{{ $item->attend_status	}}</td>                          
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