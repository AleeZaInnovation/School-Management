@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Other Cost</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Other Cost</li>
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
                Edit Other Cost
                @else  
                Add Other Cost
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('accounts.others.cost.view')}}"><i class="fa fa-list"></i> Other Cost List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{(@$edits)?route('accounts.others.cost.update' , $edits->id):route('accounts.others.cost.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                      <div class="form-row">
                        <div class="form-group col-md-3">
                              <label for="date"> Date  <font style="color:red;">*</font> </label>
                              <input type="text" name="date" value="{{ @$edits->date}}"class="form-control form-control-sm singledatepicker" autocomplete="off" >
                              <font style="color:red "> {{($errors->has('date')) ? ($errors->first('date')): ''}}</font>
                        </div>                                              
                        <div class="form-group col-md-3">
                              <label for="amount"> Amount  <font style="color:red;">*</font> </label>
                              <input type="text" name="amount" value="{{ @$edits->amount}}" class="form-control form-control-sm" >
                              <font style="color:red "> {{($errors->has('amount')) ? ($errors->first('amount')): ''}}</font>
                        </div>                      
                        <div class="form-group col-md-2">
	                        <label for="image">Image</label>
	                        <input type="file" name="image" class="form-control form-control-sm" id="image">
                        </div>
                        <div class="form-group col-md-4">
	                        <img id="showImage" src=" {{(!empty($edits->image))?url('public/assets/backend/images/cost/'.$edits->image):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;">
	                      </div>
                        <div class="form-group col-md-12">
                              <label for="description"> Description  <font style="color:red;">*</font> </label>
                              <textarea name="description" id="description" cols="15" rows="05" class="form-control form-control-sm" >{{ @$edits->description}}</textarea>
                              <font style="color:red "> {{($errors->has('amount')) ? ($errors->first('amount')): ''}}</font>
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
          "date": {
            required: true,
          },
          "description": {
            required: true,
          },
          "amount": {
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