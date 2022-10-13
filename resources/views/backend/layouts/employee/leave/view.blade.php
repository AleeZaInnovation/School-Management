@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Leave</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee Leave</li>
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
                <h3> Employee Leave List
                  <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.leave.add')}}"><i class="fa fa-plus-circle"></i>Add Employee Leave </a>
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
                      <th>Purpose</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key => $item)
                    <tr class="{{$item->id}}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item['user']['name']}}</td>
                      <td>{{ $item['user']['id_no'] }}</td>
                      <td>{{ $item['purpose']['name'] }}</td>
                      <td>{{ date('d-m-Y',strtotime($item->start_date)) }} to {{ date('d-m-Y',strtotime($item->end_date)) }}</td>
                      <td>
                        <a title="Edit" class="btn btn-sm btn-success" href="{{ route('employee.leave.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                        <!-- <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{ route('setups.designation.delete', $item->id) }}" data-token="{{csrf_token()}}" data-id="{{$item->id}}"><i class="fa fa-trash"></i></a> -->
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