@extends('layouts.student')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Activities</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Activities</li>
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

        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Existing Activities</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Activity Name</th>
                  <th>Date & Time</th>
                  <th>Venue</th>
                  <th>Registration Closing Date</th>
                  <th>Capacity</th>
                  <th>Descriptions</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($activities as $activity)
                <tr>
                  <td>{{ $activity->eventname }}</td>
                  <td>{{ Carbon\Carbon::parse($activity->datetime)->format('F d, Y - H:i A') }}
                  </td>
                  <td class="project-state">
                    {{ $activity->venue }}
                  </td>
                  <td class="project-state">
                    {{ $activity->closingdate }}
                  </td>
                  <td class="project-state">
                    {{ $activity->capacity }}
                  </td>
                  <td class="project-state">
                    {{ $activity->description }}
                  </td>
                  <td>
                    <div class="d-block">
                      <form method="POST" action="{{ route('updateData') }}">
                        @csrf
                        <input type="hidden" name="eventstatus" value="approved">
                        <input type="hidden" name="id" value="{{ $activity->id }}">
                        <button type="submit" class="btn btn-success mb-3">Approve</button>
                      </form>

                      <form method="POST" action="{{ route('updateData') }}">
                        @csrf
                        <input type="hidden" name="eventstatus" value="rejected">
                        <input type="hidden" name="id" value="{{ $activity->id }}">
                        <button type="submit" class="btn btn-danger">Reject</button>
                      </form>
                    </div>

                  </td>
                </tr>
                @endforeach

            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

    <!-- <div class="row justify-center">
        <div class="col-10 " >
          <input type="submit" value="Back" class="btn btn-success">
        </div>
      </div> -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@push('scripts')
    <script src=" {{ asset('/js/activity.js') }} "></script>
@endpush