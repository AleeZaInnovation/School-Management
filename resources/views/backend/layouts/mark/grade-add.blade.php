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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                
                <h3> 
                @if(isset($edits))
                Edit Grade Point
                @else  
                Add Grade Point
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('student.reg.view')}}"><i class="fa fa-list"></i> Grade Point List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{(@$edits)?route('mark.grade.update' , $edits->id):route('mark.grade.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                      <input type="hidden" name="id" value="{{@$edits->id}}">
                      <div class="form-row">
                        <div class="form-group col-md-4">                          
                              <label for="grade_name"> Grade Name <font style="color:red;">*</font> </label>
                              <input type="text" name="grade_name" value="{{ @$edits['grade_name']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('grade_name')) ? ($errors->first('grade_name')): ''}}</font>
                        </div>  
                        <div class="form-group col-md-4">
                              <label for="grade_point"> Grade Point<font style="color:red;">*</font> </label>
                              <input type="text" name="grade_point" value="{{ @$edits['grade_point']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('grade_point')) ? ($errors->first('grade_point')): ''}}</font>
                        </div>                        
                        <div class="form-group col-md-4">
                              <label for="start_marks"> Start Marks <font style="color:red;">*</font> </label>
                              <input type="text" name="start_marks" value="{{ @$edits['start_marks']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('start_marks')) ? ($errors->first('start_marks')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="end_marks"> End Marks<font style="color:red;">*</font> </label>
                              <input type="text" name="end_marks" value="{{ @$edits['end_marks'] }}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('end_marks')) ? ($errors->first('mobile')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="start_point"> Point Start<font style="color:red;">*</font> </label>
                              <input type="text" name="start_point" value="{{ @$edits['start_point']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('start_point')) ? ($errors->first('start_point')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="end_point"> Point End<font style="color:red;">*</font> </label>
                              <input type="text" name="end_point" value="{{ @$edits['end_point']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('end_point')) ? ($errors->first('end_point')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="remarks"> Remarks <font style="color:red;">*</font> </label>
                              <input type="text" name="remarks" value="{{ @$edits['remarks']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('remarks')) ? ($errors->first('remarks')): ''}}</font>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary" >{{(@$edits)?'Update':'Submit'}}</button>
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
          "grade_name": {
            required: true,
          },
          "grade_point": {
            required: true,
          },
          "start_marks": {
            required: true,
          },
          "end_marks": {
            required: true,
          },
          "start_point": {
            required: true,
          },
          "end_point": {
            required: true,
          },
          "remarks": {
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
