@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Profit Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Profit Report</li>
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
                Profit Report List
                <a class="btn btn-success my-3 float-sm-right" href="{{route('reports.profit.add')}}"><i class="fa fa-list"></i> Add Profit Report </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="form-row">
                        <div class="form-group col-md-3" >
                          <label for="control-label">Start Date</label>
                          <input type="text" name="start_date" id="start_date" class="form-control form-control-sm singledatepicker" placeholder="Start Date"  autocomplete="off"  >
                        </div>
                        <div class="form-group col-md-3" >
                          <label for="control-label">End Date</label>
                          <input type="text" name="end_date" id="end_date" class="form-control form-control-sm singledatepicker" placeholder="End Date"  autocomplete="off"  >
                        </div>  
                        <div class="form-group col-md-2" style="padding-top: 29px;">
                          <a id="search" class="btn btn-primary btn-sm" name="search">Search</a>
                        </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
              <div class="card-body">
                <div id="DocumentResults">
                   <script id="document-template" type="text/x-handlebars-template">
                      <table class="table-sm table-bordered table-striped" style="width: 100%">
                        <thead>
                          <tr>
                            @{{{thsource}}}                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @{{{tdsource}}}
                          </tr>
                        </tbody>
                      </table>
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
    $(document).ready(function(){
        $(document).on('click','#search',function(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $('.notifyjs-corner').html('');

        if(start_date ==''){
          $.notify("Start Date Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

        if(end_date ==''){
          $.notify("End Date Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

           $.ajax({
            url : "{{ route('reports.profit.get')}}",
            type : "get",
            data : {'start_date': start_date,'end_date': end_date },
            beforeSend : function() {
            },
            success: function (data) 
            {
              var source = $('#document-template').html();
              var template = Handlebars.compile(source);
              var html = template(data);
              $('#DocumentResults').html((html));
              $('[data-toggle="tooltip"]').tooltip();          
            }
          });
      });
    });
  </script>

  @endsection
