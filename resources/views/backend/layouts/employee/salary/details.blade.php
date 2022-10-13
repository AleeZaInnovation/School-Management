@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employee Salary Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"> Employee Salary </li>
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
                Employee Salary Info
                <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.salary.view')}}"><i class="fa fa-list"></i> Employee List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <table width="100%">
                    <tr>                          
                        <td  style="text-align: left;" width="80%" >
                        <strong > Employee Name:</strong> {{$details->name}}
                        </td>
                        <td  style="text-align: right;" width="80%" >
                        <strong > Employee Id No:</strong> {{$details->id_no}}
                        </td>                          
                    </tr>
                  </table>
                  <br>
                <div class="tab-content p-0">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th> S.L </th>
                      <th> Prvious Salary </th>
                      <th> Increment Salary </th>
                      <th> Present Salary </th>
                      <th> Effected Date </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($salary as $key => $item)
                      <tr>
                        @if($key=="0")
                        <td style="text-align: right;" width="80%" colspan="5"><strong > Joining Salary :</strong> TK {{ number_format($item->previous_salary,2)}}</td>
                        @else
                        <td>{{ $key }} </td>
                        <td> TK {{ number_format( $item->previous_salary,2)}}</td>
                        <td> TK {{ number_format( $item->increment_salary,2)}}</td>
                        <td> TK {{ number_format( $item->present_salary,2)}}</td>
                        <td> {{date('d-m-Y',strtotime($item->effected_date))}} </td>
                        @endif
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