@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee Salary</li>
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
                <h3> Employee List
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
                      <th>Mobile No</th>
                      <th>Addrss</th>
                      <th>Gender</th>
                      <th>Join Date</th>
                      <th>Salary</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key => $item)
                    <tr class="{{$item->id}}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->id_no }}</td>
                      <td>{{ $item->mobile }}</td>
                      <td>{{ $item->address }}</td>
                      <td>{{ $item->gender }}</td>
                      <td>{{ date('d-m-Y', strtotime($item->join_date)) }}</td>
                      <td>{{ $item->salary }}</td>
                      <td>
                        <a title="Salary Increment" class="btn btn-sm btn-success" href="{{ route('employee.salary.increment', $item->id) }}"><i class="fa fa-plus"></i></a>
                        <a title="Salary View" class="btn btn-sm btn-primary" href="{{ route('employee.salary.details', $item->id) }}"><i class="fa fa-eye"></i></a>
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