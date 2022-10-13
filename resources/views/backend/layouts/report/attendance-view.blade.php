@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Attendance Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Attendance Report</li>
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
                <h3> Search Criteria</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('reports.attendance.get')}}" method="GET" target="_blank" id="myForm">
                  @csrf
                  <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="employee_id"> Employee Name <font style="color:red;">*</font> </label>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm select2">
                              <option value="">Select Employee</option>
                              @foreach($data as $item)
                              <option value="{{$item->id}}" >{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3" >
                          <label for="control-label"> Date</label>
                          <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" placeholder=" Date"  autocomplete="off" readonly >
                        </div>                      
                        <div class="form-group col-md-2" style="padding-top: 30px;" >
                          <button type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
                        </div>
                  </div>
                  <br>
                  <div class="row d-none" id="marks-entry">
                    <div class="col-md-12">
                      <table class="table table-bordered table-striped dt-responsive" style="width: 100%">
                        <thead>
                          <tr>
                            <th> ID No </th>
                            <th> Student Name </th>
                            <th> Fathers Name </th>
                            <th> Gender </th>
                            <th> Marks</th>
                          </tr>
                        </thead>
                        <tbody id="marks-entry-tr">

                        </tbody>
                      </table>
                      <button type="submit" class="btn btn-success btn-sm"> Attendance Report</button>
                    </div>
                  </div>
                </form>
              </div>
              
              <!-- /.card-body -->
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
      $(document).on('click','#search',function(){
        var employee_id = $('#employee_id').val();
        var class_id = $('#class_id').val();
        var assign_subject_id = $('#assign_subject_id').val();
        var exam_type_id = $('#exam_type_id').val();
        $('.notifyjs-corner').html('');

        if(employee_id ==''){
          $.notify("Year Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

        if(class_id ==''){
          $.notify("Class Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

        if(assign_subject_id ==''){
          $.notify("Subject Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

        if(exam_type_id ==''){
          $.notify("Exam Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           $.ajax({
            url : "{{ route('get-student')}}",
            type : "get",
            data : {'employee_id': employee_id, 'class_id': class_id,'assign_subject_id': assign_subject_id,'exam_type_id': exam_type_id},
            success: function (data) 
            {
              $('#marks-entry').removeClass('d-none');
              var html ='';
              $.each(data, function(key,v){
                html +=
                  '<tr>'+
                      '<td>'+ v.student.id_no +'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+ v.student.id_no+'"></td>'+
                      '<td>'+ v.student.name +'</td>'+
                      '<td>'+ v.student.fname +'</td>'+
                      '<td>'+ v.student.gender +'</td>'+
                      '<td><input type="text" class="form-control form-control-sm" name="marks[]"></td>'+
                  '</tr>';
              });
              html =$('#marks-entry-tr').html(html);          
            }
          });
        });
  </script>

  <script type="text/javascript">
    $(function(){
      $(document).on('change','#class_id',function(){
        var class_id = $('#class_id').val();
        $.ajax({
            url : "{{ route('get-subject')}}",
            type : "get",
            data : {'class_id': class_id},
            success: function (data) 
            {
              var html ='<option value=""> Select Subject </option>';
              $.each(data, function(key,v){
                html += '<option value="'+v.id+'">'+ v.subject.name +'</option>'
              });
              html =$('#assign_subject_id').html(html);          
            }
          });
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
          "employee_id": {
            required: true,
          },
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