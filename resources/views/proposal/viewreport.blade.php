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
            <li class="breadcrumb-item active">View</li>
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
              <h3 class="card-title">View Report</h3>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Attendance</label>
                      <p>{{ $report->attendance }}</p>
                    </div>
                  </div>
                  <!-- col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <p>
                        @if($report->status == 1)
                          Success
                        @else
                          Failure
                        @endif
                      </p>
                    </div>
                  </div>
                  <!-- col -->
                </div>
                <!-- row -->
                <div class="form-group">
                  <label>Brief Report</label>
                  <p>{{ $report->report }}</p>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a class="btn btn-secondary float-right" href="/proposal/{{ $report->proposal_id }}">Back</a>
              </div>
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