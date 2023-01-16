@extends('layouts.student') 

@section('content')
  
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Proposal</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Proposal</a></li>
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
              <h3 class="card-title">View Proposal</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Event Name</label>
                      <p>{{ $proposal->eventname }}</p>
                    </div>
                    <div class="form-group">
                      <label>Capacity</label>
                      <p>{{ $proposal->capacity }}</p>
                    </div>
                    <div class="form-group">
                      <label>Venue</label>
                      <p>{{ $proposal->venue }}</p>
                    </div>
                    <div class="form-group">
                      <label>Brief Description</label>
                      <p>{{ $proposal->description }}</p>
                    </div>
                  </div>
                  <!-- col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Event Date & Time</label>
                      <p>{{ Carbon\Carbon::parse($proposal->datetime)->format('F d, Y - H:i A') }}</p>
                    </div>
                    <div class="form-group">
                      <label>Budget (RM)</label>
                      <p>{{ $proposal->budget }}</p>
                    </div>
                    <div class="form-group">
                      <label>Registration Closing Date</label>
                      <p>{{ Carbon\Carbon::parse($proposal->closingdate)->format('F d, Y - H:i A') }}</p>
                    </div>
                    <div class="form-group">
                      <label>Event Status</label>
                      <p>{{ $status }}</p>
                    </div>
                  </div>
                  <!-- col -->
                </div>
                <!-- row -->
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                

                @if ($status == 'Completed' && $report == null)
                    <a class="btn btn-success float-left" href="/proposal/report/create/{{ $proposal->id }}">Create Report</a>
                @elseif ($status == 'Completed' && $report != null)
                    <a class="btn btn-primary float-left" href="/proposal/report/{{ $report->id }}">View Report</a>
                @endif
                <a class="btn btn-secondary float-right" href="/proposal">Back</a>
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