@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                Edit Employee
                @else  
                Add Employee
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.reg.view')}}"><i class="fa fa-list"></i> Employee List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{(@$edits)?route('employee.reg.update' , $edits->id):route('employee.reg.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                      <div class="form-row">
                        <div class="form-group col-md-4">
                              <label for="name"> Employee Name <font style="color:red;">*</font> </label>
                              <input type="text" name="name" value="{{ @$edits->name}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('name')) ? ($errors->first('name')): ''}}</font>
                        </div>                    
                        <div class="form-group col-md-4">
                              <label for="fname"> Father's Name <font style="color:red;">*</font> </label>
                              <input type="text" name="fname" value="{{ @$edits->fname}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('fname')) ? ($errors->first('fname')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="mname"> Mother's Name <font style="color:red;">*</font> </label>
                              <input type="text" name="mname" value="{{ @$edits->mname}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('mname')) ? ($errors->first('mname')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="mobile"> Mobile No <font style="color:red;">*</font> </label>
                              <input type="text" name="mobile" value="{{ @$edits->mobile}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('mobile')) ? ($errors->first('mobile')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="address"> Address  <font style="color:red;">*</font> </label>
                              <input type="text" name="address" value="{{ @$edits->address}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('address')) ? ($errors->first('address')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="gender"> Gender  <font style="color:red;">*</font> </label>
                                <select name="gender" id="" class="form-control form-control-sm">
                                  <option value="">Select Gender </option>                              
                                  <option value="Male" {{(@$edits->gender=="Male")?"selected":""}}>Male </option>
                                  <option value="Female" {{(@$edits->gender=="Female")?"selected":""}} >Female</option>                              
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="religion"> Religion  <font style="color:red;">*</font> </label>
                                <select name="religion" id="" class="form-control form-control-sm">
                                  <option value="">Select Religion </option>                              
                                  <option value="Islam" {{(@$edits->religion =="Islam")?"selected":""}} >Islam </option>
                                  <option value="Hindu" {{(@$edits->religion =="Hindu")?"selected":""}} > Hindu </option>
                                  <option value="Cristan" {{(@$edits->religion =="Cristan")?"selected":""}} > Cristan </option>                               
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="dob"> Date of Birth  <font style="color:red;">*</font> </label>
                              <input type="text" name="dob" value="{{ @$edits->dob}}"class="form-control form-control-sm singledatepicker" autocomplete="off" >
                              <font style="color:red "> {{($errors->has('dob')) ? ($errors->first('dob')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="designation"> Designation <font style="color:red;">*</font> </label>
                            <select name="designation_id" id="" class="form-control form-control-sm">
                              <option value="">Select Designation</option>
                              @foreach($designation as $item)
                              <option value="{{$item->id}}"  {{(@$edits->designation_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        @if(!@$edits)
                        <div class="form-group col-md-3">
                              <label for="join_date"> Join Date  <font style="color:red;">*</font> </label>
                              <input type="text" name="join_date" value="{{ @$edits->join_date}}"class="form-control form-control-sm singledatepicker" autocomplete="off" >
                              <font style="color:red "> {{($errors->has('join_date')) ? ($errors->first('join_date')): ''}}</font>
                        </div>                       
                        <div class="form-group col-md-3">
                              <label for="salary"> Salary  <font style="color:red;">*</font> </label>
                              <input type="text" name="salary" value="{{ @$edits->salary}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('salary')) ? ($errors->first('salary')): ''}}</font>
                        </div>
                        @endif                        
                        <div class="form-group col-md-3">
	                        <label for="image">Image</label>
	                        <input type="file" name="image" class="form-control form-control-sm" id="image">
                        </div>
                        <div class="form-group col-md-2">
	                        <img id="showImage" src=" {{(!empty($edits->image))?url('public/assets/backend/images/employee/'.$edits->image):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;">
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
          "name": {
            required: true,
          },
          "fname": {
            required: true,
          },
          "mname": {
            required: true,
          },
          "mobile": {
            required: true,
          },
          "address": {
            required: true,
          },
          "gender": {
            required: true,
          },
          "religion": {
            required: true,
          },
          "dob": {
            required: true,
          },
          "designation_id": {
            required: true,
          },
          "salary": {
            required: true,
          },
          "join_date": {
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