@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Student Fee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Fee</li>
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
                Add/Edit Student Fee
                <a class="btn btn-success my-3 float-sm-right" href="{{route('accounts.student.fee.view')}}"><i class="fa fa-list"></i> Student Fee List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">

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
                        <div class="form-group col-md-3">
                            <label for="fee_category_id"> Class <font style="color:red;">*</font> </label>
                            <select name="fee_category_id" id="fee_category_id" class="form-control form-control-sm select2">
                              <option value="">Select Fee Category</option>
                              @foreach($fee_category as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3" >
                          <label for="control-label">Date</label>
                          <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" placeholder="Date"  autocomplete="off" readonly >
                        </div>                      
                        <div class="form-group col-md-2" >
                          <a id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                        </div>
                    </div>
                </div>
              </div><!-- /.card-body -->
              <div class="card-body">
                <div id="DocumentResults">
                   <script id="document-template" type="text/x-handlebars-template">
                      <form action="{{route('accounts.student.fee.store')}}" method="post">
                      @csrf
                      <table class="table-sm table-bordered table-striped" style="width: 100%">
                        <thead>
                          <tr>
                            @{{{thsource}}}                            
                          </tr>
                        </thead>
                        <tbody>
                          @{{#each this}}
                          <tr>
                            @{{{tdsource}}}
                          </tr>
                          @{{/each}}
                        </tbody>
                      </table>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                      </form>
                   </script>
                </div>
              </div>
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
        var year_id = $('#year_id').val();
        var class_id = $('#class_id').val();
        var fee_category_id = $('#fee_category_id').val();
        var date = $('#date').val();
        $('.notifyjs-corner').html('');

        if(year_id ==''){
          $.notify("Year Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

        if(class_id ==''){
          $.notify("Class Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }
        if(fee_category_id ==''){
          $.notify("Fee Category Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

        if(date ==''){
          $.notify("Date Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           $.ajax({
            url : "{{ route('accounts.fee.getstudent')}}",
            type : "get",
            data : {'year_id': year_id, 'class_id': class_id , 'fee_category_id': fee_category_id , 'date': date},
            beforeSend : function() {

            },
            success: function (data) 
            {
              var source = $("#document-template").html();
              var template = Handlebars.compile(source);
              var html = template(data);
              $('#DocumentResults').html(html);
              $('[data-toggle="tooltip"]').tooltip();          
            }
          });
        });
  </script>

  @endsection
