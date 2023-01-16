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
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Proposal</li>
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

        <div class="row pb-3">
          <div class="col-12">
            <a class="btn btn-success" href="/proposal/create">Create New Proposal</a>
          </div>
        </div>

        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Existing Proposals</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Proposal</th>
                  <th>Date & Time</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($proposals as $proposal)
                <tr>
                  <td>{{ $proposal->eventname }}</td>
                  <td>{{ Carbon\Carbon::parse($proposal->datetime)->format('F d, Y - H:i A') }}</td>
                  <td class="project-state">

                    @if ($proposal->deanstatus == 1 && $proposal->coordinatorstatus == 1)
                    <span class="badge badge-success">Approved</span>

                    @elseif ($proposal->deanstatus == 2 || $proposal->coordinatorstatus == 2)
                    <span class="badge badge-danger">Rejected</span>


                    @elseif ($proposal->deanstatus == null || $proposal->coordinatorstatus == null)
                    <span class="badge badge-warning">Pending</span>

                    @endif

                  </td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="/proposal/{{ $proposal->id }}">
                      <i class="fas fa-eye">
                      </i>
                    </a>
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

  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@push('scripts')
<script src=" {{ asset('/js/proposal.js') }} "></script>
@endpush