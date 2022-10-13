@extends('backend.layouts.master')
@section('content')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Slider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
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
                <h3> Edit Slider
                <a class="btn btn-success my-3 float-sm-right" href="{{route('sliders.view')}}"><i class="fa fa-list"></i> Sliders List </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form method="post" action="{{route('sliders.update', $edits->id)}}" id="myForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-6">
                          <label for="short_title">Short Title</label>
                          <input type="text" name="short_title" class="form-control" value="{{ $edits->short_title}}">
                    </div>

                    <div class="form-group col-md-6">
                          <label for="long_title">Long Title</label>
                          <input type="text" name="long_title" class="form-control" value="{{ $edits->long_title}}">
                    </div>
	                  <div class="form-group col-md-4">
	                        <label for="image">Image</label>
	                        <input type="file" name="image" class="form-control" id="image">
	                  </div>
	                  <div class="form-group col-md-2">
	                        <img id="showImage" src="{{(!empty($edits->image))?url('public/assets/backend/images/sliders/'.$edits->image):url('public/assets/backend/no_image.jpg')}}" style="width: 150px; height: 160px; border:1px; solid:#000;">
	                  </div>

                  

	                  <div class="form-group col-md-6" style="padding-top: 30px;">
	                        <input type="submit" value="Update" class="btn btn-primary">
	                  </div>
                  </div>
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

  @endsection