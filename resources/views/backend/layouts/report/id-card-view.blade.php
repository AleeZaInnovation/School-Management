@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage ID Card</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">ID Card</li>
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
                <form action="{{route('reports.id-card.get')}}" method="GET" id="myForm">
                  @csrf
                  <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="year"> Year <font style="color:red;">*</font> </label>
                            <select name="year_id" id="year_id" class="form-control form-control-sm select2">
                              <option value="">Select Year</option>
                              @foreach($year as $item)
                              <option value="{{$item->id}}" >{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="class"> Class <font style="color:red;">*</font> </label>
                            <select name="class_id" id="class_id" class="form-control form-control-sm select2">
                              <option value="">Select Class</option>
                              @foreach($class as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>                    
                        <div class="form-group col-md-2" style="padding-top: 30px;">
                          <button type="submit" class="btn btn-primary btn-sm" name="search"> Search </button>
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

  <script>
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
          "year_id": {
            required: true,
          },
          "class_id": {
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