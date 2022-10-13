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
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
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
                <h3> Other Cost List
                  <a class="btn btn-success my-3 float-sm-right" href="{{route('accounts.others.cost.add')}}"><i class="fa fa-plus-circle"></i>Add Other Cost </a>
               </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Date</th>
                      <th>Amount (TK)</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key => $item)
                    <tr class="{{$item->id}}">
                      <td>{{ $key+1 }}</td>
                      <td>{{date('d-m-Y',strtotime( $item->date ))}}</td>
                      <td>{{ number_format($item->amount,2) }}</td>
                      <td>{{ $item->description }}</td>
                      <td   style="text-align: center;"><img width="50" src=" {{(!empty($item->image))?url('public/assets/backend/images/cost/'.$item->image):url('public/assets/backend/no_image.jpg')}}" style="width: 100px; height: 110px; border:1px solid #000;"></td>
                      <td>
                        <a title="Edit" class="btn btn-sm btn-success" href="{{ route('accounts.others.cost.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                        <!-- <a title="Details" target="_blank" class="btn btn-sm btn-primary" href="{{ route('employee.reg.details', $item->id) }}"><i class="fa fa-eye"></i></a> -->
                        <!-- <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{ route('setups.designation.delete', $item->id) }}" data-token="{{csrf_token()}}" data-id="{{$item->id}}"><i class="fa fa-trash"></i></a> -->
                      </td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>

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