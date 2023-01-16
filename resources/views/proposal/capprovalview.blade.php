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
                    <div class="form-group">
                      <label>Coordinator Approval Status</label>
                      @if ($proposal->coordinatorstatus == 2)
                          <p>Rejected</p>
                      @elseif ($proposal->coordinatorstatus == 1)
                          <p>Approved</p>
                      @else 
                      <form action="{{ route('storecoordinatorstatus') }}" method="post">
                        @csrf
                        <div class="form-group clearfix pt-2">
                          <input type="hidden" name="id" value="{{ $proposal->id }}">
                          <div class="icheck-primary d-inline pr-5">
                            <input type="radio" id="radioPrimary1" name="coordinatorstatus" value="1" checked>
                            <label for="radioPrimary1">
                              Approve
                            </label>
                          </div>
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary2" name="coordinatorstatus" value="2">
                            <label for="radioPrimary2">
                              Reject
                            </label>
                          </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                      
                      @endif
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
                  </div>
                  <!-- col -->
                </div>
                <!-- row -->
            </div>
            <!-- /.card-body -->


              <div class="card-footer">
                <div>
                  
                  <a class="btn btn-secondary float-right" href="/coordinator/proposal/approval">Back</a>
                </div>
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