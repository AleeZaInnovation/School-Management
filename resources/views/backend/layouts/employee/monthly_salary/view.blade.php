@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Monthly Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee Monthly Salary</li>
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
                <h3> Search Date</h3>
              </div><!-- /.card-header -->
              <div class="card-body">                
                  <div class="form-row">
                      <div class="form-group col-md-4" >
                        <label for="control-label">Date</label>
                        <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" placeholder="Date"  autocomplete="off" readonly >
                      </div>
                        <div class="form-group col-md-2" style="padding-top: 29px;">
                          <a id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                        </div>
                  </div>
              </div>
              <div class="card-body">
                <div id="DocumentResults">
                   <script id="document-template" type="">
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
                   </script>
                </div>
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
        var date = $('#date').val();
        $('.notifyjs-corner').html('');

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
            url : "{{ route('employee.monthly.salary.get')}}",
            type : "get",
            data : {'date': date},
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