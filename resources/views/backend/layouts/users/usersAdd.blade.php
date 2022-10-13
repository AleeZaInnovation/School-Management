@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Team</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <h3> Add Team Member
                <a class="btn btn-success my-3 float-sm-right" href="{{route('users.view')}}"><i class="fa fa-list"></i> Team List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{ route('users.store') }}" id="myForm">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                          <label for="role">Member Type</label>
                          <select id="role" name="role" id="role" class="form-control @error('role') Invalid @enderror">
                                <option value="">*Select Member Type*</option>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                          </select>
                          @error('role')
                          <strong class="alert alert-danger">{{ $message }}</strong>
                          @enderror
                    </div>                  
                    <div class="form-group col-md-4">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control @error('name') Invalid @enderror">
                          <font style="color: red;">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                    </div>
                    <div class="form-group col-md-4">
                          <label for="email">Email</label>
                          <input type="email" name="email" id="email" class="form-control">

                          <font style="color: red;">
                            {{($errors->has('email'))?($errors->first('email')):''}}</font>

                    </div>
                    <div class="form-group">
                          <input type="submit" name="submit" class="form-control btn btn-success btn-block">
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
          role: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          },
        },
        messages: {
          role: {
            required: "Please select role"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
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