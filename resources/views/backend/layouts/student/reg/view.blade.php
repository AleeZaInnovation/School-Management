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
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
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
                <h3> Student List
                  <a class="btn btn-success my-3 float-sm-right" href="{{route('student.reg.add')}}"><i class="fa fa-plus-circle"></i>Add Student </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form action="{{route('student.year.class')}}" method="GET" id="myForm">
                  <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="year"> Year <font style="color:red;">*</font> </label>
                            <select name="year_id" id="" class="form-control form-control-sm">
                              <option value="">Select Year</option>
                              @foreach($year as $item)
                              <option value="{{$item->id}}" {{(@$year_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="class"> Class <font style="color:red;">*</font> </label>
                            <select name="class_id" id="" class="form-control form-control-sm">
                              <option value="">Select Class</option>
                              @foreach($class as $item)
                              <option value="{{$item->id}}" {{(@$class_id==$item->id)?"selected":""}}>{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2" style="padding-top: 29px;">
                          <button type="submit" class="btn btn-primary btn-sm" name="search">
                          Search
                          </button>
                        </div>
                  </div>
                </form>
              </div>
              <div class="card-body">
                @if(!@$search)
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Student Name</th>
                        <th>ID No</th>
                        <th>Roll</th>
                        <th>Year</th>
                        <th>Class</th>                        
                        <th>Image</th>
                        @if(Auth::user()->role=="Admin")
                        <th> Code </th>
                        @endif
                        <th width="12%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $key => $item)
                      <tr class="{{$item->id}}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item['student']['name'] }}</td>
                        <td>{{ $item['student']['id_no']}}</td>
                        <td>{{ $item->roll }}</td>
                        <td>{{ $item['year']['name'] }}</td>
                        <td>{{ $item['student_class']['name'] }}</td> 
                                             
                        <td><img width="50" src=" {{(!empty($item['student']['image']))?url('public/assets/backend/images/student/'.$item['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
                        @if(Auth::user()->role=="Admin")
                        <td> {{ $item['student']['code'] }} </td>
                        @endif  
                        <td>
                          <a title="Edit" class="btn btn-sm btn-success" href="{{ route('student.reg.edit', $item->student_id) }}"><i class="fa fa-edit"></i></a>

                          <a title="Promotion" class="btn btn-sm btn-primary" href="{{ route('student.reg.promotion', $item->id) }}"><i class="fa fa-check"></i></a>

                          <a target="_blank" title="Details" class="btn btn-sm btn-info" href="{{ route('student.reg.details', $item->student_id) }}"><i class="fa fa-eye"></i></a>
                          <!-- <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{ route('student.reg.delete', $item->id) }}" data-token="{{csrf_token()}}" data-id="{{$item->id}}"><i class="fa fa-trash"></i></a> -->
                        </td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Student Name</th>
                        <th>ID No</th>
                        <th>Roll</th>
                        <th>Year</th>
                        <th>Class</th>
                        <th>Image</th>
                        @if(Auth::user()->role=="Admin")
                        <th> Code </th>
                        @endif
                        <th width="12%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $key => $item)
                      <tr class="{{$item->id}}">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item['student']['name'] }}</td>
                        <td>{{ $item['student']['id_no']}}</td>
                        <td>{{ $item->roll }}</td>
                        <td>{{ $item['year']['name'] }}</td>
                        <td>{{ $item['student_class']['name'] }}</td>                        
                        <td><img width="50" src=" {{(!empty($item['student']['image']))?url('public/assets/backend/images/student/'.$item['student']['image']):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
                        @if(Auth::user()->role=="Admin")
                        <td> {{ $item['student']['code'] }} </td>
                        @endif  
                        <td>
                          <a title="Edit" class="btn btn-sm btn-success" href="{{ route('student.reg.edit', $item->student_id) }}"><i class="fa fa-edit"></i></a>

                          <a title="Promotion" class="btn btn-sm btn-primary" href="{{ route('student.reg.promotion', $item->student_id) }}"><i class="fa fa-check"></i></a>

                          <a target="_blank" title="Details" class="btn btn-sm btn-info" href="{{ route('student.reg.details', $item->student_id) }}"><i class="fa fa-eye"></i></a>
                          <!-- <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{ route('student.reg.delete', $item->id) }}" data-token="{{csrf_token()}}" data-id="{{$item->id}}"><i class="fa fa-trash"></i></a> -->
                        </td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @endif
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