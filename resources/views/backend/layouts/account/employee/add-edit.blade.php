@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Employee Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee Salary</li>
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
                Add/Edit Employee Salary
                <a class="btn btn-success my-3 float-sm-right" href="{{route('accounts.employee.salary.view')}}"><i class="fa fa-list"></i> Employee Salary List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="form-row">
                        <div class="form-group col-md-3" >
                          <label for="control-label">Date</label>
                          <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" placeholder="Date"  autocomplete="off" readonly >
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
                      <form action="{{route('accounts.employee.salary.store')}}" method="post">
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
    $(document).ready(function(){
        $(document).on('click','#search',function(){
        var date = $('#date').val();
        $('.notifyjs-corner').html('');

        if(date ==''){
          $.notify("Date Required",{globalPosition: 'top right', className: 'error'});
          return false;
        }

           $.ajax({
            url : "{{ route('accounts.salary.getemployee')}}",
            type : "get",
            data : {'date': date},
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
