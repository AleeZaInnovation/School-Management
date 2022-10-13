@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Student Group</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Group</li>
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
                @if(isset($edits))
                Edit Student Group
                @else  
                Add Student Group
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('setups.student.group.view')}}"><i class="fa fa-list"></i> Student Group List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{(@$edits)?route('setups.student.group.update' , $edits->id):route('setups.student.group.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">

                    <div class="form-group col-md-6">
                          <label for="name"> Student Group Name</label>
                          <input type="text" name="name" value="{{ @$edits->name}}" class="form-control" required>
                          <font style="color:red "> {{($errors->has('name')) ? ($errors->first('name')): ''}}</font>
                    </div>                  

	                  <div class="form-group col-md-6" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-primary" >{{(@$edits)?'Update':'Submit'}}</button>
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
            name: {
            required: true,
            unique: true,
          },
        },
        messages: {
          name: {
            required: "Please enter class name"
            unique: "This class already enlisted"
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