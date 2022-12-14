@extends('backend.layouts.master')
@section('content')
<style type="text/css">
  .switch-toggle{
    width: auto;
  }

  .switch-toggle label:not(.disabled){
    cursor: pointer;
  }

  .switch-candy a {
    border: 1px solid #333;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset 0 1px 1px rgba(255,255,255,0.45);
    background-color: white;
    background-image: -webkit-linear-gradient(top,rgba(255,255,255,0.2),transparent);
    background-image: linear-gradient(to bottom,rgba(255,255,255,0.2),transparent);
  }

  .switch-toggle.switch-candy, .switch-light.switch-candy> span{
    background-color: #5a6268;
    border-radius: 3px;
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.3), 0 1px 0 rgba(255,255,255,0.2);
  }

</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee Attendance</li>
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
                Edit Employee Attendance
                @else  
                Add Employee Attendance
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('employee.attend.view')}}"><i class="fa fa-list"></i> Employee Attendance List </a>
               </h3>
              </div><!-- /.card-header -->
              <form method="post" action="{{route('employee.attend.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                  @if(isset($edits))
                    <div class="card-body">
                      <div class="form-group col-md-4" >
                        <label for="control-label">Attendance Date</label>
                        <input type="text" name="date" id="date" value="{{$edits['0']['date']}}" class="checkdate form-control form-control-sm " placeholder="Attendace Date" Readonly autocomplete="off" >
                      </div>
                      <table class="tavle-sm table-bordered table-striped dt-responsive" style="width: 100%">
                        <thead>
                          <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;"> SL.</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;"> Employee Name</th>
                            <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%"> Attendace Status</th>
                          </tr>
                          <tr>
                            <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;">Present</th>
                            <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190;">Leave</th>
                            <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190;">Absent</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($edits as $key=> $item)
                            <tr id="div{{$item->id}}" class="text-center">
                              <input type="hidden" name="employee_id[]" value="{{$item->employee_id}}" class="employee_id">
                              <td>{{$key+1}}</td>
                              <td>{{$item['user']['name']}}</td>
                              <td colspan="3">
                                <div class="switch-toggle switch-candy switch-3">
                                  <input type="radio" name="attend_status{{$key}}" id="present{{$key}}" value="Present" class="present" {{($item->attend_status=='Present')?'checked':''}}>
                                  <label for="present{{$key}}">Present</label>
                                  <input type="radio" name="attend_status{{$key}}" id="leave{{$key}}" value="Leave" class="leave" {{($item->attend_status=='Leave')?'checked':''}} >
                                  <label for="leave{{$key}}">Leave</label>
                                  <input type="radio" name="attend_status{{$key}}" id="absent{{$key}}" value="Absent" class="absent" {{($item->attend_status=='Absent')?'checked':''}} >
                                  <label for="absent{{$key}}">Absent</label> 
                                  <a></a> 
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                        
                      </table><br/>

                      <button type="submit" class="btn btn-primary btn-sm">{{(@$edits)?'Update':'Submit'}}</button>
                    </div><!-- /.card-body -->                  
                  @else  
                    <div class="card-body">
                      <div class="form-group col-md-4" >
                        <label for="control-label">Attendance Date</label>
                        <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" placeholder="Attendace Date" autocomplete="off" >
                      </div>
                      <table class="tavle-sm table-bordered table-striped dt-responsive" style="width: 100%">
                        <thead>
                          <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;"> SL.</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;"> Employee Name</th>
                            <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%"> Attendace Status</th>
                          </tr>
                          <tr>
                            <th class="text-center btn present_all" style="display: table-cell; background-color: #114190;">Present</th>
                            <th class="text-center btn leave_all" style="display: table-cell; background-color: #114190;">Leave</th>
                            <th class="text-center btn absent_all" style="display: table-cell; background-color: #114190;">Absent</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($employee as $key=> $item)
                            <tr id="div{{$item->id}}" class="text-center">
                              <input type="hidden" name="employee_id[]" value="{{$item->id}}" class="employee_id">
                              <td>{{$key+1}}</td>
                              <td>{{$item->name}}</td>
                              <td colspan="3">
                                <div class="switch-toggle switch-candy switch-3">
                                  <input type="radio" name="attend_status{{$key}}" id="present{{$key}}" value="Present" class="present" checked="checked">
                                  <label for="present{{$key}}">Present</label>
                                  <input type="radio" name="attend_status{{$key}}" id="leave{{$key}}" value="Leave" class="leave" >
                                  <label for="leave{{$key}}">Leave</label>
                                  <input type="radio" name="attend_status{{$key}}" id="absent{{$key}}" value="Absent" class="absent" >
                                  <label for="absent{{$key}}">Absent</label> 
                                  <a></a> 
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                        
                      </table><br/>

                      <button type="submit" class="btn btn-primary btn-sm">{{(@$edits)?'Update':'Submit'}}</button>
                    </div><!-- /.card-body -->
                  @endif
              </form>
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
  $(document).on('click', '.present', function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('backgroun-color','#dee2e6').css('color','#495057');
  });
  $(document).on('click', '.leave', function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','').css('backgroun-color','white').css('color','#495057');
  });
  $(document).on('click', '.absent', function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('backgroun-color','#dee2e6').css('color','#dee2e6');
  });
</script>

<script type="text/javascript">
  $(document).on('click', '.present_all', function(){
    $("input[value=Present]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('backgroun-color','#dee2e6').css('color','#495057');
  });
  $(document).on('click', '.leave_all', function(){
    $("input[value=Leave]").prop('checked',true);
    $('.datetime').css('pointer-events','').css('backgroun-color','white').css('color','#495057');
  });
  $(document).on('click', '.absent_all', function(){
    $("input[value=Absent]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('backgroun-color','#dee2e6').css('color','#dee2e6');
  });
</script>
  <script>
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
            "date": {
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