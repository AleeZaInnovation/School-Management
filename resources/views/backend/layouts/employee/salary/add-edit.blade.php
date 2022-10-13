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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                
                <h3> 
                Employee Salary Increment
                <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.salary.view')}}"><i class="fa fa-list"></i> Employee List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{route('employee.salary.store' , $edits->id)}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">

                    <div class="form-group col-md-4">
                          <label for="increment_salary"> Increment Salary</label>
                          <input type="text" name="increment_salary"  class="form-control" placeholder="Increment" >
                          <font style="color:red "> {{($errors->has('increment_salary')) ? ($errors->first('increment_salary')): ''}} </font>
                    </div>
                    
                    <div class="form-group col-md-4">
                          <label for="effected_date"> Effected Date</label>
                          <input type="text" name="effected_date"  class="form-control singledatepicker" placeholder="Date" >
                          <font style="color:red "> {{($errors->has('effected_date')) ? ($errors->first('effected_date')): ''}} </font>
                    </div>

	                  <div class="form-group col-md-4" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-primary" >Submit</button>
	                  </div>
                  </div>
            </form>

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

  <script>
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
          "increment_salary": {
            required: true,
          },
          "effected_date": {
            required: true,
          },
        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>

  @endsection