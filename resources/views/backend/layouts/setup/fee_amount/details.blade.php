@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Fee Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Fee Details</li>
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
                <h3> Fee Amount Details
                  <a class="btn btn-success my-3 float-sm-right" href="{{route('setups.student.fee.amount.view')}}"><i class="fa fa-list"></i>View Fee Amount </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <h4> <strong> Fee Category: </strong> {{$items[0]['fee_category']['name']}}</h4>
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Class Name</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($items as $key => $item)
                    <tr class="{{$item->id}}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item['student_class']['name'] }}</td>
                      <td>{{ $item->amount }}</td>
                      
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