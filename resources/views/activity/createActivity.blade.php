@extends('layouts.student') 

@section('content')
  
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 font-weight-bold">New Activity</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Actvity</a></li>
            <li class="breadcrumb-item active">Create New Activity</li>
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
      
          <!-- Activity form elements -->
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Create New Activity</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/activity/viewActivity" method="post">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Event Name</label>
                      <input type="text" name="eventname" class="form-control @error('eventname') is-invalid @enderror" placeholder="Enter Event Name">
                      @error('eventname')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Capacity</label>
                      <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" placeholder="Enter Capacity">
                      @error('capacity')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Venue</label>
                      <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" placeholder="Enter Event Venue">
                      @error('venue')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    
                  </div>
                  <!-- col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Event Date & Time</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="datetime-local" name="datetime" class="form-control @error('datetime') is-invalid @enderror">
                        @error('datetime')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <!-- /.input-group -->
                    </div>
                    
                    <div class="form-group">
                      <label>Registration Closing Date</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" name="closingdate" class="form-control @error('closingdate') is-invalid @enderror">
                        @error('closingdate')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <!-- /.input-group -->
                    </div>
                  </div>
                  <!-- col -->
                </div>
                <!-- row -->
                <div class="form-group">
                  <label>Brief Description</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5"></textarea>
                  @error('description')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              <a class="btn btn-secondary" href="{{asset('/activity/viewActivity')}}"  >Back</a>
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
    <script src=" {{ asset('/js/activity.js') }} "></script>
@endpush