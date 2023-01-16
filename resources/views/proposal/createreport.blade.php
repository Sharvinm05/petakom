@extends('layouts.student') 

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Report</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/proposal">Proposal</a></li>
            <li class="breadcrumb-item active">Report</li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
      
          <!-- Proposal form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Create New Report for {{ $proposal->eventname }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/proposal/report" method="post">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Attendance</label>
                      <input type="number" name="attendance" class="form-control @error('attendance') is-invalid @enderror" placeholder="Enter Attendance">
                      @error('attendance')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <!-- col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                    <div class="form-group clearfix pt-2">
                      <div class="icheck-primary d-inline pr-5">
                        <input type="radio" id="radioPrimary1" name="status" value="1" checked>
                        <label for="radioPrimary1">
                          Sucess
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="status" value="0">
                        <label for="radioPrimary2">
                          Failure
                        </label>
                      </div>
                    </div>
                </div>
                  </div>
                  <!-- col -->
                </div>
                <!-- row -->
                <div class="form-group">
                  <label>Brief Report</label>
                  <textarea class="form-control @error('report') is-invalid @enderror" name="report" rows="5"></textarea>
                  @error('report')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
          
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
  
@endsection

@push('scripts')
    <script src=" {{ asset('/js/proposal.js') }} "></script>
@endpush