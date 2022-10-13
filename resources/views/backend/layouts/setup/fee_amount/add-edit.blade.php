@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Fee Amount</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Fee Amount</li>
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
                Edit Fee Amount
                @else  
                Add Fee Amount
                @endif
                <a class="btn btn-success my-3 float-sm-right" href="{{route('setups.student.fee.amount.view')}}"><i class="fa fa-list"></i> Fee Amount List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form method="post" action="{{(@$edits)?route('setups.student.fee.amount.update' ,  $edits[0]->fee_category_id):route('setups.student.fee.amount.store')}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                  <div class="add_item">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                            <label for="fee_category"> Fee Category</label>
                            <select name="fee_category_id" id="" class="form-control">
                              <option value="">Select Fee Category</option>
                              @foreach($feecategory as $category)
                              <option value="{{$category->id}}" {{($edits[0]->fee_category_id==$category->id)?"selected":""}}>{{$category->name}}</option>
                              @endforeach
                            </select>
                      </div>
                    </div>
                    @foreach($edits as $item)
                    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                      <div class="form-row">
                        <div class="form-group col-md-4">
                              <label for="class_id"> Class </label>
                              <select name="class_id[]" id="" class="form-control">
                                <option value="">Select Class</option>
                                @foreach($studentclass as $class)
                                <option value="{{$class->id}}"{{($item->class_id==$class->id)?"selected":""}}>{{$class->name}} </option>
                                @endforeach
                              </select>
                        </div>
                        <div class="form-group col-md-4">
                              <label for="amount"> Amount </label>
                              <input type="text" name="amount[]" id="" value="{{$item->amount}}" class="form-control">
                        </div>
                        <div class="form-group col-md-1" style="padding-top: 30px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <div class="form-group col-md-6" style="padding-top: 30px;">
                      <button type="submit" class="btn btn-primary" >{{(@$edits)?'Update':'Submit'}}</button>
	                </div>
                </form>
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
  <div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
      <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
          <div class="form-row">
                <div class="form-group col-md-4">
                      <label for="class_id"> Class </label>
                      <select name="class_id[]" id="" class="form-control">
                        <option value="">Select Class</option>
                        @foreach($studentclass as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                      </select>
                </div>
                <div class="form-group col-md-4">
                      <label for="amount"> Amount </label>
                      <input type="text" name="amount[]" id="" class="form-control">
                </div>
                <div class="form-group col-md-1" style="padding-top: 30px;">
                      <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                      <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>        
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      var counter = 0;
      $(document).on("click", ".addeventmore", function () {
        var whole_extra_item_add = $('#whole_extra_item_add').html();
        $(this).closest(".add_item").append(whole_extra_item_add);
        counter++;
      });
      $(document).on("click", ".removeeventmore", function (event) {
        $(this).closest(".delete_whole_extra_item_add").remove();
        counter -= 1;
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#myForm').validate({
        rules: {
          "fee_category_id": {
            required: true,
          },
          "class_id[]": {
            required: true,
          },
          "amount[]": {
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