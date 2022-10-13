@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Student</li>
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
                Promotion Student
                @else  
                Add Student
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('student.reg.view')}}"><i class="fa fa-list"></i> Student List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{route('student.reg.promotion.store' , $edits->student_id)}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                      <input type="hidden" name="id" value="{{@$edits->id}}">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                              <label for="name"> Student Name <font style="color:red;">*</font> </label>
                              <input type="text" name="name" value="{{ @$edits['student']['name']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('name')) ? ($errors->first('name')): ''}}</font>
                        </div>                    
                        <div class="form-group col-md-4">
                              <label for="fname"> Father's Name <font style="color:red;">*</font> </label>
                              <input type="text" name="fname" value="{{ @$edits['student']['fname']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('fname')) ? ($errors->first('fname')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="mname"> Mother's Name <font style="color:red;">*</font> </label>
                              <input type="text" name="mname" value="{{ @$edits['student']['mname']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('mname')) ? ($errors->first('mname')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="mobile"> Mobile No <font style="color:red;">*</font> </label>
                              <input type="text" name="mobile" value="{{ @$edits['student']['mobile'] }}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('mobile')) ? ($errors->first('mobile')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="address"> Address  <font style="color:red;">*</font> </label>
                              <input type="text" name="address" value="{{ @$edits['student']['address']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('address')) ? ($errors->first('address')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="gender"> Gender  <font style="color:red;">*</font> </label>
                                <select name="gender" id="" class="form-control form-control-sm">
                                  <option value="">Select Gender </option>                              
                                  <option value="Male" {{(@$edits['student']['gender']=="Male")?"selected":""}}>Male </option>
                                  <option value="Female" {{(@$edits['student']['gender']=="Female")?"selected":""}} >Female</option>                              
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="religion"> Religion  <font style="color:red;">*</font> </label>
                                <select name="religion" id="" class="form-control form-control-sm">
                                  <option value="">Select Religion </option>                              
                                  <option value="Islam" {{(@$edits['student']['religion']=="Islam")?"selected":""}} >Islam </option>
                                  <option value="Hindu" {{(@$edits['student']['religion']=="Hindu")?"selected":""}} > Hindu </option>
                                  <option value="Cristan" {{(@$edits['student']['religion']=="Cristan")?"selected":""}} > Cristan </option>                               
                                </select>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="dob"> Date of Birth  <font style="color:red;">*</font> </label>
                              <input type="text" name="dob" value="{{ @$edits['student']['dob']}}"class="form-control form-control-sm singledatepicker" autocomplete="off" >
                              <font style="color:red "> {{($errors->has('dob')) ? ($errors->first('dob')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="discount"> Discount  <font style="color:red;">*</font> </label>
                              <input type="text" name="discount" value="{{ @$edits['discount']['discount']}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('discount')) ? ($errors->first('discount')): ''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="year"> Year <font style="color:red;">*</font> </label>
                            <select name="year_id" id="" class="form-control form-control-sm">
                              <option value="">Select Year</option>
                              @foreach($year as $item)
                              <option value="{{$item->id}}"  {{(@$edits->year_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="class"> Class <font style="color:red;">*</font> </label>
                            <select name="class_id" id="" class="form-control form-control-sm">
                              <option value="">Select Class</option>
                              @foreach($class as $item)
                              <option value="{{$item->id}}"   {{(@$edits->class_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>                        
                        <div class="form-group col-md-4">
                            <label for="group"> Group</label>
                            <select name="group_id" id="" class="form-control form-control-sm">
                              <option value="">Select Group</option>
                              @foreach($group as $item)
                              <option value="{{$item->id}}" {{(@$edits->group_id==$item->id)?"selected":""}} >{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="shift"> Shift</label>
                            <select name="shift_id" id="" class="form-control form-control-sm">
                              <option value="">Select Shift</option>
                              @foreach($shift as $item)
                              <option value="{{$item->id}}" {{(@$edits->shift_id==$item->id)?"selected":""}} >{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
	                        <label for="image">Image</label>
	                        <input type="file" name="image" class="form-control form-control-sm" id="image">
                        </div>
                        <div class="form-group col-md-2">
	                        <img id="showImage" src=" {{(!empty($edits['student']['image']))?url('public/assets/backend/images/student/'.$edits['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;">
	                  </div>
                      </div>
                      <button type="submit" class="btn btn-primary" >{{(@$edits)?'Promotion':'Submit'}}</button>
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
          "gender": {
            required: true,
          },
          "religion": {
            required: true,
          },
          "dob": {
            required: true,
          },
          "discount": {
            required: true,
          },
          "class_id": {
            required: true,
          },
          "year_id": {
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