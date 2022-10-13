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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                
                <h3> 
                @if(isset($edits))
                Edit Employee Leave
                @else  
                Add Employee Leave
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.leave.view')}}"><i class="fa fa-list"></i> Employee Leave List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{(@$edits)?route('employee.leave.update' , $edits->id):route('employee.leave.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                          <label for="employee_id"> Employee Name</label>
                            <select name="employee_id" id="" class="form-control form-control-sm">
                              <option value="">Select Employee</option>
                              @foreach($employee as $item)
                              <option value="{{$item->id}}"  {{(@$edits->employee_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-4">
                              <label for="start_date"> Start Date <font style="color:red;">*</font> </label>
                              <input type="date" name="start_date" value="{{ @$edits->start_date}}"class="form-control form-control-sm "  placeholder="Start Date">                              
                    </div>
                    <div class="form-group col-md-4">
                              <label for="end_date"> End Date <font style="color:red;">*</font> </label>
                              <input type="date" name="end_date" value="{{ @$edits->end_date}}"class="form-control form-control-sm "  placeholder="End Date">                              
                    </div>
                    <div class="form-group col-md-8">
                          <label for="leave_purpose_id">Leave Purpose</label>
                            <select name="leave_purpose_id" id="leave_purpose_id" class="form-control form-control-sm">
                              <option value="">Select Leave Purpose</option>
                              @foreach($purpose as $item)
                              <option value="{{$item->id}}"  {{(@$edits->leave_purpose_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                              <option value="0">New Purpose</option>
                            </select>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Write Purpose" id="add_others" style="display: none">
                    </div>
	                  <div class="form-group col-md-4" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-primary btn-sm" >{{(@$edits)?'Update':'Submit'}}</button>
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
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#leave_purpose_id', function(){
      var leave_purpose_id = $(this).val();
      if(leave_purpose_id == '0'){
        $('#add_others').show();
      }else{
        $('#add_others').hide();
      }
    });
  });
</script>
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